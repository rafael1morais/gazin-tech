<div id="top"></div>

<!-- PROJECT LOGO -->
<br />
<div align="center">
    <img src="https://laravel.com/img/logotype.min.svg" width="350">
</div>


<!-- ABOUT THE PROJECT -->
## Sobre o projeto

_Crud desenvolvido com `Laravel 9`, Tendo como desafio `Relacionamento entre tabelas`, neste projeto se encontra 2 tabelas `Nível` & `Desenvolvedores`, cada desenvolvedor tem 1 nível, porém cada nível poderá ter muitos desenvolvedores, seguindo este raciocinio temos aqui uma relação de `1:N`. De início é um projeto desafiador, porém com muita dedicação chegamos ao final deste projeto._

_Para os testes, foram realizados requisições para API através do Postman, abaixo algumas imagens dos testes realizados com níveis._
<div align="center">
    <img src="https://uploaddeimagens.com.br/images/004/302/027/full/Nivel_Get.png" width="500">
</div>
<div align="center">
    <img src="https://uploaddeimagens.com.br/images/004/302/030/full/N%C3%ADvel_Insert.png" width="500">
</div>
<div align="center">
    <img src="https://uploaddeimagens.com.br/images/004/302/031/full/Nivel_Delete.png" width="500">
</div>


## Rotas

Para visualizar as rotas presentes no `gazin-tech` digite o comando `php artisan route:list`


### Tecnologias utilizadas

Utilizando neste projeto Laravel 9 + Bootstrap + Ajax


### Instalação

_Siga as instruções para usufluir do projeto._

1. Clone repo
   ```sh
   git clone https://gitlab.com/rafael.morais.souza/gazin-tech.git
   ```
2. Instale as dependencias
   ```sh
   composer install
   ```
3. .ENV <br>
    Para que o projeto funcione corretamente, é necessário realizar a configuração da conexão com o banco de dados MySQL, informando a DATABASE, USERNAME e PASSWORD
   ```sh
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=
    DB_USERNAME=root
    DB_PASSWORD=
   ```
4. Gerar key
   ```sh
   php artisan key:generate
   ```  
5. Iniciar projeto
   ```sh
   php artisan serve
   ```  




