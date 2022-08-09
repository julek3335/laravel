```mkdir <nazwa projektu>
cd <nazwa projektu>
curl -LO https://raw.githubusercontent.com/bitnami/containers/main/bitnami/laravel/docker-compose.yml # albo czymkolwiek to pobrać

docker-compose up

w nowym oknie

cd my-project # folder wewnątrz <nazwa projektu> który utworzył docker-compose

git init
git reset --hard
git clean -fd
git pull git@github.com:julek3335/laravel.git

