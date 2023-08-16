# smarti

### for local installation
- set correct prameters in .env file:
DB_HOST
DB_PORT
DB_USERNAME
DB_PASSWORD
- remove prameters DOCKER_..._MODULE_URL in .env files of Frontend, Gallery and Editor modules
- composer install in the each directory
- php artisan migrate in Database directory


### starting with docker
execute in command shell:
```
cd smarti

docker network create --subnet=173.18.5.0/16 --driver bridge modules-network

cd Database
docker-compose up -d
cd ..
docker network connect modules-network database-module-mysql

docker build -t database-module-image ./Database
docker run -dit --ip 173.18.5.10 --name database-module --network modules-network database-module-image

docker build -t gallery-module-image ./Gallery
docker build -t editor-module-image ./Editor
docker build -t frontend-module-image ./Frontend

docker run -dit --ip 173.18.5.11 --name gallery-module --network modules-network gallery-module-image
docker run -dit --ip 173.18.5.12 --name editor-module --network modules-network editor-module-image
docker run -dit --name frontend-module -p 8080:8000 --network modules-network frontend-module-image
```
### finally
open http://127.0.0.1:8081/init/ to populate db pokemons

use http://127.0.0.1:8080 as a start page
