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

# Nouvelle route pour gérer la soumission et afficher les résultats sur /calcul
@app.route('/calcul', methods=['POST'])
def calcul():
    subject = request.form.get('subject')  # Récupérer le sujet envoyé avec le formulaire
    selected_items = request.form.getlist('items')  # Récupérer la liste des ingrédients sélectionnés (checkboxes)
    
    return render_template('calcul.html', subject=subject, items=selected_items)

if __name__ == '__main__':
    app.run(debug=True)
