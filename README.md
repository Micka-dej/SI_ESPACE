# Project Week - SPACE

We use Docker as a development environment.

## Docker

### Usage

First, clone this repository:

```bash
git clone git@github.com:QRaimbault/SI_ESPACE.git
```

Then, run:

```bash
docker-compose up -d
```

You are done, you can visit the Symfony application on the following URL: `http://symfony.localhost:12000` (and access Kibana on `http://symfony.localhost:12001`)

_Note :_ you can rebuild all Docker images by running:

```bash
docker-compose build
```

### Logs

You can access Nginx and Symfony application logs in the following directories on your host machine:

- `logs/nginx`
- `symfony/var/log`

## Team

**Chrystelle POULET**  
**Vincent MARLOT**  
**Thomas FRANJA**  
**Hichem AMAR BENSABER**  
**Mickael DE JESUS**  
**Quentin RAIMBAULT**