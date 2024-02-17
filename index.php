from flask import Flask, render_template, request, jsonify
import mysql.connector

from scipy.optimize import minimize

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

if result:
# Access result using dictionary keys
total = 100
protein1 = result.get('protein1')
protein2 = result.get('protein2')
energy1 = result.get('energy1')
energy2 = result.get('energy2')
level = result.get('level')

# item1
item1 = checkbox_values[0]

connection = mysql.connector.connect(**db_config)
# Use dictionary cursor for easier result access
cursor = connection.cursor(dictionary=True)

query = 'SELECT * FROM items WHERE name = %s'
cursor.execute(query, (item1,))
item1Values = cursor.fetchone()

cursor.close()
connection.close()

if level == 'demarrage':
item1QtyMin = jsonify(item1Values['demarrage1'])
item1QtyMax = jsonify(item1Values['demarrage2'])
elif level == 'croissance':
item1QtyMin = jsonify(item1Values['croissance1'])
itemQty1Max = jsonify(item1Values['croissance2'])
elif level == 'pondeuses':
item1QtyMin = jsonify(item1Values['pondeuses1'])
item1QtyMax = jsonify(item1Values['pondeuses2'])
else:
return jsonify(result)

# item2
item2 = checkbox_values[1]

connection = mysql.connector.connect(**db_config)
# Use dictionary cursor for easier result access
cursor = connection.cursor(dictionary=True)

query = 'SELECT * FROM items WHERE name = %s'
cursor.execute(query, (item2,))
item2Values = cursor.fetchone()

cursor.close()
connection.close()

if level == 'demarrage':
item2QtyMin = jsonify(item2Values['demarrage1'])
item2QtyMax = jsonify(item2Values['demarrage2'])
elif level == 'croissance':
item2QtyMin = jsonify(item2Values['croissance1'])
item2QtyMax = jsonify(item2Values['croissance2'])
elif level == 'pondeuses':
item2QtyMin = jsonify(item2Values['pondeuses1'])
item2QtyMax = jsonify(item2Values['pondeuses2'])
else:
return jsonify(result)

# item3
item3 = checkbox_values[2]

connection = mysql.connector.connect(**db_config)
# Use dictionary cursor for easier result access
cursor = connection.cursor(dictionary=True)

query = 'SELECT * FROM items WHERE name = %s'
cursor.execute(query, (item3,))
item3Values = cursor.fetchone()

cursor.close()
connection.close()

if level == 'demarrage':
item3QtyMin = jsonify(item3Values['demarrage1'])
item3QtyMax = jsonify(item3Values['demarrage2'])
elif level == 'croissance':
item3QtyMin = jsonify(item3Values['croissance1'])
item3QtyMax = jsonify(item3Values['croissance2'])
elif level == 'pondeuses':
item3QtyMin = jsonify(item3Values['pondeuses1'])
item3QtyMax = jsonify(item3Values['pondeuses2'])
else:
return jsonify(result)

# math
def objective_function(variables):
item1Qty, item2Qty, item3Qty = variables
return (item1Qty + item2Qty + item3Qty - total)**2 + (item1Qty - item1QtyMin)**2 + (item2Qty - item2QtyMin)**2 +
(item3Qty - item3QtyMin)**2

# Define the constraints
constraints = [
{'type': 'ineq', 'fun': lambda x: x[0] - item1QtyMin},
{'type': 'ineq', 'fun': lambda x: item1QtyMax - x[0]},
{'type': 'ineq', 'fun': lambda x: x[1] - item2QtyMin},
{'type': 'ineq', 'fun': lambda x: item2QtyMax - x[1]},
{'type': 'ineq', 'fun': lambda x: x[2] - item3QtyMin},
{'type': 'ineq', 'fun': lambda x: item3QtyMax - x[2]},
{'type': 'eq', 'fun': lambda x: x[0] + x[1] + x[2] - total}
]

# Specify initial values
initial_guess = [(item1QtyMin + item1QtyMax) / 2, (item2QtyMin +
item2QtyMax) / 2, (item3QtyMin + item3QtyMax) / 2]

# Use the nonlinear solver
result = minimize(objective_function,
initial_guess, constraints=constraints)

# Display the results
print("Optimal values for item1Qty, item2Qty, and item3Qty:", result.x)

else:
return jsonify({'message': 'Subject not found'})


if __name__ == '__main__':
app.run(debug=True)