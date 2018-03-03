[![Build Status](https://travis-ci.org/munizeverton/sistemaacademico.svg?branch=master)](https://travis-ci.org/munizeverton/sistemaacademico)
[![Code Climate](https://api.codeclimate.com/v1/badges/fce3d99739d018b37c33/maintainability)](https://codeclimate.com/github/munizeverton/sistemaacademico/maintainability)
[![StyleCI](https://styleci.io/repos/120686858/shield?branch=master)](https://styleci.io/repos/120686858)

# Sistema Acadêmico

O projeto foi construído em Laravel, com banco em PostgreSQL. No front-end eu usei bootstrap e alguns plugins jquery para facilitar a usabilidad, como jQueryDataTables. A maior parte do código foi feito usando TDD e a suíte de testes cobre todas ou quase todas as regras de negócio da aplicação.

 Para Continuous Integration eu usei o TravisCI integrada ao GitHub, que faz o build do projeto a cada push.

  O deploy foi feito no Heroku. O processo de deploy está automatizado pelo travis, que coloca a aplicação em produção automaticamente a cada build

  Abaixo estão alguns links referente ao projeto:

  [Quadro do Trello](https://trello.com/b/EXFLN9CW/sistema-acad%C3%AAmico) - Quadro utilizado para organizar as tarefas  
  [Aplicação em produção](https://agile-chamber-30676.herokuapp.com/) - Aplicação em produção, hospedada pelo Heroku  
  [TravisCI](https://travis-ci.org/munizeverton/sistemaacademico) - Informações dos builds


## Instalação e configuração

Faça um clone desse projeto

```sh
git clone https://github.com/munizeverton/sistemaacademico
```

Crie um arquivo chamado .env a partir do arquivo .env.example e altere as configurações abaixo,
referentes ao banco da aplicação

```
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_DATABASE=sistemaacademico
DB_USERNAME=root
DB_PASSWORD=root
```

Entre na pasta do projeto clonado e instale as dependencias com o composer e gere a chave da aplicação

```sh
cd sistemaacademico
composer install
php artisan key:generate
```

## Rodando a aplicação

Você pode rodar a aplicação usando o servidor embutido do PHP
com o comando abaixo

```sh
php -S 127.0.0.1:8080 -t public/
```

Agora basta acessar a aplicação em http://127.0.0.1:8080

## Rodando os testes

Informar as configurações do banco de testes no arquivo .env.testing. Depois disso você poderá rodar a suite de testes executando o comando abaixo

```sh
vendo/bin/phpunit
```

## Importação de dados

A importaçãos dos dados contidos nos CSVs pode ser rodada com os comandos abaixo

```sh
php artisan import:courses database/csv/courses_file.csv
php artisan import:students database/csv/students_file.csv
php artisan import:registrations database/csv/registrations_file.csv
```
