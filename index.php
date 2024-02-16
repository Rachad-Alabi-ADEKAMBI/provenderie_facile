from flask import Flask, render_template, request
from bs4 import BeautifulSoup
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


@app.route('/submit', methods=['POST'])
def soumettre_formulaire():
# Récupérer les données du formulaire
subject = request.form['subject']

items = request.form['items']

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
protein1 = result[3]
protein2 = result[4]
energy1 = result[5]
energy2 = result[6]
level = result[7]

if level == 'demarrage':
return items

elif level == 'pondeuses':
return '2'
elif level == 'croissance':
return '3'
# return str(energy1)
else:
return 'Sujet non trouvé.'


if __name__ == '__main__':
app.run(debug=True)