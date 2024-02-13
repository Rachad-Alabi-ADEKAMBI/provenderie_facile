from flask import Flask, render_template, request
import mysql.connector

app = Flask(__name__, template_folder='.')

# Configuration de la base de données
db_config = {
    'host': 'localhost',
    'user': 'root',
    'password': '',
    'database': 'provenderie'
}

# Route pour afficher le formulaire


@app.route('/')
def formulaire():
    return render_template('index.html')

# Route pour traiter le formulaire


@app.route('/submit', methods=['POST'])
def soumettre_formulaire():
    # Récupérer les données du formulaire
    subject = request.form['subject']

    # Connexion à la base de données
    connection = mysql.connector.connect(**db_config)
    cursor = connection.cursor()

    # Exécuter la requête SQL
    query = 'SELECT * FROM subjects WHERE namee = %s'
    cursor.execute(query, (subject,))
    result = cursor.fetchone()

    # Fermer la connexion
    cursor.close()
    connection.close()

    if result:
        level = result[7]  # Index 7 corresponds to the 'demarrage' value
        return 'Détails du sujet: ' + str(level)
    else:
        return 'Sujet non trouvé.'


if __name__ == '__main__':
    app.run(debug=True)
