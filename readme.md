# textbox

PHPで実装された、プライベート環境向けQiita系サイトです

## バージョン

0.1.1

## 眺める

http://textbox-demo.nijibox.net/ にあります

* User: user1@example.com
* Pass: password1

## 動かす

### 必要環境

* Laravel 5.2系が動くPHP
* RDBサービス(MySQL, SQLite)と、それに対応したphp拡張+PDO

### 動かし方

#### Mac with SQLite

```bash
$ git clone https://github.com/nijibox/textbox.git
$ cd textbox
$ composer install
$ cp .env.sqlite.example .env
$ php artisan key:generate
$ vi .env
(Edit for your environment)
$ touch database/database.sqlite
$ php artisan migrate
$ php artisan serve
```

#### Mac with MySQL

```bash
$ git clone https://github.com/nijibox/textbox.git
$ cd textbox
$ composer install
$ cp .env.mysql.example .env
$ php artisan key:generate
$ vi .env
(Edit for your environment)
$ php artisan migrate
$ php artisan serve
```

## License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
