# smarti

set correct local prameters in .env file:
DB_HOST
DB_PORT
DB_USERNAME
DB_PASSWORD


execute in command shell:
```
cd smarti

docker network create --subnet=173.18.5.0/16 --driver bridge modules-network

cd Database
docker-compose up -d
cd ..
docker network connect modules-network database-module-mysql

docker build -t database-module-image ./Database
docker run -dit --ip 173.18.5.10 -p 8081:8001 --name database-module --network modules-network database-module-image

docker build -t gallery-module-image ./Gallery
docker build -t editor-module-image ./Editor
docker build -t frontend-module-image ./Frontend

docker run -dit --ip 173.18.5.11 --name gallery-module --network modules-network gallery-module-image
docker run -dit --ip 173.18.5.12 --name editor-module --network modules-network editor-module-image
docker run -dit --name frontend-module -p 8080:8000 --network modules-network frontend-module-image
```
open http://127.0.0.1:8081/init/ in browser to populate db pokemons
use http://127.0.0.1:8080 as a start page
