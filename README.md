# Projet symfony réalisé en groupe de 3 

- Ionas NEONAKIS
- Mahafaly RANDRIAMIARISOA
- Samir TOULARHMINE

Vous pouvez utiliser la barre de recherche pour chercher les cours et les semestres plus facilement.

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

Pour la réalisation du projet, après concertation, au vu de la taille du projet et afin de se préparer au mieux à l'examen, nous avons décidé de faire un projet chacun. Nous avons ensuite décidé de garder celui-ci.

Pour pouvoir lancer le serveur, il faut **PHP 7.4** soit la dernière version de PHP, dans le cas contraire il vous faudra exécuter la commande  ```composer dump-autoload``` avant d'exécuter les commandes suivantes :

Installer les dependances:
```composer install```

Créer la base de données:
```php bin/console doctrine:migrations:migrate```

Lancer les fixtures:
```php bin/console doctrine:fixtures:load```

Installer le certificat:
```symfony server:ca:install```

Lancer le serveur:
```symfony server:start```

---------------------------------------

En cas de problème avec ```composer install``` : 

installez php7.4 :
```sudo apt install php7.4```

Installez l'extension php xml:
```sudo apt-get install php7.4-xml```

---------------------------------------

En cas de problème avec les drivers sqlite3 tapez :
sudo apt install ```php7.4-sqlite```
