Symfony POC Phoenix
========================

Requirements
------------

* PHP 8.0.2 or higher;
* and the usual Symfony application requirements.

Installation
------------

```bash
$ git clone
```
Installation des dépendances PHP
```bash
$  composer install
```
Installation des dépendances JS

```bash
$ yarn install ou npm install
```

Compilation des assets
```bash
$ yarn dev
```
Modification du .env

Création de la base de données
```bash
$ symfony console d:d:c
```
Exécution des migrations 
```bash
$ symfony console d:m:m
```

Si problème dans les migrations : 
```bash
$ symfony console d:s:u --force
```

Exécution des fixtures 
```bash
$ symfony console d:f:l
```
Lancement du serveur 
```bash
$ symfony serve
```

PS
------------
* L'admin a pour username : `root@phoenix.com` et pour mot de passe : `rootroot`
* Le mot de passe des autres utilisateurs est : `Testtest123`
* L'entité User est inutile, j'avais complètement raté mes entités initialement et ça m'aurait pris trop de temps de supprimer le tout
* L'entité Admin remplace l'entité User