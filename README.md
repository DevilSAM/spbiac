# CAT_APP

Можно вести учет своих котиков. 

## Подразумевается, что у вас уже установлен Docker на компьютере
Для запуска вам понадобится docker.

## Установка

### клонировать проект к себе на компьютер
```bash
git clone https://github.com/DevilSAM/spbiac.git spbiac
```

### перейти в директорию проекта
```bash
cd spbiac
```

### создать файл окружения .env из образца

```bash
cp .env.example .env
```

### запустить сборку и развёртывание в докере
```bash
docker-compose build app
docker-compose up -d
```


### Сгенерировать ключи, запустить миграцию БД и засеять её исходными данными

```bash
docker-compose exec app composer install
docker-compose exec app php artisan key:generate
```


```bash
docker-compose exec app php artisan migrate
```


```bash
docker-compose exec app php artisan db:seed --class=DatabaseSeeder
```

### Также нужно создать символическую ссылку для хранилища
```bash
docker-compose exec app php artisan storage:link
```


### Установить необходимые пакеты для node и запустить сборку фронта
```bash
npm install
```

```bash
npm run build
```

## перейти в браузере по адресу 
https://localhost:8000