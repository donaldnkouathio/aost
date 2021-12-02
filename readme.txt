	/********************************/
	/*								*/
	/*	   Structure du projet		*/
	/*  écrit par Donald NKOUATHIO  */
	/*                              */
	/********************************/

	1) dossier /img
	Ici seront stocquées toutes les images du projet

	2) dossier /outils
	Ici seront stocquées toutes les dépendances (framework, css, js,...) du projet ainsi que son backend

	3) dossier /outils/db
	On poura trouver le fichier de connection à la db, les classes du model(Mvc), ...

	4) dossier /outils/php
	tous les fichier de traitement( controleur du mvC ), exemple: loginTraitement.php( traitement du formulaire de connexion )

	5) dossier /outils/fonts
	toutes les polices d'écritures

	6) dossier /outils/frameworks
	tous les frameworks

	7) dossier /outils/css et dossier /outils/js
	fichiers css et fichiers js commun à toutes les pages


	Tous les autres dossiers situés à la racine du projet représentent son contenu( vue du model mVc ). Exemple :

	8) dossier /home : page d'accueil

	9) dossier /job : page Emploi

	NB: Chaque Vues est contituée :
		-d'un fichier 'index'
		-d'un fichier 'contenu' ayant le même nom que son dossier parent
		-d'un fichier css
		-d'un fichier js

	Exemple: pour le dossier job, on aura
		-index.php
		-job.php (cotenu)
		-job.css
		-job.js

		dnk
