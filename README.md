# language-scool-gb Инструкция по развёртыванию:

## 1. Клонируем репозиторий
git clone https://github.com/IKolyas/language-school-gb

## 2. Переходим в папку проекта, устанавливаем зависимости и поднимаем контейнеры
cd language-school-gb

## 3. Вводим параметры соединения с БД
DB_USERNAME <br>
DB_PASSWORD

## 4. Устанавливаем зависимости и поднимаем контейнеры
sudo apt-get install php-pgsql <br>
composer install <br>
npm install <br>
./vendor/bin/sail up <br>

## 5. Запускаем наблюдатель
npm run watch
