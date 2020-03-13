# Projet symfony réalisé en groupe de 3 

- Ionas NEONAKIS
- Mahafaly RANDRIAMIARISOA
- Samir TOULARHMINE

__Il existe 9 branches au total__ : 
* q2 pour la question 2 : Création des Entités
* q3 pour la question 3 : Création de la base de données
* q4 pour la question 4 : Création des fixtures pour remplir la base de données
* q5 pour la question 5 : Visualisation des semestres et cours
* q6 pour la question 6 : Ajout de la navbar et du css
* q7 pour la question 7 : Ajout la modification, création et suppression des cours et semestres
* q8 pour la question 8 : Modification des descirptions des cours en markdown
* q9 pour la question 9 : Ajout des services
* **Master pour le projet fini**

Pour la réalisation du projet on a chacun fait le projet dans notre coin puis on a décidés de garder celui-ci : version Ionas NEONAKIS

Les commandes  :

Installer les dependances:
```composer install```

Créer la base de données:
```php bin/console doctrine:migrations:migrate```

Lancer les fixtures:
```php bin/console doctrine:fixtures:load```

installer le certificat:
```symfony server:ca:install```

Lancer le serveur:
```symfony server:start```

