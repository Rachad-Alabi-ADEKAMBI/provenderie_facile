from scipy.optimize import minimize

# Définir la fonction objectif à minimiser


def objective_function(variables):
    x, y, z = variables
    # Fonction à minimiser - dans ce cas, la somme des carrés des différences entre les équations
    return (x + y + z - 10)**2 + (x - x_min)**2 + (y - y_min)**2 + (z - z_min)**2


# Définir les contraintes
constraints = ({'type': 'ineq', 'fun': lambda x: x[0] - x_min},    # x_min < x
               {'type': 'ineq', 'fun': lambda x: x_max - x[0]},    # x < x_max
               {'type': 'ineq', 'fun': lambda x: x[1] - y_min},    # y_min < y
               {'type': 'ineq', 'fun': lambda x: y_max - x[1]},    # y < y_max
               {'type': 'ineq', 'fun': lambda x: x[2] - z_min},    # z_min < z
               {'type': 'ineq', 'fun': lambda x: z_max - x[2]},    # z < z_max
               {'type': 'eq', 'fun': lambda x: x[0] + x[1] + x[2] - 10})  # x + y + z = 10

# Spécifier les valeurs initiales
initial_guess = [(x_min + x_max) / 2, (y_min + y_max) / 2, (z_min + z_max) / 2]

# Utiliser le solveur d'équations non linéaires
result = minimize(objective_function, initial_guess, constraints=constraints)

# Afficher les résultats
print("Valeurs optimales pour x, y et z :", result.x)
