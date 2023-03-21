<h1>Projeto CRUD Básico com Testes Unitários</h1> 

<p>Este é um projeto Laravel que implementa um CRUD básico (Create, Read, Update, Delete) para uma aplicação API Back-end. O banco de dados utilizado é o MySQL e também implementa testes unitários básicos para verificar o funcionamento do código.<p>

<h2>Requisitos</h2>

<p>Antes de começar a utilizar este projeto, certifique-se de que você possui as seguintes ferramentas instaladas em seu ambiente de desenvolvimento:

PHP 7.4 ou superior
Composer
MySQL</p>

<h2>Instalação</h2>

<p>Para instalar o projeto, siga os seguintes passos:</p>

<li>Clone este repositório em sua máquina:</li>
<li>Acesse a pasta do projeto:</li>
<li>Instale as dependências do projeto utilizando o Composer: 'composer install'</li>
<li>Crie o arquivo .env a partir do .env.example:</li>
<li>Configure o acesso ao banco de dados no arquivo .env</li>
<li>Crie as tabelas do banco de dados: 'php artisan migrate --seed'</li>
<li>Execute o comendado 'php artisan serve' para iniciar o projeto.</li>
<li></li>
<li></li>
<li></li>

<h2>Utilização</h2>

<p>Para utilizar o projeto, você pode utilizar um cliente de API, como o Postman, por exemplo. As rotas disponíveis são:</p>

<li>GET /api/usuarios: retorna todos os usuários cadastrados</li>
<li>GET /api/usuarios/{id}: retorna um usuário específico a partir do seu ID</li>
<li>POST /api/usuarios: cria um novo usuário</li>
<li>PUT /api/usuarios/{id}: atualiza um usuário existente a partir do seu ID</li>
<li>DELETE /api/usuarios/{id}: remove um usuário existente a partir do seu ID</li>

<p>Para cada uma das rotas, é necessário enviar os parâmetros em formato JSON no corpo da requisição.</p>

<h2>Teste unitário</h2>

<li>descomentar as rotas de teste no arquivo api.php</li>
<li>criar um .env.testing</li> 
<li>executar o comando 'php artisan migrate --env=testing'</li>
<li>para testar executar o comando 'php artisan test'</li>


<h3>Observações<h3>
<p>o teste de update de usuários não passa.</p>
