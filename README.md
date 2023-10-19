# Configuração do Projeto

Este projeto utiliza o WampServer e o Composer para gerenciar dependências e configurações. Siga as etapas abaixo para configurar o ambiente e executar o projeto.

## Pré-Requisitos

- [WampServer](http://www.wampserver.com/) instalado e configurado.
- [Composer](https://getcomposer.org/) instalado em seu sistema.

## Instalação

1. Clone o repositório Git em sua pasta `www` do WampServer:

   ```bash
   git clone https://github.com/RodrigoBrill/TesteEvolke.git
   ```

2. Navegue até o diretório do projeto:

   ```bash
   cd www/TesteEvolke
   ```

3. Execute o Composer para instalar as dependências do projeto:

   ```bash
   composer update
   ```

## Banco de Dados

1. Execute as migrações do banco de dados para criar as tabelas:

   ```bash
   vendor/bin/phinx migrate
   ```

2. Execute as sementes (seeds) para preencher o banco de dados com dados iniciais:

   ```bash
   vendor/bin/phinx seed:run
   ```

## Configuração

1. Abra o arquivo `source/Config.php` no projeto.

2. Localize a definição da constante `URL_BASE` e ajuste-a para a porta alocada pelo WampServer:

   ```php
   define('URL_BASE', 'http://localhost:<PORTA_DO_WAMPSERVER>/TesteEvolke');
   ```

3. Certifique-se de que a URL esteja correta e aponte para a pasta onde o projeto está hospedado.

## Executando o Projeto

1. Inicie o WampServer e verifique se o Apache e o MySQL estão em execução.

2. Abra um navegador da web e acesse a URL configurada no `URL_BASE`.

3. O projeto deve ser exibido no navegador.