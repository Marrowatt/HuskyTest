## Sobre o sistema

HuskyTest é um sistema feito em Laravel e Vuejs para a empresa Husky Logística.

## Deploy

Para utilizar o sistema:
- Primeiro, tenha certeza de que tens um ambiente de desenvolvimento PHP + MySQL + Composer + NPM.
- Baixe o projeto, seja como .zip ou através do 'clone'.
- Utilize o composer install para baixar as dependências do projeto.
- Caso não tenha sido criado o .env, copie o arquivo .env.example, renomeando o arquivo para .env.
- Use o comando php artisan key:generate para gerar a chave da aplicação no .env.
- No MySQL, crie uma base de dados e use o nome dela com seus dados de acesso no arquivo .env.
- Por fim, utilize o comando php artisan migrate:fresh --seed para preparar a base de dados e popular com alguns valores;

E fique à vontade para usar o sistema.
