# OhRepository

Used technologies:
Docker container with the following image: https://hub.docker.com/r/bitnami/laravel

This image contains Debian latest + Laravel 9

The exercise pdf and input can be found in the project root, meanwhile the code can be found in my-project.
First in the project root have to start the docker container with: 

docker-compose up

This will create the default docker container image with the necessary tools.
After this you have to init / checkout this remote git repository into the project root:

https://github.com/booksey/OhRepository.git

I wrote artisan specific console command for the functionality, I always use CLI for this type of exercise.
We can run the logic with the following command from the project root after we started the container:

docker-compose exec myapp php artisan generate:outputs

We can run the tests with the following command from the project root:

docker-compose exec myapp php artisan test
