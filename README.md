# MemberFlix API

Este é um projeto Laravel que serve como base para desenvolvimento de aplicações modernas utilizando PHP 8.2 e Laravel 11. O projeto já vem configurado com diversas ferramentas úteis para desenvolvimento e testes, como Laravel Tinker, PHPUnit, Laravel Sail, Pint e Pail.

## Sumário

- [MemberFlix API](#memberflix-api)
  - [Sumário](#sumário)
  - [Pré-requisitos](#pré-requisitos)
  - [Instalação](#instalação)
  - [Configuração do Ambiente](#configuração-do-ambiente)
  - [Uso](#uso)
  - [Scripts Disponíveis](#scripts-disponíveis)
  - [Testes](#testes)
  - [Contribuição](#contribuição)
  - [Licença](#licença)

## Pré-requisitos

*   PHP 8.2 ou superior
*   Composer
*   MySQL (ou outro banco de dados suportado pelo Laravel)
*   Node.js (para desenvolvimento front-end, se aplicável)

## Instalação

1.  **Clone o repositório:**
    
    ```
    git clone <URL-do-repositorio>
    cd <nome-do-projeto>
    ```
    
2.  **Instale as dependências PHP:**
    
    ```
    composer install
    ```
    
3.  **Instale as dependências Node.js (se houver front-end):**
    
    ```
    npm install
    ```
    
4.  **Configure o arquivo de ambiente:**
    
    ```
    cp .env.example .env
    php artisan key:generate
    ```
    
## Configuração do Ambiente

O projeto utiliza variáveis de ambiente para configuração. Confira as principais variáveis no arquivo `.env`:

*   `APP_ENV`: Define o ambiente (local, production, testing).
*   `APP_DEBUG`: Habilita ou desabilita o modo debug.
*   `DB_CONNECTION`, `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`: Configurações do banco de dados.
*   `SESSION_DRIVER`: Por padrão, em ambiente de testes, recomenda-se usar o driver `array` para evitar criação de tabelas (configure em `.env.testing` ou via `phpunit.xml`).

## Uso

Após configurar o ambiente, você pode executar as migrações e seeders (se necessário):

```
php artisan migrate
php artisan db:seed
```

Para iniciar o servidor de desenvolvimento, use:

```
php artisan serve
```


## Scripts Disponíveis

O arquivo `composer.json` já possui alguns scripts configurados. Por exemplo:

*   **Desenvolvimento:**
    
    ```
    npm run dev
    ```
    
*   **Build de Produção:**
    
    ```
    npm run build
    ```

## Testes

O projeto utiliza PHPUnit para testes. Para rodar os testes, execute:

```
php artisan test
```

Certifique-se de que o arquivo de ambiente para testes (`.env.testing`) esteja configurado corretamente, especialmente para o driver de sessão. Se necessário, configure o `SESSION_DRIVER` como `array` para evitar criação de tabelas extras durante os testes.

## Contribuição

Contribuições são bem-vindas! Sinta-se à vontade para abrir issues ou enviar pull requests. Certifique-se de seguir as boas práticas e escrever testes para novas funcionalidades ou correções.

## Licença

Este projeto está licenciado sob a licença MIT. Veja o arquivo [LICENSE](LICENSE) para mais detalhes.