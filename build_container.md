#### What is a container?
Containers are instances of Docker images that can be run using the Docker run command. The basic purpose of Docker is to run containers.
- is a runnable instance of an image. You can create, start, stop, move, or delete a container using the DockerAPI or CLI.
- can be run on local machines, virtual machines or deployed to the cloud.
- is portable (can be run on any OS)
- Containers are isolated from each other and run their own software, binaries, and configurations.

#### What is a container image?
When running a container, it uses an isolated filesystem. This custom filesystem is provided by a container image. Since the image contains the container’s filesystem, it must contain everything needed to run an application - all dependencies, configuration, scripts, binaries, etc. The image also contains other configuration for the container, such as environment variables, a default command to run, and other metadata.
### Build the app’s container image
in order to build the application, we need to use a Dockerfile. A Dockerfile is simply a text-based script of instructions that is used to create a container image

1. Get the app from git
```    
https://gitlab.unicourt.com/akshay-uc/workshop/-/tree/app (download zip) ==> (we nned to keep this in seperate repo)
```
unzip the file and cd into the app folder.

2. Create a file named Dockerfile in the above folder with the following contents.
```
FROM php:7.4-apache
COPY . /var/www/html
RUN docker-php-ext-install mysqli
```
Contents of Dockerfile:<br>
a. Get the base image: `FROM php:7.4-apache`. This pulls the base php 7.4 image with inbuilt apache server.<br>
b. Copy the custom code into the image by `COPY . /var/www/html`.<br>
c. Install the PHP-MySQL support in the image. `RUN docker-php-ext-install mysqli`. This allows PHP to communicate with MySQL.<br>

3. open a terminal and go to the app directory with the Dockerfile. Now build the container image using the docker build command
```
docker build -t app-new .
````
- This command used the Dockerfile to build a new container image. You might have noticed that a lot of “layers” were downloaded. This is because we instructed the builder that we wanted to start from the php:7.4-apache image. But, since we didn’t have that on our machine, that image needed to be downloaded.

- Finally, the -t flag tags our image. Think of this simply as a human-readable name for the final image. Since we named the image getting-started, we can refer to that image when we run a container.

- The . at the end of the docker build command tells that Docker should look for the Dockerfile in the current directory.

### Start an app container

Start your container using the docker run command and specify the name of the image we just created
```commandline
docker run -dp 8000:80 app-new
```
Remember the -d and -p flags? We’re running the new container in “detached” mode (in the background) and creating a mapping between the host’s port 8000 to the container’s port 3000. Without the port mapping, we wouldn’t be able to access the application.
After a few seconds, open your web browser to http://localhost:8000. You should see our app.

#### Note: Do not panic if you see errors mentioned below in your browser, this is because we do not have necessary things to connect to db
```commandline
Warning: mysqli::__construct(): (HY000/2002): No such file or directory in /var/www/html/database.php on line ...
Warning: mysqli::query(): Couldn't fetch mysqli in /var/www/html/database.php on line ....
```

## Updating content from the index.php
let us change the content from index.php
go to line 29 of index.php
    <br>From:<br>
    `<tr><td><label>Phone:</label></td><td><input type='tel' name='phone'></td></tr>`
    <br>To:<br>
    `<tr><td><label>Student Phone:</label></td><td><input type='tel' name='phone'></td></tr>`

#### Note: After updating above lines of code go and refresh app in browser, you will still not see the changes done, this is becuase the container that is already build does not have this changes
Step 1 : Stop the container

    docker stop <container if that you see when you run>
Step 2 : Build the image again
    
    docker build -t app-new .
Step 3: Run the container again 
    
    docker run -dp 8000:80 app-new

Refresh the page again in the browser and now you should be able to see the changes that you have done

