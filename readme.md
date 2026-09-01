# 起動コマンド
~~~
docker compose up -d --build
~~~

# laravelのインストールコマンド
~~~
docker compose exec app composer create-project laravel/laravel src
~~~

# SQLiteファイル作成
~~~
docker compose exec app touch database/database.sqlite
~~~

# 権限開放(おまじないみたいなものだとおもって実行してください)
~~~
docker compose exec app chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache /var/www/database
~~~

# Breezeパッケージのinstall
~~~
docker compose exec app composer require laravel/breeze --dev
~~~

# Breezeパッケージの展開
~~~
docker compose exec app php artisan breeze:install blade
~~~

# npmのインストール
~~~
docker compose exec app npm install
~~~
## npmのビルド
~~~
docker compose exec app npm run build
~~~

##　モデルとマイグレーションの作成
docker compose exec app php artisan make:model Practice -m


## database/migrations/xxxx_create_practices_table.phpにカラムを追加後、マイグレーションを実行
docker compose exec app php artisan migrate


## コントローラーの作成
docker compose exec app php artisan make:controller PracticeController

## データベースのリセットと再適用
docker compose exec app php artisan migrate:refresh

## 開発用のコマンド
docker compose exec app npm run dev

## 本番用のコマンド
docker compose exec app npm run build

## Laravel Debugbarの導入
docker compose exec app composer require barryvdh/laravel-debugbar --dev