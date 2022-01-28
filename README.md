![AOST logo](/img/logo.png)

# `Alpha Omega Solutions Travail - AOST`

## A propos
Ce projet consiste à concevoir et dévélopper le site web de l'entreprise québécoises **Alpha Omega Solutions Travail Inc.**
Aost est une plateforme de placement d'employés en proposant des **catalogues d'emplois** réguliers.

## Lien du site web
[alphaomegasolutionstravail.ca](https://alphaomegasolutionstravail.ca/)

## Structure du projet
Le projet repose sur une architecture MVC (Model Vue Controleur)

### `/header/`
Contient l'en-tête (la balise `<head>`)

### `/img/`
Ici sont stocquées toutes les images du projet

### `/outils/`
Ici sont stocquées toutes les dépendances (framework, css, js, php, ...) du projet ainsi que son backend

### `/db/`
On poura trouver les fichiers de connection à la db

### `/class/`
On poura trouver les classes du model(Mvc)

### `/dashboard/`
Il s'agit des pages du côté admin d'AOST

### Bon à savoir
Tous les autres dossiers situés à la racine du projet représentent son contenu( vue du model mVc ). 

**Exemple :**
- `/job/` : page Emploi
- `/footer/` : pied de page

Chaque Vues est contituée :
  * d'un fichier 'index'
  * d'un fichier 'contenu' ayant le même nom que son dossier parent
  * d'un fichier css
  * d'un fichier js

**Exemple:** pour le dossier job, on aura
  * index.php
  * job.php (cotenu)
  * job.css
  * job.js

## A propos des auteurs
- [Donald NKOUATHIO](https://github.com/donaldnkouathio) (Front end)
- [Dimitri BEYENE](https://github.com/Ego-Buster) (Back end)

*Documentation écrite par **Donald NKOUATHIO***
