# OhRepository

The exercise can and input can be found in the project root, meanwhile the code can be found in my-project.
First in the project root have  to start the docker container with: 

docker-compose up -d

I wrote artisan specific console command for the functionality, I always use CLI for this type of exercise.
We can run the logic with the following command from the project root:

docker-compose exec myapp php artisan generate:outputs

We can run the test with the following command from the project root:

docker-compose exec myapp php artisan test
