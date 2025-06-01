# Mony
A simple Test Driven Development Web App to monitor your daily expenses


![node](https://img.shields.io/badge/nodejs-v20.9.0-122D05.svg?style=flat-square)
![php](https://img.shields.io/badge/PHP-v8.3-828cb7.svg?style=flat-square)
![composer](https://img.shields.io/badge/Composer-v2.3.7-644D31.svg?style=flat-square)
![symfony](https://img.shields.io/badge/Symfony-v7-122D53.svg?style=flat-square)

# GETTING STARTED

* [Project Installation](#installation)
* [Back-end installation](#back-installation)
* [Front-end installation](#front-installation)
* [Unit Test](#unit-test)
* [Migrations](#migrations)

#### Description
Framework: based on Symfony 7 based project with PHP 8.3.
Mode: TDD project based on PHPUnit.
Frontend: component oriented project based on reactJS.

# <a name="installation"></a>PROJECT INSTALLATION
### 1/ GET PROJECT FROM GIT
- Project uses the following gitflow for commit: 
```
git commit -m "feat(branchName): message"
```

- Use the following commands to install project:
```
git clone https://github.com/Rapkalin/mony.git
git fetch
git checkout master
```

### 2/ VHOST configuration
#### Update your /etc/hosts
- Add host on your local OS (On Windows, files is locate to `C:\windows\System32\drivers\etc\`)

```
127.0.0.1   mony.local
```

#### Update your /Applications/MAMP/conf/apache/extra/httpd-vhosts.conf
for <http://mony.local>

```

<VirtualHost *:80>
   ServerName mony.local
   DocumentRoot "${INSTALL_DIR}/your-folder-name/mony/public"

   ServerAlias mony.local.*

   <Directory "${INSTALL_DIR}/your-folder-name/mony/public">
     Options Includes FollowSymLinks
     AllowOverride All
   </Directory>
</VirtualHost>

```

## <a name="back-installation"></a> 3/ BACK-END INSTALL
### 3.1- Dependencies installation
- From the root directory (/mony/), enter the command:
- This command will install the back dependencies linked to the *composer.json*
```
compose install or compose i
php bin/console cache:clear 
php bin/console doctrine:migrations:migrate
```
- Add your .env file using the .env.example file as a base with at least the below settings:

```
APP_ENV=dev
APP_SECRET=xxx
APP_DEBUG=1

DATABASE_URL="mysql://username:password@127.0.0.1:3306/databaseName?serverVersion=8.0.32&charset=utf8mb4"

### This is used for cron script purpose
DB_HOST=host_example
DB_NAME=name_example
DB_USERNAME=username_example
DB_PASSWORD=password_example
```

## <a name="front-installation"></a>4/ FRONT-END INSTALL / BUILD
- From the root directory (/mony/) enter the following commands to build the frontend project:
- asset-map will compile copy and past the files in the assets dir into the public dir.
- importmap will install all js dependencies in assets/vendor

#### in production
```
npm install
php bin/console cache:clear 
php bin/console asset-map:compile
php bin/console importmap:install
```

#### in development

```
php bin/console cache:clear 
npm install
npm run watch
```

# <a name="unit-tests"></a>5/ Unit test
- This is a Test Driven Development project. 
- Tests will be run before to build and deploy the project through CI.


### Run the unit tests
- To run the test in local environment, from the root directory run the following commands
```
vendor/bin/phpunit --debug
```

### Config the unit tests in CI and project
- The config file is phpunit.xml.dist at the root directory
- In .github/workflows/main.yml || preprod.yml, update the following part
```
jobs:
  unit-tests:
    runs-on: ubuntu-latest

    steps:
      - name: TestMode - Checkout mony
        uses: actions/checkout@v3

      - name: TestMode - Install dependencies
        uses: php-actions/composer@v6
        with:
          dev: no
          args: --no-interaction --prefer-dist --optimize-autoloader --no-scripts --ignore-platform-req=ext-zip

      - name: TestMode - Unit tests
        uses: php-actions/phpunit@v3
        with:
          php_version: 8.3
          bootstrap: vendor/autoload.php
```


# <a name="migrations"></a>6/ Migrations
### To run all migration

```
php bin/console cache:clear 
php bin/console doctrine:migrations:status
php bin/console doctrine:migrations:migrate
```

### To run one specific migration 
- With the status command retrieve the version className for example: DoctrineMigrations\Version20250413175938

```
php bin/console cache:clear 
php bin/console doctrine:migrations:status
php bin/console doctrine:migrations:migrate
```

- Add and anti-slash before VersionsXXX
- Then run the specific migration:

```
php bin/console cache:clear 
php bin/console doctrine:migrations:execute DoctrineMigrations\\Version20250413175938 --up
```

### To rollback one specific migration
- Same as previous, get the className then run the following:

```
php bin/console cache:clear 
php bin/console doctrine:migrations:execute DoctrineMigrations\\Version20250413175938 --down
```

php bin/console doctrine:migrations:execute DoctrineMigrations\\Version20250503220948 --down
php bin/console doctrine:migrations:execute DoctrineMigrations\\Version20250503220826 --down
php bin/console doctrine:migrations:execute DoctrineMigrations\\Version20250503210348 --down
