# CAT_APP

Можно вести учет своих котиков. 

## Подразумевается, что у вас уже установлен Docker на компьютере
Для запуска вам понадобится docker.

## Установка

### клонировать проект к себе на компьютер
```bash
git clone https://github.com/DevilSAM/spbiac.git spbiac
cd spbiac
```

### перейти в директорию проекта
```bash
cd spbiac
```

### запустить сборку и развёртывание в докере
```bash
docker-compose build app
docker-compose up -d
```


### создать файл .env из образца и прописать в нём настройки для базы данных

```bash
cp .env.example .env
```


### Сгенерировать ключи, запустить миграцию БД и засеять её исходными данными

```bash
composer insta
php artisan key:generate
```


```bash
php artisan migrate
```


```bash
php artisan db:seed --class=DatabaseSeeder
```

### Также нужно создать символическую ссылку для хранилища
```bash
php artisan storage:link
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