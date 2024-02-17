from flask import Flask, render_template, request, jsonify
import mysql.connector
from scipy.optimize import minimize
from decimal import Decimal

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
        cursor = connection.cursor(dictionary=True)

        query = 'SELECT * FROM subjects WHERE namee = %s'
        cursor.execute(query, (subject,))
        result = cursor.fetchone()

        cursor.close()
        connection.close()

        if result:
            total = 100
            level = result.get('level')

            # Get item values for each checkbox
            items_qty_min = []
            items_qty_max = []

            for item in checkbox_values:
                connection = mysql.connector.connect(**db_config)
                cursor = connection.cursor(dictionary=True)

                query = 'SELECT * FROM items WHERE name = %s'
                cursor.execute(query, (item,))
                item_values = cursor.fetchone()

                cursor.close()
                connection.close()

                if level == 'demarrage':
                    items_qty_min.append(item_values['demarrage1'])
                    items_qty_max.append(item_values['demarrage2'])
                elif level == 'croissance':
                    items_qty_min.append(item_values['croissance1'])
                    items_qty_max.append(item_values['croissance2'])
                elif level == 'pondeuses':
                    items_qty_min.append(item_values['pondeuses1'])
                    items_qty_max.append(item_values['pondeuses2'])
                else:
                    return jsonify(result)

            # Math
            def objective_function(variables):
                return sum(
                    (float(variables[i]) - float(items_qty_min[i]))**2 +
                    (float(items_qty_max[i]) - float(variables[i]))**2
                    for i in range(len(variables))
                ) + (sum(map(float, variables)) - total)**2

            # Define the constraints
            constraints = []

            for i in range(len(checkbox_values)):
                constraints.append(
                    {'type': 'ineq', 'fun': lambda x, i=i: x[i] - float(items_qty_min[i])})
                constraints.append(
                    {'type': 'ineq', 'fun': lambda x, i=i: float(items_qty_max[i]) - x[i]})

            # Add the equality constraint
            constraints.append({'type': 'eq', 'fun': lambda x: sum(x) - total})

            # Specify initial values
            initial_guess = [float((float(items_qty_min[i]) + float(items_qty_max[i])) / 2)
                             for i in range(len(checkbox_values))]

            # Use the nonlinear solver
            result = minimize(objective_function,
                              initial_guess, constraints=constraints)

            # Display the results
            print("Optimal values for item quantities:", result.x)

            return jsonify({'message': 'Optimization successful'})

        else:
            return jsonify({'message': 'Subject not found'})


if __name__ == '__main__':
    app.run(debug=True)
