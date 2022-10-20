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



## - Если у вас на компьютере установлен Linux или macOS:
### Запустить набор скриптов из файла scripts.sh 
Будут выполнены: утсановка зависимостей, генерация ключей, миграция бд, засеивание бд, создание символьных ссылок, установка нужных библиотек и сборка фронта.
```bash
./scripts.sh
```


## - Если у вас на компьютере установлен Windows:
### Выполнить эти команды поочередно

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




## Перейдите в браузере по адресу 
https://localhost:8000