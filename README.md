# MedInventa — Sistema de Gestão de Inventário Hospitalar

**Projeto:** Sistemas de Informação — Licenciatura em Engenharia Biomédica e Organizacional e de Medicina  
**Estudante:** 1241446  
**Ano Letivo:** 2025-2026  
**Instituição:** Instituto Superior de Engenharia do Porto (ISEP)

---

## Descrição

O **MedInventa** é uma aplicação web de gestão de inventário de equipamentos médicos hospitalares. A plataforma é composta por duas áreas:

- **Front Office (`public/`)** — Website institucional da empresa de software, acessível ao público geral.
- **Back Office (`private/`)** — Aplicação interna de gestão do inventário, acessível após autenticação.

---

## Estrutura de Diretórios

```
inventario_hospital/
│
├── public/                  # Área pública (front office)
│   ├── index.html           # Página inicial — Quem Somos
│   ├── solucao.html         # A Nossa Solução
│   ├── funcionalidades.html # Funcionalidades do Sistema
│   ├── clientes.html        # Clientes e Testemunhos
│   ├── contacto.html        # Formulário de Contacto
│   └── login.html           # Autenticação
│
├── private/                 # Área privada (back office)
│   ├── index.html           # Dashboard com KPIs e alertas
│   └── views/
│       ├── equipamentos/    # Lista, novo, detalhes, editar
│       ├── localizacoes/    # Lista, novo
│       ├── fornecedores/    # Lista, novo, detalhes
│       ├── documentos/      # Lista
│       ├── garantias/       # Lista com alertas
│       └── conteudos/       # Gestão de conteúdos públicos
│
├── assets/
│   ├── css/
│   │   ├── 1241446.css      # Estilos do front office
│   │   └── backoffice.css   # Estilos do back office
│   ├── js/
│   │   └── 1241446.js       # Mock data e utilitários JS
│   └── img/                 # Imagens partilhadas
│
├── commits.txt              # Histórico de commits Git
└── README.md                # Este ficheiro
```

---

## Tecnologias Utilizadas

| Tecnologia | Versão | Utilização |
|---|---|---|
| HTML5 | — | Estrutura de todas as páginas |
| CSS3 | — | Estilos personalizados |
| JavaScript | ES6+ | Lógica de interface e mock data |
| Bootstrap | 5.3.2 | Grid responsivo, navbar, accordion |
| Font Awesome | 6.5.0 | Ícones em todas as páginas |

> CDNs utilizados: `cdnjs.cloudflare.com`

---

## Funcionalidades Implementadas

### Front Office (Área Pública)
- Navbar responsiva com hamburger menu (Bootstrap `navbar-expand-lg`)
- Página **Quem Somos** com hero section, stats e tecnologias
- Página **A Solução** com módulos e arquitetura da plataforma
- Página **Funcionalidades** com Bootstrap **Accordion** (FAQ) — componente avançado
- Página **Clientes** com cards de hospitais e testemunhos
- Página **Contacto** com formulário validado em JavaScript
- Página de **Login** com autenticação mock

### Back Office (Área Privada)
- **Dashboard** com KPIs em tempo real, alertas de garantias e gráficos de distribuição
- **Equipamentos** — lista com filtros, pesquisa, paginação; ficha detalhada; formulário de criação e edição
- **Localizações** — lista e formulário de criação
- **Fornecedores** — lista, ficha detalhada e formulário de criação
- **Documentação** — lista de documentos técnicos associados a equipamentos
- **Garantias** — lista com alertas visuais por estado de garantia
- **Conteúdos Públicos** — backoffice para gerir notícias, destaques, testemunhos e mensagens do site

### Componente Bootstrap Avançado
O **Accordion** (FAQ) na página `public/funcionalidades.html` é o componente avançado exigido pelo enunciado.  
Utiliza: `.accordion`, `.accordion-item`, `.accordion-header`, `.accordion-button`, `.accordion-collapse`, `data-bs-toggle="collapse"`, `data-bs-parent`.

---

## Credenciais de Acesso (Demo)

| Utilizador | Password |
|---|---|
| `admin` | `admin123` |

---

## Como Abrir o Projeto

1. Extrair o arquivo ZIP (ou clonar o repositório)
2. Abrir `public/index.html` num browser para aceder ao front office
3. Clicar em **Área Restrita** → fazer login com as credenciais acima
4. O back office abre em `private/index.html`

> Não é necessário servidor web — todas as páginas funcionam diretamente no browser como ficheiros HTML estáticos.

---

## Dados Mock

Os dados de exemplo estão definidos em `assets/js/1241446.js` e incluem:
- **8 equipamentos** de diversas categorias e estados
- **10 localizações** distribuídas por serviços hospitalares
- **6 fornecedores** com contactos e países
- **6 documentos** técnicos

---

## Histórico de Commits

Ver ficheiro `commits.txt` gerado com:
```
git log --pretty=format:"%h - %an - %ad - %s" --date=iso > commits.txt
```
