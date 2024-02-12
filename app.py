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

    return 'Sujet choisi: ' + subject


if __name__ == '__main__':
    app.run(debug=True)
