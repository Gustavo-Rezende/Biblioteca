## Bem vindos ao projeto Biblioteca.


Este projeto está rodando no docker com a imágem do laravel 11.


Para iniciar o projeto é necessário subir a imagem com o seguinte comando:

./vendor/bin/sail

## MIGRATIONS

- **Comando para tabela de leitores**

- - ./vendor/bin/sail php artisan migrate --path=/database/migrations/2024_03_22_180514_create_leitores_table.php

- **Comando para tabela de editoras**

- - ./vendor/bin/sail php artisan migrate --path=/database/migrations/2024_03_22_195947_create_editoras_table.php

- **Comando para tabela de livros**

- - ./vendor/bin/sail php artisan migrate --path=/database/migrations/2024_03_22_195926_create_livros_table.php

**Comando para tabela de editoras**

- - ./vendor/bin/sail php artisan migrate --path=/database/migrations/2024_03_22_200004_create_livros_lidos_table.php



## POPULANDO O BANCO

### COMANDO PARA MOCKS DO BANCO DE DADOS

### (OBSERVAÇÃO: RODAR OS COMANDOS NA SEQUENCIA POR TER DEPENDENCIA DE BANCO (FOREIGN KEY))

- **Comando para criar as mocks da tabela leitores**
 
- - ./vendor/bin/sail php artisan db:seed --class=LeitoresSeeder 

- **Comando para criar as mocks da tabela editoras**
 
- - ./vendor/bin/sail php artisan db:seed --class=EditorasSeeder

- **Comando para criar as mocks da tabela livros**
 
- - ./vendor/bin/sail php artisan db:seed --class=LivrosSeeder

- **Comando para criar as mocks da tabela livros**
 
- - ./vendor/bin/sail php artisan db:seed --class=LivrosLidosSeeder



## COMANDO PARA ENVIAR E-MAIL DE ANIVERSÁRIO

- ./vendor/bin/sail php artisan enviar:emailAniversario


## COLLECTION

- A collection com as rotas da API foi disponibilizada na raiz do projeto com o nome: 
API_Biblioteca.postman_collection.json
