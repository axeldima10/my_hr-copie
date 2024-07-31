# Application de Suivi des Candidatures (ATS) - Symfony

## Description

Cette application de suivi des candidatures (ATS) est développée avec Symfony pour faciliter la gestion des recrutements. Les candidats peuvent soumettre leurs candidatures via un formulaire en ligne, tandis que les responsables des ressources humaines (RH) peuvent filtrer les candidatures en fonction de divers critères.

## Fonctionnalités

### Pour les Candidats
- **Soumission de Candidature** : Les candidats peuvent remplir un formulaire de candidature avec leurs informations personnelles, expérience, compétences, et le poste souhaité.
- **Confirmation de Soumission** : Recevoir une confirmation de la soumission de la candidature.

### Pour les Responsables RH
- **Gestion des Candidatures** :
  - **Filtrage** : Filtrer les candidatures par :
    - Expérience
    - Intitulé de poste
    - Compétences
    - Statut de la candidature (Accepté, Refusé, En cours de traitement)
  - **Vue Détail** : Visualiser les détails de chaque candidature.
  - **Mise à Jour du Statut** : Mettre à jour le statut des candidatures.

## Installation

1. **Cloner le Dépôt** :
   ```bash
   git clone https://github.com/axeldima10/my_hr-copie.git
2. **Installer les Dépendances** :
   Assurez-vous d'avoir Composer installé, puis exécutez :
   ```bash
   cd votrerepository
   composer install
3. Configurer l'Environnement :
  Renommez .env.example en .env et configurez vos paramètres de base de données.
   ```
   php bin/console doctrine:database:create
   php bin/console doctrine:schema:update --force
4. Exécutez les migrations :
   ```
     php bin/console doctrine:migrations:migrate
6. Lancer l'application
   ```
   symfony server:start
   
## Technologies
- Symfony
- Doctrine ORM
- Twig
- Composer
 
