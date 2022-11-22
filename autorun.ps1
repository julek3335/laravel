docker container stop laravel-myapp-1
docker rm laravel-myapp-1

docker container stop laravel-adminer-1
docker rm laravel-adminer-1

docker container stop laravel-mariadb-1
docker rm laravel-mariadb-1


git clone https://github.com/julek3335/laravel.git

cd laravel/

Remove-Item project -Recurse -force

docker compose up --detach

function GetWebSiteStatusCode {
    param (
        [string] $testUri,
        $maximumRedirection = 5
    )
    $request = $null
    try {
        $request = Invoke-WebRequest -Uri $testUri -MaximumRedirection $maximumRedirection -ErrorAction SilentlyContinue
    } 
    catch [System.Net.WebException] {
        $request = $_.Exception.Response

    }
    catch {
        Write-Error $_.Exception
        return $null
    }
    return $request.StatusCode
}

do{
  $statusCode = GetWebSiteStatusCode -testUri "http://localhost:8000/"
  sleep(1);
  echo "waiting for laravel project to be created ";
}while( $statusCode -ne 200)


git restore .


# vite wraca takie cos jak powyzej, trzeba wtecy nacisnac ctrl-c nw jak to zanutomatyzowac
docker exec -it laravel-myapp-1 bash -c " composer install;npm install; npm run build"

# do{
#   $statusCode = GetWebSiteStatusCode -testUri "http://localhost:8000/"
#   sleep(1);
#   echo "waiting for vite to be available";
# }while( $StatusCode -ne 200)

# sleep(30);
# echo "docker container restart started"

# docker container stop laravel-myapp-1
# docker compose up

docker exec -it laravel-myapp-1  php artisan storage:link

docker exec -it laravel-myapp-1 php artisan migrate:fresh
docker exec -it laravel-myapp-1 php artisan db:seed


git restore . 
git clean -f

echo "Done!"