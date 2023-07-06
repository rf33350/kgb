# Déploiement du site KGB - Studi

Ce fichier a pour but de décrire la démarche à suivre pour le déploiement en local et en ligne du projet

## Tech Stack

**Front** HTML + CSS + JS + Bootstrap

**Back** PHP 8.1 

**Base de données** MySQL 


## Deploiement local

Pour déployer ce site en local, il faut tout d'abord récupérer la dernière version à jour:

```bash
  git clone https://github.com/rf33350/kgb
```

Il faut ensuite créer la base de donnée qui hébergera les données du site.

```bash
  /*Creation de la base de données kgb*/
CREATE DATABASE IF NOT EXISTS kgb CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
```

Sinon restaurer la base de données avec l'archive.

```bash
  mysql -u root -p kgb < backup_kgb.sql
```

Assurez vous que les paramètres de connexion sont bons:

```bash
  <?php
    //fichier de config pour la com bdd
    return [
        'db_name' => 'XXX',
        'db_user' => 'YYY',
        'db_password' => 'ZZZ',
        'db_port' => '3306',
        'db_host' => 'localhost',
    ];
```

Puis lancez votre serveur local (Xammp ou autre).

## Support

Pour tout besoin d'aide me contacter par [ce mail](mailto:djaroul@hotmail.fr).