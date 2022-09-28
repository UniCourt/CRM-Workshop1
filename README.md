pavish

One Day workshop on understanding Docker and Git

## Prerequisite
---
### Any Linux machine/VM with following packages installed

- docker
- [docker-compose](https://docs.docker.com/compose/install/)
- git (any recent version)

### GitHub account
- Create an account on [GitHub](https://github.com/join) (Only if you do not have an account)
- Fork [this](https://github.com/UniCourt/CRM-Workshop1) repository and then clone it to your machine
- You can refer [this](https://docs.github.com/en/get-started/quickstart/fork-a-repo) guide to understand how to fork and clone



### Docker
- To install docker go to your cloned repository [CRM-Workshop1] and run the following command

    ``` sudo prerequisites_install_docker.sh ```

### Docker Images
- Run the following commands to get few docker images required for the workshop
    ```
    1. docker pull mysql:8.0
    2. docker pull php:7.4-apache
    3. docker pull hello-world
    4. docker pull alpine
    ```

### Workshop environment setup 
 - Check if Git, Docker, Docker Compose are installed and docker images are downloaded on the system. Open the terminal and run the following command

   ```
   Command: $ git --version
   git version 2.25.1

   Command: $ docker --version
   Docker version 20.10.17, build 100c701

   Command: $ docker-compose --version
   docker-compose version 1.25.0, build 0a186604

   Command: $ sudo docker images
   ```
## What will you learn by the end of this workshop?

- You will be Introduced to the concept of containerisation and why its required.
- You will learn how to Build and run your own Containers.
- You will learn how to Run Multiple Services with Docker Compose
- You will learn how to Expose Ports, Volume Mounts, Utilizing Networks, Limiting Resources.
- You will be Introduced to GIT
## Schedule
| Time            | Topics
|-----------------|-------
| 09:00 - 09:30   |  [`Introduction`]
| 09:30 - 10:00   |  [`Introduction to GIT`](github_intro.md)
| 10:00 - 11:00   |  [`Git Commands (push, pull, make Pull request etc)`](github_commands.md)
| 11:00 - 11:30   |  [`What is docker`](docker_intro.md)
| 11:30 - 12:00   |  [`Docker Commands`](docker_commands.md)
| 12:00 - 01:30   |  [`Break`]
| 01:30 - 4:00    |  [`Building Custom Containers`](build_container.md)
|                 | [`Run Multiple Services with Docker Compose`](docker_compose.md)
| 4:00 -  5:00    |  [`Expose Ports, Volume Mounts, Utilizing Networks, Limiting Resources`](docker_ports_volumn_mount.md)
| 5:15 -  5:30    |  [`Wrapping Up`]

