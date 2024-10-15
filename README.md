
# Provenderie Facile

**Provenderie Facile** est une application web développée avec Flask (Python) qui aide à créer des combinaisons optimisées de provende pour les animaux de ferme. En se basant sur les ingrédients disponibles et les besoins nutritionnels spécifiques, l'application propose des solutions adaptées pour différents types d'animaux.

## Fonctionnement

1. **Sélection de l'animal**  
   Sur la page d'accueil, choisissez l'animal pour lequel vous souhaitez créer des combinaisons de provende.
   
2. **Choix des ingrédients**  
   Sur la page suivante, sélectionnez les ingrédients dont vous disposez. L'application utilisera ces éléments pour générer les meilleures combinaisons.

3. **Affichage des résultats**  
   L'algorithme analyse les besoins nutritionnels et propose une liste de combinaisons optimales en fonction des ingrédients sélectionnés.

## Démarrer le projet

### Prérequis

- Python 3.x
- Flask
- Pip

### Étapes pour lancer le projet localement

1. **Cloner le dépôt**
   ```bash
   git clone <URL_du_dépôt>
   cd provenderie-facile
   ```

2. **Créer un environnement virtuel (optionnel mais recommandé)**
   ```bash
   python -m venv venv
   source venv/bin/activate  # Sur Windows : venv\Scripts\activate
   ```

3. **Installer les dépendances**
   ```bash
   pip install -r requirements.txt
   ```

4. **Importer la base de données**
   - Un fichier SQL de démarrage est disponible dans le dossier `sql`. Vous pouvez l'importer dans votre base de données MySQL en utilisant la commande suivante :
     ```bash
     mysql -u <username> -p <database_name> < sql/your_file.sql
     ```

5. **Lancer l'application**
   ```bash
   flask run
   ```

6. **Accéder à l'application**  
   Rendez-vous sur [http://127.0.0.1:5000](http://127.0.0.1:5000) dans votre navigateur pour accéder à l'application.

## Contribuer

Les contributions sont les bienvenues ! Si vous souhaitez apporter des améliorations ou signaler un problème, veuillez soumettre une **issue** ou créer une **pull request**.

## Auteur

**Rachad Alabi ADEKAMBI**

- [Portfolio](https://rachad-alabi-adekambi.github.io/portfolio/)
- [LinkedIn](https://www.linkedin.com/in/rachad-alabi-adekambi-2753a21b5/)
- [GitHub](https://github.com/Rachad-Alabi-ADEKAMBI/)