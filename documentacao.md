# Documentação do Sistema — Moda Mirim

## 1. Descrição
Sistema Web para Gestão Interna da loja Moda Mirim (Moda Praia Infantil).

---

## 2. Tecnologias Utilizadas
- **PHP**: Linguagem para processamento no servidor (Server-Side).
- **PDO**: Conexão segura com o banco de dados via *Prepared Statements*.
- **MySQL**: Banco de dados relacional.
- **HTML5 & CSS3**: Interface responsiva e estilizada conforme o layout/wireframe.

---

## 3. Estrutura de Pastas e Arquivos

### `/app/` — Gestão de Produtos
- `create.php`: Formulário e script para cadastro de novos produtos.
- `delete.php`: Script para exclusão/remoção de produtos do sistema.
- `select.php`: Listagem geral de produtos com links de ação (CRUD).
- `select_w.php`: Consulta de produtos com filtragem dinâmica por categoria (*Cláusula WHERE*).
- `update.php`: Edição das informações de produtos existentes.

### `/database/` — Conexão
- `connect.php`: Script PDO responsável pela conexão com a base de dados MySQL.

### `/includes/` — Componentes Reutilizáveis
- `footer.php`: Rodapé padrão do site.
- `functions.php`: Funções auxiliares (sessão, sanitização e formatação de valores).
- `header.php`: Cabeçalho principal com pesquisa, ações de usuário e menu de navegação.

### `/login/` — Autenticação e Usuários
- `cadastrar.php`: Cadastro de novos clientes/usuários.
- `login.php`: Tela de autenticação de usuários