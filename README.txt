================================================================================
 MedControl - Sistema de Gestão de Inventário Hospitalar de Equipamentos Médicos
================================================================================

Projeto Individual - SIBDAS LEBIOM 2025-2026
Instituto Superior de Engenharia do Porto (ISEP)

Nome do Projeto  : MedControl
Nome do Estudante: 1241446
Número do Estudante: 1241446

--------------------------------------------------------------------------------
ESTRUTURA DE DIRETORIAS
--------------------------------------------------------------------------------

inventario-hospital/
├── public/               Páginas acessíveis sem autenticação (área pública)
│   ├── index.php         Página inicial da área pública
│   ├── solucao.php       Página de solução
│   ├── funcionalidades.php Página de funcionalidades
│   ├── clientes.php      Página de clientes
│   ├── contacto.php      Formulário de contacto
│   └── login.php         Página de login
├── private/              Páginas protegidas por autenticação (área privada)
│   ├── home.php          Dashboard principal com KPIs e gráficos
│   ├── processa_login.php Processamento do formulário de login
│   ├── includes/         Componentes reutilizáveis (header, footer, sidebar)
│   ├── logs/             Ficheiros de log da aplicação (app.log)
│   └── views/            Vistas organizadas por módulo
│       ├── equipamentos/ CRUD de equipamentos + exportação CSV
│       ├── fornecedores/ Listagem e detalhe de fornecedores
│       ├── localizacoes/ Gestão de localizações
│       ├── documentos/   Listagem de documentos
│       ├── garantias/    Listagem de garantias
│       └── conteudos/    Gestão de conteúdos da área pública
├── assets/
│   ├── css/1241446.css   Folha de estilos do projeto
│   ├── js/1241446.js     Scripts JavaScript do projeto
│   ├── bootstrap/        Bootstrap 5 (local, sem CDN)
│   ├── fontawesome/      Font Awesome 6 (local, sem CDN)
│   ├── datatables/       DataTables (local, sem CDN)
│   └── jquery/           jQuery (local, sem CDN)
├── database/
│   ├── schema.dbml       Representação DBML do modelo físico
│   ├── schema.sql        Script DDL de criação da base de dados
│   ├── dados.sql         Script de inserção de dados de teste
│   └── db1241446.sql     Exportação completa da BD (estrutura + dados)
├── config/
│   └── config.php        Configurações da aplicação (BD, constantes)
├── README.md             Documentação para Git
└── README.txt            Este ficheiro

--------------------------------------------------------------------------------
INSTRUÇÕES DE INSTALAÇÃO E EXECUÇÃO
--------------------------------------------------------------------------------

Pré-requisitos:
  - Servidor Apache com PHP 8.1+ (Laragon ou XAMPP recomendado)
  - Acesso ao servidor de BD: vsgate-s1.dei.isep.ipp.pt:10464
  - Browser moderno (Chrome, Firefox, Edge)

Passos de instalação:

1. Copiar a pasta do projeto para o servidor web local:
   C:\laragon\www\sibdas\1241446\inventario-hospital\
   (ou C:\xampp\htdocs\sibdas\1241446\inventario-hospital\)

2. Preparar a base de dados no servidor SIBDAS:
   - Ligar ao servidor vsgate-s1.dei.isep.ipp.pt:10464 com HeidiSQL
     (utilizador = numero de estudante, password indicada na aula PL)
   - Executar o script: database/schema.sql (cria as tabelas e estrutura)
   - Executar o script: database/dados.sql (insere os dados de teste)
   - Alternativa: importar database/db1241446.sql (estrutura + dados completos)

3. Verificar as configurações em config/config.php:
   - MYSQL_HOST, MYSQL_PORT, MYSQL_DATABASE, MYSQL_USERNAME, MYSQL_PASSWORD
   - APP_BASE deve corresponder ao caminho correto no servidor

4. Aceder à aplicação em:
   http://127.0.0.1/sibdas/1241446/inventario-hospital/public/

--------------------------------------------------------------------------------
INSTRUÇÕES PARA TESTES
--------------------------------------------------------------------------------

Área Pública (sem login):
  - Aceder a: http://127.0.0.1/sibdas/1241446/inventario-hospital/public/
  - Navegar pelas páginas: Início, Solução, Funcionalidades, Clientes, Contacto
  - Testar formulário de contacto (validação JavaScript e PHP)

Autenticação:
  - Aceder ao login: public/login.php
  - Testar botões de preenchimento automático "Preencher Admin" e "Preencher Técnico"
  - Testar login com credenciais inválidas (mensagens de erro)
  - Testar login com credenciais válidas (redirecionamento para dashboard)

Área Privada (após login):
  - Dashboard: verificar KPIs, gráficos de estado e criticidade, alertas de garantia
  - Equipamentos: listar, criar, editar, ver detalhes, desativar (soft delete + confirmação)
  - Exportar CSV: botão "Exportar CSV" na lista de equipamentos
  - Fornecedores: listar e ver detalhes
  - Localizações: listar e criar
  - Documentos: listar documentos associados a equipamentos
  - Garantias: listar garantias com estado de validade
  - Conteúdos: gerir notícias, testemunhos e mensagens de contacto

Sidebar condicional por perfil:
  - ADMINISTRADOR/GESTOR: acesso a Fornecedores e Conteúdos
  - ADMINISTRADOR/GESTOR/TECNICO: acesso a Localizações
  - CONSULTOR: acesso apenas a Equipamentos, Documentos e Garantias

--------------------------------------------------------------------------------
CREDENCIAIS DE ACESSO
--------------------------------------------------------------------------------

Perfil Administrador:
  Email    : admin@medcontrol.pt
  Password : admin123

Perfil Técnico:
  Email    : carlos@medcontrol.pt
  Password : senha123

Perfil Gestor:
  Email    : joana@medcontrol.pt
  Password : senha456

Perfil Consultor:
  Email    : rui@medcontrol.pt
  Password : senha789

Nota: As passwords são armazenadas com bcrypt (password_hash PHP).

--------------------------------------------------------------------------------
INFORMAÇÃO ADICIONAL
--------------------------------------------------------------------------------

- Base de dados: MySQL 8.0, servidor SIBDAS vsgate-s1.dei.isep.ipp.pt:10464
- Todas as bibliotecas externas estão incluídas localmente (sem CDN)
  para funcionamento offline durante a apresentação
- Logs da aplicação em: private/logs/app.log
- Ficheiro DBML disponível em: database/schema.dbml
- Script DDL disponível em: database/schema.sql
- Dados de teste disponíveis em: database/dados.sql
- Exportação completa da BD: database/db1241446.sql
- Histórico de commits: commits.txt

================================================================================
