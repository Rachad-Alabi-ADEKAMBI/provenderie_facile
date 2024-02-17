from scipy.optimize import minimize

# Define the bounds for variables
item1QtyMin, item1QtyMax = 0, 70
item2QtyMin, item2QtyMax = 0, 30
item3QtyMin, item3QtyMax = 0, 20
total = 100  # Total quantity

# Define the objective function to minimize


def objective_function(variables):
    item1Qty, item2Qty, item3Qty = variables
    return (item1Qty + item2Qty + item3Qty - total)**2 + (item1Qty - item1QtyMin)**2 + (item2Qty - item2QtyMin)**2 + (item3Qty - item3QtyMin)**2


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
result = minimize(objective_function, initial_guess, constraints=constraints)

# Display the results
print("Optimal values for item1Qty, item2Qty, and item3Qty:", result.x)
