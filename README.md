# Project Week - SPACE

## Requirements

- Docker
- Docker Composer
- Docker Machine
- Port 12000-12003 availables
- A brain
- Some Kibana knowledge for debugging/monitoring

## Docker

### Usage

First, clone this repository:

```bash
git clone git@github.com:QRaimbault/SI_ESPACE.git
```

Move into the symfony directory (cd SI_ESPACE/symfony) then run:

```bash
composer install
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