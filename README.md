# Job-MyHammer - Simple Job schedule task

Job-MyHammer is a small software responsible for schedule jobs for the need of a tradesman 
from a client.

## Prerequisites

To start the use of Job-MyHammer you will need to have installed [docker](https://www.docker.com/) and [docker-compose](https://docs.docker.com/compose/).

The easiest way to start is clonning this project and start the containers. After that you ready to go.

To access the application you will need some software to make the REST requests. Examples of this softwares could be 
[Insomnia](https://insomnia.rest/download/) or [PostMan](https://www.getpostman.com/).

## Installation

After clone this repository and has the docker and docker-compose installed, go to the folder root of this project and run:

```
docker-compose up -d
```
Wait few minutes while the docker downloads all the images. After that, your containers would 
be up and running.

Your application should be accessible in http://localhost:8080, and your mySql connection in port :8083.

Before start the usage, you must need to change the `.env.dist` file to `.env`, this file contain
all the configuration needed to your application.

Just more steps are needed.

Inside the console, we need to access the php container. Run this command:

````
docker-compose exec php-fpm bash
````
Once inside the container we need to run the migrations to prepare the database and insert some sample data.

To do that inside the bash execute this command:

````
php bin/console doctrine:migrations:execute 20180827023035
````
Confirm the migration proccess and now you can start to use the application.

## Usage

To insert a new Job you must send some information to application.

The url to insert a new job is `http://localhost:8080/insertJob`

This url is a POST method, thus you need to send some json information.

This is the json format you need to follow in order to insert new jobs:

````
{
	"data": {
		"service_id": "108140",
		"title": "New Job",
		"zipcode": "01623",
		"city": "Berlin",
		"description": "text of example 2",
		"execution_date": "2018-09-10",
		"id_user": "123456"
	}
}
````

All these fields are required to insert a new Job.

To test the application, it has a list with some services ids to be filled in the service_id field:

108140 - 402020 - 411070 - 802030 - 804040

The field id_user is free to insert whatever Id you need to insert, it only has to be Integer type.


## Tests

You can test the application running `composer check` inside the container's bash.

This command will run the test and some extension that ensure the quality of code.

## Futures implementation
The next steps for this application is create a method which allows us to check all the jobs inserted, following some criterias
and passing some parameters as well as endpoints to insert and consult services.
