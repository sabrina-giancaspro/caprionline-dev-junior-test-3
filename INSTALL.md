# Installazione e configurazione dell'ambiente di sviluppo

## Introduzione
Benvenuto nelle istruzioni per configurare il tuo ambiente di sviluppo utilizzando Symfony e React all'interno di un ambiente Dockerizzato. Questo progetto è suddiviso in due sotto-progetti principali: il backend, sviluppato con Symfony, e il frontend, realizzato con React. Ogni sotto-progetto ha il proprio container Docker, garantendo che le dipendenze e le configurazioni siano isolate e specifiche per ogni parte dell'applicazione. Queste linee guida ti guideranno attraverso i passaggi necessari per configurare entrambi gli ambienti e iniziare lo sviluppo.

## Prerequisiti
Prima di iniziare, assicurati di avere installato Docker e Git sul tuo computer. Se non li hai già installati, puoi scaricare Docker dal sito ufficiale https://www.docker.com/products/docker-desktop e Git dal sito ufficiale https://git-scm.com/downloads.

## Fork e setup iniziale
Effettua il fork di questo repository tramite [questo link](https://github.com/caprionlinesrl/caprionline-dev-junior-test-3/fork) oppure cliccando sul pulsante "Fork" nella pagina del repository su GitHub. In questo modo verrà creata una copia del repository all'interno del tuo account GitHub, sulla quale potrai lavorare liberamente.

## Clonazione del repository
Dopo aver effettuato il fork, clona il repository sul tuo computer e configura i tuoi dati Git:
```
git clone https://github.com/GITHUB_ACCOUNT/caprionline-dev-junior-test-3.git
cd caprionline-dev-junior-test-3
git config user.email username@dominio.com
git config user.name "Nome Cognome"
```

## Configurazione dell'Ambiente
Il progetto è suddiviso in due componenti principali: il backend e il frontend, ciascuno con il proprio container Docker. Segui questi comandi per configurare e avviare entrambe le parti:

Apri un terminale ed esegui i seguenti comandi per la configurazione del backend:

```
cd backend
docker compose up -d
docker compose exec --user php --workdir /app php bash
composer install
./scripts/db_init.sh
symfony server:start -d
```

Apri un altro terminale ed esegui i seguenti comandi per la configurazione del frontend:

```
cd frontend
docker compose up -d
docker compose exec --user node --workdir /app node bash
npm install
npm run dev
```

### Spiegazioni dei Comandi
- `docker compose up -d`: Avvia i container Docker definiti nel file docker-compose.yml, isolando l'ambiente di sviluppo e garantendo che tutte le dipendenze siano correttamente configurate.
- `docker compose exec --user USER --workdir /app USER bash`: Apre una shell all'interno del container Docker, permettendoti di eseguire comandi direttamente nell'ambiente di sviluppo.
- `composer install` e `npm install`: Installano le dipendenze necessarie per il backend e il frontend, rispettivamente.
- `./scripts/db_init.sh`: Inizializza il database con le tabelle e i dati necessari per il progetto.
- `symfony server:start -d` e `npm run dev`: Avviano i server per il backend e il frontend, rendendo le applicazioni accessibili attraverso i browser.

## Accesso all'Applicazione
- Frontend: http://localhost:5173
- Backend: http://localhost:8000
- phpMyAdmin: http://localhost:8080
