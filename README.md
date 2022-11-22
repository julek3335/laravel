## Opis
projekt składa się z:
- aplikacji laravel port 8000
- bazy danych mariadb port 3306
- adminera port 8080

## Instrukcja uruchomienia przy pomocy skryptu PowerShell
```PowerShell
curl https://raw.githubusercontent.com/julek3335/laravel/PI-81-zrobienie-skryptu-uruchamiajacego-komendy/autorun.ps1 -O autorun.ps1

.\autorun.ps1
```

## Instrukcja uruchomienia po raz pierwszy
### Linux
```bash
git clone https://github.com/julek3335/laravel.git

cd laravel/

rm -rf project

docker compose up #uruchomienie moze trwać 2-3 min

Ctrl-C

git restore .

docker compose up
```
### Windows
```cmd
git clone https://github.com/julek3335/laravel.git

cd laravel/

rmdir project

docker compose up  #uruchomienie moze trwać 2-3 min

Ctrl-C

git restore .

docker compose up
```
### Instalacja modułów

Linux & Windows
Wykonujemy tylko za pierwszym razem (po stworzeniu kontenerów).

```bash
docker exec -it laravel-myapp-1 bash -c "composer require xvladqt/faker-lorem-flickr; composer require jeroennoten/laravel-adminlte ; php artisan adminlte:install -n; composer require laravel/breeze --dev; php artisan breeze:install;npm install; npm run dev"
^C

git restore . #Usuwamy z repo dodane po instalacji modułów pliki

git clean -f #Usuwamy  z repo dodane po instalacji modułów pliki

```

## Ustawienie ścieżki storage
```bash
docker exec -it laravel-myapp-1  php artisan storage:link
```

## Migracja i seed
```
docker exec -it laravel-myapp-1 bash -c "php artisan migrate:fresh --seed"
```

## Interkcja z kontenerem:
Uruchomienie pojedyńczego polecenia
```bash
docker exec <laravel container id> <polecenie>
# np.
docker exec 544363 php artisan migrate:fresh
```
Uruchomienie wiersza poleceń w kontenerze:
```bash
docker exec -it <laravel container id> /bin/sh
bash
```
Budowanie styli (na produkcję)
```bash
docker exec -it laravel-myapp-1 bash -c "npm run build"
```
Budowanie styli podczas developmentu
```bash
docker exec -it laravel-myapp-1 bash -c "npm run dev"
```

## Wykorzystane biblioteki
- AdminLTE - szata graficzna aplikacji - https://github.com/jeroennoten/Laravel-AdminLTE/