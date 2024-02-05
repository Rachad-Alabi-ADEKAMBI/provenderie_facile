from scipy.optimize import minimize

# Définir la fonction objectif à minimiser
def objective_function(variables):
x, y, z = variables
# Fonction à minimiser - dans ce cas, la somme des carrés des différences entre les équations
return (x + y + z - 10)**2 + (x - 4)**2 + (y - 6.5)**2 + (z - 7.5)**2

# Définir les contraintes
constraints = ({'type': 'ineq', 'fun': lambda x: x[0] - 3}, # 3 < x {'type': 'ineq' , 'fun' : lambda x: 5 - x[0]}, # x <
    5 {'type': 'ineq' , 'fun' : lambda x: x[1] - 4}, # 4 < y {'type': 'ineq' , 'fun' : lambda x: 9 - x[1]}, # y < 9
    {'type': 'ineq' , 'fun' : lambda x: x[2] - 3}, # 3 < z {'type': 'ineq' , 'fun' : lambda x: 12 - x[2]}, # z < 12
    {'type': 'eq' , 'fun' : lambda x: x[0] + x[1] + x[2] - 10}) # x + y + z=10 # Spécifier les valeurs initiales
    initial_guess=[3, 4, 3] # Utiliser le solveur d'équations non linéaires result=minimize(objective_function,
    initial_guess, constraints=constraints) # Afficher les résultats print("Valeurs optimales pour x, y et z :",
    result.x)