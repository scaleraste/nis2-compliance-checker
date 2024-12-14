
# NIS 2 Compliance Checker

NIS 2 Compliance Checker è un'applicazione web in grado di valutare la conformità di un'organizzazione alla normativa europea NIS 2 (Directive EU 2022/2555) per garantire un elevato livello di cybersicurezza.


## Requisiti per l'installazione:

- Installare distro Ubuntu 22.04 su macchina virtuale (WSL2) <br>
  https://learn.microsoft.com/it-it/windows/wsl/install

- Installare ed avviare Docker Desktop (assicurandosi di aver attivato dalle impostazioni l'integrazione WSL2 della distro installata) <br>
  https://www.docker.com/products/docker-desktop/

- Scaricare il codice sorgente e copiare la cartella "nis2-compliance-checker-main" in: Ubuntu\home\nome_utente\

- Aprire il terminale della macchina virtuale e digitare ```cd nis2-compliance-checker-main``` per posizionarsi all’interno della cartella ed eseguire i seguenti script:


## Installare le dipendenze:
```
docker run --rm \
-u "$(id -u):$(id -g)" \
-v "$(pwd):/var/www/html" \
-w /var/www/html \
laravelsail/php83-composer:latest \
composer install --ignore-platform-reqs
```

## Installare Laravel Sail:
```
./vendor/bin/sail artisan sail:install
```

## Building del container docker:
```
./vendor/bin/sail up -d
```

## Installare le dipendenze JS:
```
./vendor/bin/sail npm install
```

## Eseguire la migrazione e il seeding del database:
```
./vendor/bin/sail artisan migrate --seed
```
