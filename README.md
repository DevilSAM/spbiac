# CAT_APP

Manage your cats 

## Assumes that you have Docker installed
This app runs with docker so you need to install it first if you don't have it yet

## Installation

### Clone the project
```bash
git clone https://github.com/DevilSAM/spbiac.git spbiac
```

### Go to the created app directory
```bash
cd spbiac
```

### Create .env file using the example one

```bash
cp .env.example .env
```

### Run building the app with docker
```bash
docker-compose build app
docker-compose up -d
```



## - If you have Linux or macOS:
### Run scripts.sh file
It'll install composer dependencies, generate security keys, migrate and seed database, make storage links, install needed nodejs libraries and build frontend
```bash
sh scripts.sh
```


## - If you have Windows:
### Run theese commands one by one

```bash
docker-compose exec app composer install
```

```bash
docker-compose exec app php artisan key:generate
```

```bash
docker-compose exec app php artisan migrate
```

```bash
docker-compose exec app php artisan db:seed --class=DatabaseSeeder
```

```bash
docker-compose exec app php artisan storage:link
```

```bash
npm install
```

```bash
npm run build
```




## Now the app is available in the browser
https://localhost:8000