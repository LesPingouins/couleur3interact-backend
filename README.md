<a name="retour-en-haut"></a>
<h1 align="center">
  <br>
    
  <a href="http://www.amitmerchant.com/electron-markdownify"><img src="https://i.ibb.co/vchLtJP/color-noir-interact-vertical.png" alt="Markdownify" width="200"></a>
  <br>
  Couleur 3 Interact / Back-end
  <br>
</h1>

<h4 align="center">Back-end pour l'application Couleur 3 Interact.
    <br><br>
    <a href="https://github.com/LesPingouins/couleur3interact-frontend" target="_blank">Voir le front-end</a>
</h4>

<p align="center">
  <a href="#a-propos">À propos du projet</a> •
  <a href="#installation">Installation</a> •
  <a href="#utilisation">Utilisation</a> •
  <a href="#roadmap">Roadmap</a> •
  <a href="#contact">Contact</a> •
</p>


## A propos
Dans le cadre du projet d'articulation de la HEIG-VD en Ingénierie des Médias. Notre équipe a fait le choix de travailler sur un projet de la RTS, plus précisément celui de la radio Couleur 3. 

L'objectif, imaginer la radio du futur, celle que nous aimerions construire et comment elle pourrait interagir avec son public.

Sur cette base nous avons alors développé une application de chat portable, qui pourrait se greffer sur n'importe quel site à l'aide de la balise iFrame.

Ce back-end permet de faire fonctionner le chat grâce aux websockets (Pusher) mais aussi de faire la connexion avec la base de données. Il possède aussi une mini-application permettant de gérer le chat via plusieurs fonctionnalités. 

<p align="right">(<a href="#retour-en-haut">retour en haut</a>)</p>

## Installation
Pour cloner cette application, vous aurez besoin de [Git](https://git-scm.com/downloads), [Composer](https://getcomposer.org/download/), [Node.js](https://nodejs.org/en/download/) (qui vient avec [npm](http://npmjs.com)) et d'un serveur [PostgreSQL](https://www.postgresql.org/download/) installés sur votre ordinateur. Ensuite, exécutez ces lignes de commandes.

```bash
# Cloner le repo
$ git clone https://github.com/LesPingouins/couleur3interact-backend

# Aller dans le répertoire
$ cd couleur3interact-backend

# Installation des dépendances
$ composer i
$ npm i
```

Il vous faudra ensuite créer le fichier .env à la racine du projet

Exemple provenant du repo de laravel : [.env](https://github.com/laravel/laravel/blob/10.x/.env.example)

Générez ensuite une clé d'application

```bash
# Génération de la clé
$ php artisan key:generate
```

Modifiez ensuite dans le .env vos informations de connexion à votre base de données PGSQL.

```bash
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=[Votre base de données]
DB_USERNAME=[Votre nom d'utilisateur]
DB_PASSWORD=[Votre mot de passe]
```

Dans certains cas, il se peut que vous n'ayez pas activé l'extension pgsql dans votre php.ini. Pour l'activer, rendez-vous dans votre fichier php.ini et trouvez la ligne de l'extension qui est en commentaire : ";extension=pgsql"

Configurez aussi Pusher dans le .env afin que le chat puisse fonctionner.
```bash
PUSHER_APP_ID=local
PUSHER_APP_KEY=local
PUSHER_APP_SECRET=local
PUSHER_HOST=127.0.0.1
PUSHER_PORT=6001
PUSHER_SCHEME=http
PUSHER_APP_CLUSTER=mt1
```

Exécutez ensuite les migrations et les seeders

```bash
# Exécuter les migrations
$ php artisan migrate

# Exécuter les seeders
$ php artisan db:seed
```

Lancez ensuite les différents serveurs. Cela doit être exécuté dans plusieurs terminaux.
```bash
# Lancer le back-end
$ php artisan serve
$ npm run dev
$ php artisan websockets:serve
```
<p align="right">(<a href="#retour-en-haut">retour en haut</a>)</p>

## Utilisation
Pour utiliser le back-end, rendez-vous ensuite sur un navigateur et entrez : http://127.0.0.1:8000/login

Connectez-vous ensuite à l'aide de l'adresse mail d'un des utilisateurs qui a été généré dans votre base de données. 
Le mot de passe associés aux utilisateurs est : "password" 😉

Il se peut qu'en fonction de l'ordre d'exécution des serveurs l'iFrame du chat ne fonctionne plus.

Pour régler ce soucis, rendez-vous dans "resources/views/dashboard.blade.php". Retrouvez ensuite la balise iFrame et remplacez le src par le lien du front-end.

Vous pourrez alors gérer une partie du chat, pour voir les fonctionnalités possibles : <a href="#roadmap">Roadmap</a>

Pour profiter pleinement de l'expérience Couleur 3, utilisez le [Couleur 3 Interact / Front-end](https://github.com/LesPingouins/couleur3interact-frontend) fourni par notre équipe. 

<p align="right">(<a href="#retour-en-haut">retour en haut</a>)</p>

## Roadmap
- [x] Gestion des utilisateurs
    - [x] Ajout
    - [x] Modification
    - [x] Suppression
    - [ ] Bannissement
- [x] Gestion des sondages
- [x] Gestion des concours
    - [x] Affichage
    - [ ] Ajout
    - [ ] Modification
    - [ ] Suppression
- [x] Gestion des rôles
    - [x] Affichage
    - [ ] Ajout
    - [ ] Modification
    - [ ] Suppression
- [ ] Gestion des annonces
- [ ] Gestion du chat
- [ ] Gestion des paramètres (Notifications, Dark mode, ...)
- [ ] Gestion des permissions

<p align="right">(<a href="#retour-en-haut">retour en haut</a>)</p>

## Contact
La team Pingouin - HEIG-VD - Ingénierie des Médias

Back-end : [Couleur 3 Interact / Back-end](https://github.com/LesPingouins/couleur3interact-backend)
<br>
Front-end : [Couleur 3 Interact / Front-end](https://github.com/LesPingouins/couleur3interact-frontend)

<p align="right">(<a href="#retour-en-haut">retour en haut</a>)</p>
