### Application lunch
Ensure Docker is installed on your system. You can download it from [Docker's official documentation](https://docs.docker.com/get-started/get-docker/).

Make sure port 8080 and 8000 is not in use by another applications.

For first run you should run this command to install all dependencies
```shell
docker run --rm --interactive --tty -v $PWD:/app composer composer install
```

Run the Docker Command in terminal:
```shell
docker cpompose up
```

Then open web page and start use the app:
http://localhost:8000

### Bonus

Connect to container ssh
```shell
docker compose exec web_socket bash
```
Then run
```shell
composer test-all
```
it will execute `phpstan` `easy-coding-standard` and `phpunit` checking