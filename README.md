# Forméact

## Docker

Builds, (re)creates, starts, and attaches to containers for a service.

https://docs.docker.com/compose/reference/up/

```bash
docker-compose up --detach
```

Stops containers and removes containers with named volumes declared in the `volumes` section of the `docker-compose.yml`.

https://docs.docker.com/compose/reference/down/

```bash
docker-compose down --volumes
```

## Make an url point to localhost

```bash
sudo nano /etc/hosts
```

```
127.0.0.1   formeact.test www.formeact.test
```

Then type `ctrl + x`, and `y` to save and exit nano. Now, the custom url points to `localhost`.

## Database

Put your SQL dump in the `database` folder
