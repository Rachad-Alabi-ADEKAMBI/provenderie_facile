from flask import Flask, render_template, request
import mysql.connector

app = Flask(__name__, template_folder='.')

# Configuration de la base de données
db_config = {
    'host': 'localhost',
    'user': 'root',
    'password': '',
    'database': 'test'
}

# Route pour afficher le formulaire


@app.route('/')
def formulaire():
    return render_template('index.html')

# Route pour traiter le formulaire


@app.route('/submit', methods=['POST'])
def soumettre_formulaire():
    # Récupérer les données du formulaire
    id = request.form['id']
    name = request.form['name']

    # Insérer les données dans la base de données
    try:
        connection = mysql.connector.connect(**db_config)
        cursor = connection.cursor()

        # Requête d'insertion
        query = "INSERT INTO users (id, name) VALUES (%s, %s)"
        values = (id, name)
        cursor.execute(query, values)

        # Valider la transaction
        connection.commit()

        return 'Données insérées avec succès!'
    except Exception as e:
        return f'Erreur lors de l\'insertion : {str(e)}'
    finally:
        # Fermer la connexion à la base de données
        if connection.is_connected():
            cursor.close()
            connection.close()


if __name__ == '__main__':
    app.run(debug=True)
