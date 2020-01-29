# Samplemed-Blog - Documentação
#### Aplicação criada como teste e exemplo, utilizando cakePHP 2.x com Migrations, Seeder, Bootstrap e PHP5.x para simular um blog funcional.
#### Autor: Vitor C. - Data 28/01/2020

## 1.1 DATABASE 
### Configurando as Migrations e populando o banco.

Para iniciar a criação do banco de dados, com o banco de dados já configurado em database.php, é possível utilizar o comando no prompt “cake migrations generate” para gerar os arquivos necessários ( a partir de app/config/migration ) e visualizar a modificação e depois utilizar o comando “cake migration run” para selecionar a migration a ser executada. 

#### Figura 1. Gerando Migração
![alt text](https://github.com/vitormutt/Samplemed-Blog/blob/master/prints/cake_migration_generate.JPG)

#### Figura 2. Migração executada
![alt text](https://github.com/vitormutt/Samplemed-Blog/blob/master/prints/cake_migration_run.JPG)

Após isso, o banco de dados já estará funcionando de acordo com a aplicação.

Observação: O arquivo da migração da aplicação após a geração está localizado em : 
##### samplemedblog.com.br\app\Config\Migration\001_migrationsamplemedblog.php

Para popular entidades com valores aleatórios no banco de dados utilize o script seeder.php em app com o comando “php seeder.php” em /app da seguinte forma:


#### Figura 3. Populando o banco de dados com script 'seeder'
![alt text](https://github.com/vitormutt/Samplemed-Blog/blob/master/prints/seeding_database.JPG)
Após esta etapa já conseguiremos visualizar na aplicação os elementos gerados.

## 1.2 Diagrama de Entidades do Banco
#### Figura 4. O diagrama para o Model da aplicação
![alt text](https://github.com/vitormutt/Samplemed-Blog/blob/master/prints/database_der.JPG)

## 2. A Aplicação
### Requisitos funcionais implementados no Samplemed Blog

#### 1 - Usuários: Administrador e Regular
- Todos os usuários podem se registrar e alterar as configurações de seu usuário

#### 2 - Administrador:
- deve aprovar o tópico alterando o campo “visible” para true.
- podem excluir e editar qualquer tópico, ou excluir posts
- podem ver usuários e editar informações próprias ou de seu usuário

#### 3 - Regulares:
- não conseguem publicar tópicos diretamente, necessita aprovação do admin
- podem publicar, excluir ou alterar seus posts
- conseguem visualizar todos os posts visíveis

#### 4 - Visitantes:
- Não conseguem ver todos os tópicos
- Não conseguem publicar, editar ou excluir

##### - Funcionalidade para Teste: É possível registrar usuários com role “1” de administrador e “0” de regular.


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

## 4. Controllers

As controllers estão definindo as ações principais de cada usuário, para exibir de forma correta na view. As principais ações são de visualizar, editar, deletar ou criar. Sendo semelhantes em seu objetivo mas com peculiaridades para cada diferente tipo de usuário.


## 5. Prints - Visual da Aplicação

### 1- Visitando o site sem usuário:
![alt text](https://github.com/vitormutt/Samplemed-Blog/blob/master/prints/Login_as_guest_1.JPG)

### 2- Registrando novo usuário:
![alt text](https://github.com/vitormutt/Samplemed-Blog/blob/master/prints/Register_user_1.JPG)

### 3- Logado como conta regular:
![alt text](https://github.com/vitormutt/Samplemed-Blog/blob/master/prints/Login_as_regular_3.JPG)

### 4- Criando um post com conta regular:
![alt text](https://github.com/vitormutt/Samplemed-Blog/blob/master/prints/regular_post_created.JPG)

### 5- Visualizando posts de um tópico:
![alt text](https://github.com/vitormutt/Samplemed-Blog/blob/master/prints/View_posts_1.JPG)

### 6- Editando perfil do usuário:
![alt text](https://github.com/vitormutt/Samplemed-Blog/blob/master/prints/edit_user.JPG)

### 7- Criando post para um tópico:
![alt text](https://github.com/vitormutt/Samplemed-Blog/blob/master/prints/creating_post.JPG)

### 8- Visualizando tópicos visiveis:
![alt text](https://github.com/vitormutt/Samplemed-Blog/blob/master/prints/View_posts_1.JPG)

