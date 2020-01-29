# Samplemed-Blog
#### Aplicação Blog em CakePHP 2.x com Migrations e Seeder

### Documentação do Samplemed Blog em CakePHP 2.x com migrations
#### Autor: Vitor C.
#### Data: 28/01/2020

## 1.1 DATABASE 
### Configurando as Migrations e populando o banco.

Para iniciar a criação do banco de dados, com o banco de dados já configurado em database.php, é possível utilizar o comando no prompt “cake migrations generate” para gerar os arquivos necessários ( a partir de app/config/migration ) e visualizar a modificação e depois utilizar o comando “cake migration run” para selecionar a migration a ser executada. 


#### Figura 1. Gerando Migração







#### Figura 2. Migração executada


Após isso, o banco de dados já estará funcionando de acordo com a aplicação.

Observação: O arquivo da migração da aplicação está localizado em : samplemedblog.com.br\app\Config\Migration\001_migrationsamplemedblog.php

Para adicionar valores aleatórios no banco de dados utilize o script seeder.php em app com o comando “php seeder.php”







## 1.2 Diagrama de Entidades do Banco



## 2. A Aplicação
### Requisitos funcionais implementados no Samplemed Blog

1- Usuários: Administrador e Regular
- Todos os usuários podem se registrar e alterar as configurações de seu usuário

2- Administrador:
- deve aprovar o tópico alterando o campo “visible” para true.
- podem excluir e editar qualquer tópico, ou excluir posts
- podem ver usuários e editar informações próprias ou de seu usuário

3- Regulares:
- não conseguem publicar tópicos diretamente, necessita aprovação do admin
- podem publicar, excluir ou alterar seus posts
- conseguem visualizar todos os posts visíveis

4- Visitantes:
- Não conseguem ver todos os tópicos
- Não conseguem publicar, editar ou excluir



	- Funcionalidade para Teste: É possível registrar usuários com role “1” de administrador e “0” de regular.



## 3. Classes Principais

### Users
	Representa os usuários do sistema
Atributos: id,username,full_name,password, role,  timestamps


### Posts
	Representa os comentários do tópico
	Atributos: id, topic_id, user_id, body, timestamps

### Topics
	Representa os itens de tópicos do blog
	Atributos: id, topic_id, user_id, title, visible, timestamps



## 4.Prints
![alt text](https://raw.githubusercontent.com/username/projectname/branch/path/to/img.png)

### 1- Visitando o site sem usuário:
![alt text]https://github.com/vitormutt/Samplemed-Blog/blob/master/prints/Login_as_guest_1.JPG

### 2- Registrando novo usuário:
![alt text]https://github.com/vitormutt/Samplemed-Blog/blob/master/prints/Register_user_1.JPG

### 3- Logado como conta regular:
![alt text]https://github.com/vitormutt/Samplemed-Blog/blob/master/prints/Login_as_regular_3.JPG

### 4- Criando um post com conta regular:
![alt text]https://github.com/vitormutt/Samplemed-Blog/blob/master/prints/regular_post_created.JPG

### 5- Visualizando posts de um tópico:
![alt text]https://github.com/vitormutt/Samplemed-Blog/blob/master/prints/View_posts_1.JPG

### 6- Editando perfil do usuário:
![alt text]https://github.com/vitormutt/Samplemed-Blog/blob/master/prints/edit_user.JPG

### 7- Criando post para um tópico:
![alt text]https://github.com/vitormutt/Samplemed-Blog/blob/master/prints/creating_post.JPG

### 8- Visualizando tópicos visiveis:
![alt text]https://github.com/vitormutt/Samplemed-Blog/blob/master/prints/View_posts_1.JPG

