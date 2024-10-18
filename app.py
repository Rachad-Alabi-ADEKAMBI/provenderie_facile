from flask import Flask, render_template, request, jsonify, redirect, url_for
import mysql.connector

app = Flask(__name__, template_folder='templates')

# Connexion à la base de données
db_config = {
    'host': 'localhost',
    'user': 'root',
    'password': '',
    'database': 'provenderie'
}

def get_db_connection():
    connection = mysql.connector.connect(**db_config)
    return connection

# Route pour la page d'accueil avec le formulaire
@app.route('/', methods=['GET'])
def formulaire():
    return render_template('index.html')

# Route pour récupérer les sujets depuis la base de données
@app.route('/subjects', methods=['GET'])
def get_subjects():
    conn = get_db_connection()
    cursor = conn.cursor()
    cursor.execute('SELECT name FROM subjects')
    rows = cursor.fetchall()

    cursor.close()
    conn.close()

    subjects = [{'name': row[0]} for row in rows]

    return jsonify(subjects)


# Route pour récupérer le sujet qui a pour nom la valeur d'item
@app.route('/subject/<string:item>', methods=['GET'])
def get_subject(item):
    conn = get_db_connection()
    cursor = conn.cursor(dictionary=True)  # Utilisation de dictionary=True pour un accès facile aux colonnes
    cursor.execute('SELECT * FROM subjects WHERE name = %s', (item,))
    subject_data = cursor.fetchone()

    cursor.close()
    conn.close()

    if subject_data:
        return jsonify(subject_data)
    else:
        return jsonify({"error": "Sujet non trouvé"}), 404

# Route pour récupérer les ingrédients depuis la base de données
@app.route('/items', methods=['GET'])
def get_items():
    conn = get_db_connection()
    cursor = conn.cursor()
    cursor.execute('SELECT name FROM items')
    rows = cursor.fetchall()

    cursor.close()
    conn.close()

    items = [{'name': row[0]} for row in rows]

    return jsonify(items)

# Route pour gérer la soumission du formulaire et afficher le choix des ingrédients
@app.route('/composition', methods=['POST'])
def composition():
    subject = request.form.get('subject')  # Récupérer le sujet sélectionné
    return render_template('composition.html', subject=subject)

@app.route('/calcul', methods=['POST'])
def calcul():
    subject = request.form.get('subject')  # Récupérer le sujet envoyé avec le formulaire
    selected_items = request.form.getlist('items')  # Récupérer la liste des ingrédients sélectionnés (checkboxes)

    # Connexion à la base de données pour obtenir les détails du sujet
    conn = get_db_connection()
    cursor = conn.cursor(dictionary=True)  # Utilisation de dictionary=True pour retourner un dict plutôt qu'un tuple
    cursor.execute('SELECT * FROM subjects WHERE name = %s', (subject,))
    subject_details = cursor.fetchone()  # Récupérer les détails du sujet

    # Récupérer la valeur du "level" du sujet
    if subject_details and 'level' in subject_details:
        level = subject_details['level']
        level1_column = f"{level}1"  # Exemple: Demarrage1 ou Croissance1
        level2_column = f"{level}2"  # Exemple: Demarrage2 ou Croissance2
    else:
        return render_template('calcul.html', subject=subject, items=selected_items, error="Sujet ou niveau non trouvé")

    # Récupérer les détails de chaque item sélectionné
    items_details = []
    for item in selected_items:
        query = f'SELECT name, energy, protein, {level1_column}, {level2_column} FROM items WHERE name = %s'
        cursor.execute(query, (item,))
        item_details = cursor.fetchone()
        
        if item_details:
            # Ajouter les noms de colonnes dynamiques dans le dictionnaire
            item_details['level1_column'] = level1_column
            item_details['level2_column'] = level2_column
            items_details.append(item_details)

    cursor.close()
    conn.close()

    if subject_details:
        # Passer les détails du sujet et des items à la page HTML
        return render_template('calcul.html', subject=subject, items=selected_items, subject_details=subject_details, items_details=items_details)
    else:
        return render_template('calcul.html', subject=subject, items=selected_items, error="Sujet non trouvé")



if __name__ == '__main__':
    app.run(debug=True)
