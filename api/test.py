from scipy.optimize import minimize
import sys
import sqlite3

# Récupérer les données passées depuis PHP
item1 = sys.argv[1]
item2 = sys.argv[2]
item3 = sys.argv[3]

# Faire quelque chose avec les données
print(
    f"Données reçues du formulaire : Item 1 = {item1}, Item 2 = {item2}, Item 3 = {item3}")

# Connect to the SQLite database
conn = sqlite3.connect('provenderie.db')
cursor = conn.cursor()

# Retrieve subject data
subject = "poussins"
cursor.execute(f"SELECT * FROM subjects WHERE name = ? LIMIT 1", (subject,))
subject_data = cursor.fetchone()

if subject_data:
    needed_protein1, needed_protein2, needed_protein, needed_energy, needed_energy1, needed_energy2, level = subject_data

    # Retrieve item1 data
    cursor.execute(f"SELECT * FROM items WHERE name = ? LIMIT 1", (item1,))
    item1_data = cursor.fetchone()

    if item1_data:
        protein1, energy1, item1A, item1B = item1_data[1:5]

    # Retrieve item2 data
    cursor.execute(f"SELECT * FROM items WHERE name = ? LIMIT 1", (item2,))
    item2_data = cursor.fetchone()

    if item2_data:
        protein2, energy2, item2A, item2B = item2_data[1:5]

    # Retrieve item3 data
    cursor.execute(f"SELECT * FROM items WHERE name = ? LIMIT 1", (item3,))
    item3_data = cursor.fetchone()

    if item3_data:
        protein3, energy3, item3A, item3B = item3_data[1:5]

    # Close the database connection
    conn.close()

    # Define the objective function to minimize
    def objective_function(variables):
        x, y, z = variables
        return (x + y + z - 10)**2 + (x - item1A)**2 + (y - item2A)**2 + (z - item3A)**2

    # Define the constraints
    constraints = [
        {'type': 'ineq', 'fun': lambda x: x[0] - item1A},
        {'type': 'ineq', 'fun': lambda x: item1B - x[0]},
        {'type': 'ineq', 'fun': lambda x: x[1] - item2A},
        {'type': 'ineq', 'fun': lambda x: item2B - x[1]},
        {'type': 'ineq', 'fun': lambda x: x[2] - item3A},
        {'type': 'ineq', 'fun': lambda x: item3B - x[2]},
        {'type': 'eq', 'fun': lambda x: x[0] + x[1] + x[2] - 10}
    ]

    # Specify initial values
    initial_guess = [(item1A + item1B) / 2, (item2A +
                                             item2B) / 2, (item3A + item3B) / 2]

    # Use the nonlinear equations solver
    result = minimize(objective_function, initial_guess,
                      constraints=constraints)

    # Display the results in a more readable format (e.g., JSON)
    results_dict = {
        "Optimal_values": {
            "x": result.x[0],
            "y": result.x[1],
            "z": result.x[2]
        }
    }

    print(results_dict)
