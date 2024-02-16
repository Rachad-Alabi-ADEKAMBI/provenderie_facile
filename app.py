from flask import Flask, render_template, request, jsonify
import mysql.connector

app = Flask(__name__, template_folder='.')

db_config = {
    'host': 'localhost',
    'user': 'root',
    'password': '',
    'database': 'provenderie'
}


@app.route('/')
def formulaire():
    return render_template('index.html')


@app.route('/submit', methods=['POST'])
def soumettre_formulaire():
    if request.method == 'POST':
        subject = request.form['subject']
        checkbox_values = request.form.getlist('checkbox')

        if not checkbox_values:
            error_message = 'At least one checkbox must be selected.'
            return render_template('index.html', error_message=error_message)

        # Get subjects
        connection = mysql.connector.connect(**db_config)
        # Use dictionary cursor for easier result access
        cursor = connection.cursor(dictionary=True)

        # Execute SQL query
        query = 'SELECT * FROM subjects WHERE namee = %s'
        cursor.execute(query, (subject,))
        result = cursor.fetchone()

        cursor.close()
        connection.close()

        # Check if a result was found
        if result:
            protein1 = result.get('protein1')
            protein2 = result.get('protein2')
            energy1 = result.get('energy1')
            energy2 = result.get('energy2')
            level = result.get('level')

            if level == 'demarrage':
                return 'd'
            elif level == 'croissance':
                return 'c'
            else:
                return jsonify(result)
        else:
            return jsonify({'message': 'Subject not found'})


if __name__ == '__main__':
    app.run(debug=True)
