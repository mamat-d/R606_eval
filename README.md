# R606_eval

Projet d'évaluation de Maintenance Applicative

Lancer le projet :

```bash
docker compose up -d --build
```

`Le serveur web se lance à l'adresse suivante : localhost:8000`

Exécuter les tests unitaires (PHPUnit) :

```bash
vendor/bin/phpunit
```

Executer le scan PHPStan :

```bash
vendor/bin/phpstan analyse
```

Les données initiales sont gérées par la migration SQL [init-db/migrations/001_init.sql](init-db/migrations/001_init.sql), exécutée automatiquement au démarrage de MySQL.

Pour provoquer l'initialisation (table + données), il faut supprimer le volume MySQL puis le relancer :

```bash
docker compose down -v
docker compose up -d --build
```
