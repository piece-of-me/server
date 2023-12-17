# Требования

* Установленный [node-js](https://nodejs.org/en/download/).
* Установленный [composer](https://getcomposer.org/download/).
* Установленный [Docker](https://docs.docker.com/engine/install/).

# Установка

### Клонирование репозитория
* Клонировать репозиторий `git clone https://github.com/piece-of-me/server.git`;
* Перейти в папку server `cd server`;

### Установка пакетов и зависимостей
* Установить зависимости с помощью `npm install` и `composer install`;

### Запуск приложения
- Конвертируйте `.env.example` файл в Unix-формат с помощью `dos2unix .env.example`;
- Скопировать переменные окружения `cat .env.example > .env`;
- Создать и запустить контейнеры с помощью `docker-compose up  -d`;
- Запустить оболочку `bash` в контейнер `app` с помощью `docker exec -it app bash`;
- Выполнить миграцию и запустить сидеры с помощью `php artisan migrate --seed`;
- Сбилдить frontend-часть с помощью `npm run build`;

# Дополнительно
- При необходимости сгенерируйте новый ключ с помощью `php artisan key:generate`;
- С помощью сидеров создаются несколько тестовых пользователей:
    - Логин: `login1` Пароль: `password_password`;
    - Логин: `login2` Пароль: `password_password`;
    - Логин: `login3` Пароль: `password_password`;
    - Логин: `login4` Пароль: `password_password`;
    - Логин: `login5` Пароль: `password_password`.
