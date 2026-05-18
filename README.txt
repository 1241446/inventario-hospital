================================================================================
 MedControl - Sistema de Gestão de Inventário Hospitalar de Equipamentos Médicos
================================================================================

Projeto Individual - SIBDAS LEBIOM 2025-2026
Instituto Superior de Engenharia do Porto (ISEP)

Nome do Projeto : MedControl
Nome do Estudante: 1241446
Número do Estudante: 1241446

--------------------------------------------------------------------------------
ESTRUTURA DE DIRETORIAS
--------------------------------------------------------------------------------

inventario-hospital/
├── public/          Páginas acessíveis sem autenticação (área pública)
├── private/         Páginas protegidas por autenticação (área privada)
│   └── index.html   Dashboard principal (área privada)
├── assets/
│   ├── css/1241446.css   Folha de estilos do projeto
│   ├── js/1241446.js     Scripts JavaScript do projeto
│   └── img/              Imagens
├── database/
│   ├── schema.dbml       Representação DBML do modelo físico
│   ├── schema.sql        Script DDL de criação da base de dados
│   └── dados.sql         Script de inserção de dados de teste

--------------------------------------------------------------------------------
INSTRUÇÕES DE INSTALAÇÃO E EXECUÇÃO
--------------------------------------------------------------------------------

Pré-requisitos:
  - Servidor Apache com PHP 8.1+ (XAMPP recomendado)
  - Acesso ao servidor de BD: vsgate-s1.dei.isep.ipp.pt:10464
  - Browser moderno (Chrome, Firefox, Edge)

Passos de instalação:

1. Copiar a pasta do projeto para o servidor web local:
   C:\xampp\htdocs\sibdas\1241446\inventario-hospital\

2. Preparar a base de dados no servidor SIBDAS:
   - Ligar ao servidor vsgate-s1.dei.isep.ipp.pt:10464 com HeidiSQL
     (utilizador = numero de estudante, password indicada na aula PL)
   - Selecionar, na arvore da esquerda, a BD ja disponivel para o
     estudante (criada automaticamente pelo servidor)
   - Em database/schema.sql e database/dados.sql, substituir
     "NOME_DA_BD" pelo nome real dessa BD
   - Executar o script: database/schema.sql (cria as tabelas)
   - Executar o script: database/dados.sql (insere os dados de teste)
   - Para a entrega no Moodle, exportar a BD num unico ficheiro .sql
     (HeidiSQL > clicar na BD > Export database as SQL, com
     estrutura + dados) e incluir esse ficheiro no ZIP submetido

4. Aceder à aplicação em:
   http://127.0.0.1/sibdas/1241446/inventario-hospital/public/

--------------------------------------------------------------------------------
INSTRUÇÕES PARA TESTES
--------------------------------------------------------------------------------

Área Pública (sem login):
  - Aceder a: http://127.0.0.1/sibdas/1241446/inventario-hospital/public/
  - Navegar pelas páginas: Início, Solução, Funcionalidades, Clientes, Contacto
  - Testar formulário de contacto (validação JavaScript)

Autenticação:
  - Aceder ao login: public/login.html
  - Testar login com credenciais válidas e inválidas

Área Privada (após login):
  - Dashboard: verificar KPIs, gráficos e alertas de garantia

--------------------------------------------------------------------------------
CREDENCIAIS DE ACESSO
--------------------------------------------------------------------------------

Perfil Administrador:
  Utilizador : admin
  Password   : admin123

Perfil Técnico:
  Utilizador : carlos
  Password   : senha123

Perfil Gestor:
  Utilizador : joana
  Password   : senha456

--------------------------------------------------------------------------------
INFORMAÇÃO ADICIONAL
--------------------------------------------------------------------------------

- Base de dados: MySQL 8.0, servidor SIBDAS vsgate-s1.dei.isep.ipp.pt:10464
- Ficheiro DBML disponível em: database/schema.dbml
- Script DDL disponível em: database/schema.sql
- Dados de teste disponíveis em: database/dados.sql

================================================================================
