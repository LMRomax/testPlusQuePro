<p align="center">
    <strong>
        Test Plus Que Pro | Lemaitre Maxence
    </strong>
</p>

## Installation

Afin d'installer le projet, veuillez récupérer le projet en copiant la ligne suivante :

##
<tab><tab>git clone https://github.com/LMRomax/testPlusQuePro.git

Quand le projet est récupéré paramétrer votre fichier .env (un fichier .env.example est disponible, les informations d'accès 
à la BDD dockeriser sont déjà mise en place) puis commencer l'installation des dépendances en copiant/collant la ligne suivante dans votre terminal/console :

##
<tab><tab>composer install

Une fois la commande terminée, lancez un build de npm :

##
<tab><tab>npm run build

Afin de dockeriser le projet lançait la commande :

##
<tab><tab>./vendor/bin/sail up

Puis afin de lancer les migrations dans la BDD lancer la commande : 

##
<tab><tab>./vendor/bin/sail artisan migrate

C'est tout bon, le projet est installé. Nous allons maintenant pouvoir l'initialiser.

## Initialisation du projet.

Maintenant que l'application est installée, nous allons pouvoir dans un premier créer un utilisateur. 
Pour cela, placez-vous à la racine du projet et lancez la commande :

##
<tab><tab>./vendor/bin/sail user:create

Suivez les indications affichées à l'écran. Nous avons créé un user. Les informations fournies 
nous permettrons de se connecter à l'interface.

Remplissons désormais la table des films. Nous pouvons lancer la commande ./vendor/bin/sail artisan app:get-movies.
Cette commande attend un paramètre. Les deux possibilités sont day et week. Cela permet de récupérer les films
populaire de la période renseignée.

Vous pouvez pour récupérer les films populaire du jour la commande : 
##
<tab><tab>./vendor/bin/sail artisan app:get-movies day

Et pour la semaine 
##
<tab><tab>./vendor/bin/sail artisan app:get-movies week

Des tâches planifiées sont également mis en place pour mettre à jour automatique les films de la journée/semaine.

Et voilà, vous pouvez désormais naviguer au sein de l'application.

## Recherche et aide utilisées dans le développement.

Les sources utilisées dans le développement ont principalement été les documentations officielles
des différents packages Laravel ainsi que de Laravel lui-même.

La liste des sources consultées :

<a href="https://laravel.com/docs/11.x">Laravel 11</a>
<a href="https://livewire.laravel.com/">Livewire 3</a>
<a href="https://jetstream.laravel.com/introduction.html">Jetstream</a>
<a href="https://laravel.com/docs/11.x/sail">Laravel Sail</a>
<a href="https://learn.microsoft.com/fr-fr/windows/wsl/install">Installation de WSL2 (Nouvelle machine oblige)</a>

## Demande d'informations complèmentaires

En cas de soucis n'hésitez pas à me contacter via l'adresse : 
<a href="mailto:maxencectmd.lemaitre@gmail.com">maxencectmd.lemaitre@gmail.com</a>
ou par téléphone : 
<a href="tel:0626237181">06 26 23 71 81</a>
