## Opis
projekt składa się z:
- aplikacji laravel port 8000
- bazy danych mariadb port 3306
- adminera port 8080





## Instrukcja uruchomienia po raz pierwszy:
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

## Interkcja z kontenerem:
uruchomienie pojedyńczego polecenia
```bash
docker exec <laravel container id> <polecenie>
# np.
docker exec 544363 php artisan migrate:fresh
```
wejscie w wiersz poleceń w kontenerze:
```bash
docker exec -it <laravel container id> /bin/sh
bash
```
## Uruchomienie modułów
niestety trzeba to wykanać po każdym uruchomieniu kontenera
```bash
docker exec -it laravel-myapp-1 bash -c "composer require jeroennoten/laravel-adminlte ; php artisan adminlte:install -n ;composer require laravel/breeze --dev;php artisan breeze:install;npm install; npm run dev"
^C
```

## Wykorzystane biblioteki
- AdminLTE - szata graficzna aplikacji - https://github.com/jeroennoten/Laravel-AdminLTE/