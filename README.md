# DogLovers

## Qu'est-ce que DogLovers ?
Dog Lovers est un site de rencontre pour les amoureux de nos amis à 4 pattes, il vient en réponse au projet de fin d'année de Web PREPA2.

## Mettre en place DogLovers

Modifier la configuration php.ini - DogLovers utilise une configuration php modifiée, merci de changer dans le fichier php.ini les champs suivants

```txt
    post_max_size = 36M
    upload_max_filesize = 8M
```
(pensez à mettre le serveur à l'heure aussi...)


Démarrer le serveur local.
Une fois à la racine de doglovers (/doglovers),
 
```bash
    > php -S localhost:8080
```

## Utiliser DogLovers

    Ouvrir "index.php" dans votre navigateur.

    Toute personne non-connectée ne pourra pas accéder à la moindre page exceptée "login.php", sur laquelle il pourra se créer un compte "membre"

    DogLovers utilise un système de hierarchie.

    -> Administrateur (admin) 
        \-> Membre (free) -- Abonné (member)
            \-> Visiteur (noRole)
            
    Le Visiteur ne peut rien faire sur le site, hormis se créer un compte Membre (free).
    Le Membre aura accès au fonctionnalités de base, pourra rechercher et visualiser des profils.
    L'Abonné pourra en plus communiquer avec les autres utilisateurs.
    L'Administrateur peut en plus, gérer les profils et les actions des Membres et Abonnés.


## Connexion

### en tant que Membre...

Les mot de passe sont salés et hashés en utilisant BCrypt, ils sont ensuite stockés dans "/register/data/userList.txt"  


Pour vous connecter en tant que "Membre", il vous faut un compte "Membre" vous pouvez en créer un via la page de création de compte, disponible depuis la page login.php ou alors directement à l'adresse suivante : "/register/register.php" - voici néanmoins un compte membre déjà crée :


id : Sah

pw : test123


Pour vous connecter en tant que "Abonné" il faut que le compte souscrive à un abonnement, pour cela, rendez-vous une fois connecté sur la page "/home/subscribe/subscribe.php", et selectionnez un abonnement - voici néanmoins un compte abonné déjà crée : 

id : Richie

pw : youpi123

### en tant qu'Admin... 

Un seul identifiant existe pour se connecter comme "Administrateur", mais vous pourrez ensuite, via le panel d'administration, ajouter d'autres Administrateurs.

id : SuperMan

pw : bogoss123

## Contribution

Auteurs :
BORDIS Thomas (bordisthom@eisti.eu)

LE BRONEC Louve (lebroneclo@eisti.eu)

LECUPPE Robin (lecupperob@eisti.eu)

LEFLOCH Thomas (leflochtho@eisti.eu)

MADRELLE Alexis (madrelleal@eisti.eu)


GitLab : https://gitlab.etude.eisti.fr/leflochtho/poudlarel
