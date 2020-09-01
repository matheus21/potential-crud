# potential-crud

O projeto desenvolvido tem a aplicação dividida em duas partes (**api** e **front**), utilizando as tecnologias:

- PHP com Framework Laravel 7 (API)
- ReactJs (Front)
- Banco de dados MySQL 5.7
- Docker 19.03.12 e docker-compose 1.26.2

## Para executar o projeto, são necessários os seguintes comandos:

- Na pasta **potential-crud**

>docker-compose up -d --build

>sudo chmod -R 777 api/storage (Caso utilizar linux)

>sudo chmod -R 777 api/bootstrap (Caso utilizar linux)

>docker exec -it potential-crud-api php artisan migrate (Cria tabelas no banco de dados mysql)

## Acesso ao banco de dados:

- Host: 127.0.0.1
- Porta: 3308
- Database: potential-crud-db
- Senha: root
- Usuário: root

## Acessar a aplicação:

- front: http://localhost:3006
- api: http://localhost:8086

Acessando endpoint de developers com paginação e busca por termo:
> localhost:8086/developers?termo=Q&page=1

## Para executar os testes unitários:

> docker exec -it potential-crud-api phpunit -v --testdox
