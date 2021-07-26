# zello

Manual de instalação do projeto

## Instalaçao inicial

$$
git clone https://github.com/paulooliver2/zello
$$

$$
composer install
$$

## Configurar conexao .env

Criar arquivo .env a partir do .env.exemplo

Alterando os dados de conexao

$$
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=db_zello
DB_USERNAME=seuusuariodebanco
DB_PASSWORD=suasenhadebanco
$$

## Migraçao de banco de dados

**note: crie uma data base com nome db_zello

Criando tabelas

$$
php artisan migrate
$$

## Iniciando servidor

$$
php artisan server
$$

