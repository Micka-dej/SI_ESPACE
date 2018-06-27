#!/bin/sh
maxcounter=90

counter=1

mysql_ready() {
    mysqladmin ping -h db --port $MYSQL_PORT -u$MYSQL_USER -p$MYSQL_PASSWORD > /dev/null 2>&1
}

echo "[INFO] Waiting for MySQL to start to create schema."

while !(mysql_ready) do
    sleep 1
    counter=`expr $counter + 1`
    if [ $counter -gt $maxcounter ]; then
        echo "[ERROR] We have been waiting for MySQL too long already; failing."
        exit 1
    fi;
done

echo "[INFO] MYSQL STARTED"

/var/www/symfony/bin/console doctrine:schema:create
/var/www/symfony/bin/console doctrine:fixtures:load

echo "[INFO] DOCTRINE OK"

tail -f /dev/null