## O projeto

Esse projeto foi **baseado em uma playlist do YouTube** sobre a construção de tabelas de dados utilizando Laravel e Vue. O projeto se resume em uma simples aplicação para criar uma tabela de dados de estudantes com diversos recursos.

-   [Playlist dos vídeos](https://www.youtube.com/watch?v=93q3LqYJTsI&list=PLBCuZqyXqWkz-0xsvvcf-4CwwAiugzmOl).
-   [Conheça mais sobre Laravel](https://laravel.com/docs/8.x).

## Como utilizar

Após baixar o projeto será necessário executar alguns comandos para poder executa-lo. Abra o terminal na pasta do projeto e utilize os seguintes comandos:

1. composer install (instalar todas as dependências necessárias)
2. cp .env.sample .env (clonar o sample do .env)
3. php artisan key:generate (gerar a chave da aplicação)
4. configurar o .env para o banco de dados a ser utilizado
5. php artisan migrate (criar as tabelas no banco de dados)
6. npm install (instalar dependências node)
7. npm run dev (build dos scripts)
8. php artisan serve (inicializar a apliação)

Após esses comandos a aplicação já estará rodando no [localhost/students](http://localhost:8000/students).
