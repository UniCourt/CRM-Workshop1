### What is Docker Compose
Developing applications using Docker can become challenging when juggling multiple services and containers.<br>
Docker Compose is the tool that will help you run multi-container application environments.<br>

An application can consist of multiple containers running different services. It can be tedious to start and manage containers manually, so Docker created a useful tool that helps speed up the process - Docker Compose.<br>

Docker Compose works by applying rules defined in a docker-compose.yaml file. The YAML file configures the application's services and includes rules specifying how you want them to run. With the file in place, you can start, stop, or rebuild all the services using a single command. Additionally, you can check the status of a service, display log outputs, and run one-off commands.
### Docker Compose Basic Commands

```commandline
Command	Description
docker-compose --help	show help, usage instructions for and arguments for the docker-compose command
docker-compose build	look for all services containing the build: statement in the docker-compose.yml file and run a docker build for each one
docker-compose run	run a one-time command against a service
docker-compose up	build, (re)create, start, and attach to containers for a service
docker-compose -f 	specify the location of a docker-compose configuration file by adding the -f flag
docker-compose start	start existing containers for a service
docker-compose stop	stop running containers (without removing them)
docker-compose pause	pause running containers of a service
docker-compose unpause	unpause paused containers of a service
docker-compose down	stop containers (and remove containers, networks, volumes, and images)
docker-compose ps	list containers within the docker-compose configuration file
docker-compose images	list images used by created containers
docker-compose ls	list running Compose projects
```
create a file named docker-compose.yaml in the same folder that you have cloned with the following contents.
```
version: "3.7"

services:
  db:
    image: mysql:8.0
    restart: always
    container_name: app_database
    ports:
      - '3307:3306'
    environment: 
      MYSQL_SERVER: db
      MYSQL_DATABASE: app
      MYSQL_ROOT_PASSWORD: 1234
      MYSQL_PASSWORD: 1234
    volumes:
      - app-db:/var/lib/mysql

  php:
    build: .
    ports:
      - '8000:80'
    container_name: app_frontend
    environment: 
      MYSQL_SERVER: db
      MYSQL_DATABASE: app
      MYSQL_USER: root
      MYSQL_ROOT_PASSWORD: 1234
      MYSQL_PASSWORD:  
    volumes: 
      - .:/var/www/html 

volumes: 
  app-db:

```



## Running the Application:

From the directory where `docker-compose.yaml` file is present, run `docker-compose up`. This will bring up both the containers and the app will be accessible from `http://localhost:8000`.

Here you will notice that if the images are not available on your local machine then it will try to pull from docker hub.

     oops! user_info table does not exists
    if you see above message follow Create MySQL Table steps 

### Create MySQL Table:
Now to create the table in the database, exec into the MySQL Container by running `docker exec -it app_database bash`. 

Inside the container, exec into the MySQL terminal by running `mysql -uroot -p$MYSQL_ROOT_PASSWORD $MYSQL_DATABASE;`. It takes the environment variables from the docker-compose file and lets us login.

Now to create the `user_info` table, run `CREATE TABLE user_info (first_name varchar(20), last_name varchar(20),phone varchar(10));`.

    Run: 
    docker-compose down
    docker-compose up
    Refresh `http://localhost:8000`



## updating content from the index.php
let us change the content from index.php
go to line 29 of index.php
    <br>From:<br>
    `<tr><td><label>Student Phone:</label></td><td><input type='tel' name='phone'></td></tr>`
    <br>To:<br>
    `<tr><td><label>Phone:</label></td><td><input type='tel' name='phone'></td></tr>`
    <br>Refresh the page `http://localhost:8000`
<br>you will notice that the changes that you have made on local machine is already reflected this is because of below code in docker compose file
<br> This will mount the code that is present on local to the docker container
```commandline
    volumes: 
      - .:/var/www/html 
```