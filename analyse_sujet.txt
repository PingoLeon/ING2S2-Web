Deja avant de commencer a chercher des images ou qql chose qui n'est pas prioritaire, il faut analyser le sujet.

Sur la page principale, il y a 6 choses a voir:
- Accueil
	==> Page principale (Homepage)
	==> Introduction, calendrier etc
	==> Posts
	==> Contactez nous
- Mon Reseau
	==> Liste des amis (nom + photo + intro)
- Vous
	==> Le profil
	==> Mon CV, Projets, Education...
- Notifications
	==> Apparition de evenements a venir et/ou nouveautes des amis
- Messagerie
	==> WhatsApp
	==> Visio
- Emplois
	==> Notifs sur job emploi


On peut donc essayer de separer en plusieurs sous-taches differentes dans le front-end et dans le back-end:

*CREATION DE COMPTE ET GESTION DE LOGIN NIVEAU ADMIN*
- Creation de compte user
	==> TABLE CREATE (SQL)
	==> GForms d'inscriptions (Frontend: HTML CSS, Backend: PHP)
- Login
	==> GForms de connection (Frontend: HTML CSS, Backend: PHP)
- Gestion de mot de passe
	==> Mot de passe
	==> Je vais essayer de retrouver mon projet de gestion de mot de passe et de BDD avec HTML/PHP de Terminale NSI

- Gestion de compte admin
	==> Admin = DELETE / INSERT de nouveau personnes
	==> Non-admin = Little to none admin access


*GESTION DE PROFILE ET DU RESEAU*

- Frontend: Creation de page avec HTML CSS (https://bloc.digital/assets/news-and-insights/linkedin-personal-profile-bloc-digital.png)

- UPDATE / INSERT donnees sur profile (Frontend: HTML CSS, Backend: PHP)

- Gestion du profile des ami(e)s dans le reseau
- Gestion du creation de CV


*GESTION DES POSTS ET EVENEMENTS*

- FRONTEND: Page principale avec affichage des posts, HTML
- FRONTEND: Bouton pour creation / mise-a-jour de posts
- BACKEND: PHP pour CREATE / UPDATE posts
- Gestion des evenements
	==> Affichage du calendrier des events
- Gestion des emplois
	==> Affichage de la liste des emplois que nous pouvons postuler

*MESSAGERIE ET NOTIFS*

- WhatsApp
- Gestion de notifications pour messagerie/demande_amis/offre_emploi
- Visio






FRONTEND:

HTML, CSS, Javascript

+ Utilisation de Bootstrap pour le styling et JQuery pour Javascript


BACKEND: PHP

BDD: SQL