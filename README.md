
# 𓊝 Moda Mirim — Documentação (SRS/ERS) °‧ 𓆝 𓆟 𓆞 ·｡

## 𓆉︎ 1. Introdução
**Sistema:** Moda Mirim — E-commerce de Moda Praia Infantil  
**Tipo de documento:** Especificação de Requisitos de Software (SRS/ERS) 

## 1.1. Tecnologias Utilizadas
- **PHP**: Linguagem para processamento no servidor (Server-Side).
- **PDO**: Conexão segura com o banco de dados via *Prepared Statements*.
- **MySQL**: Banco de dados relacional.
- **HTML5 & CSS3**: Interface responsiva e estilizada
---
### 𓇼 1.2. Propósito
Este documento especifica os requisitos funcionais e não funcionais do **Moda Mirim**, uma aplicação web desenvolvida para funcionar como um e-commerce especializado em moda praia infantil. O documento descreve as funcionalidades especiais, as regras de negócio, os dados utilizados, entre outros.

A concepção tem como objetivos:
- Padronizar o entendimento sobre o funcionamento do Moda Mirim;
- Registrar os recursos disponíveis e os limites do sistema;
- Servir como referência para desenvolvimento, testes e manutenção;
- Apoiar a identificação de falhas e a evolução do projeto;
- Relacionar requisitos, regras de negócio e critérios de limites acessíveis.

### 𓇼 1.3. Escopo do produto
O Moda Mirim permite que clientes interessados em moda e conforto para pequenos na praia criem uma conta, façam login e comprem peças como maiôs, biquínis, sungas e camisas com proteção UV para os pequenos. Os usuários podem administrar seus carrinhos de compras, gerir suas contas e entrar em contato com a loja. O sistema também possui gerenciamento de perfil, páginas institucionais (Sobre Nós) e de suporte ao cliente.

### 𓇼 1.4. Contexto e problema
A comercialização de vestuário infantil voltado para praia muitas vezes carece de plataformas digitais limpas, intuitivas e com navegação simplificada que mantenham uma identidade visual harmoniosa e profissional. O Moda Mirim soluciona essa necessidade ao reunir um catálogo segmentado, carrinho dinâmico e painel de autenticação em uma plataforma web unificada.

### 𓇼 1.5. Definições e acrônimos

| Termo | " |
| :--- | :--- |
| **Moda Mirim** | Sistema web de e-commerce de moda praia infantil descrito neste documento. |
| **CRUD** | Sigla de *Criar, Ler, Atualizar e Excluir*: criar, consultar, atualizar e excluir registros. |
| **DER** | Diagrama Entidade-Relacionamento, utilizado para representar entidades e relacionamentos do banco de dados. |
| **RF** | Requisito Funcional. |
| **RNF** | Requisito Não Funcional. |
| **RN** | Regra de Negócio. |

---

## 𓅇 2. Descrição geral do sistema

### 𓇼 2.1. Perspectiva do produto
O Moda Mirim é uma aplicação web conectada a um banco de dados PostgreSQL. A interface permite que o usuário interaja com o sistema por meio de páginas e formulários. O PHP processa requisições, aplica validações e regras de negócio, e realiza operações no banco de dados.

Visão simplificada da arquitetura:
- **Navegador:** Interface em HTML, CSS e JavaScript.
- **Servidor Web (PHP):** Processamento de regras de negócio, sessões de carrinho e validação.
- **Banco de Dados (PostgreSQL):** Armazenamento de usuários, produtos e mensagens de contato.

### 𓇼 2.2. Funções principais
O sistema permite ao usuário:
- Criar um usuário para si mesmo;
- Realizar login e logout;
- Visualizar a página inicial com destaques da coleção;
- Navegar pelo catálogo completo ou filtrar por categoria (Maiôs, Biquínis, Sungas, Camisas UV);
- Adicionar, atualizar quantidade e remover itens do carrinho de compras em sessão;
- Consultar e atualizar informações do seu perfil;
- Enviar mensagens através do formulário de contato.

### 𓇼 2.3. Classes de usuários

| Tipo de usuário | Descrição | Permissões esperadas |
| :--- | :--- | :--- |
| **Visitante** | Pessoa que ainda não entrou em uma sessão autenticada. | Acessar telas públicas, navegar pelo catálogo, filtrar produtos, gerir o carrinho e realizar cadastro ou login. |
| **Usuário autenticado** | Pessoa que entrou no sistema com credenciais válidas. | Gerenciar informações de perfil, finalizar pedidos e encerrar a sessão. |
| **Responsável pela manutenção** | Pessoa que desenvolve ou mantém o projeto. | Atua sobre o código e o ambiente de execução. Não implica a existência de um perfil administrativo dentro da aplicação. |

---

## 𓅓 3. Requisitos do sistema

### 𓇼 3.1. Concordância e prioridade
Os requisitos são identificados como RF-XXX e RNF-XXX. A prioridade está definida como:
- **Alta:** essencial ao objetivo principal ou à segurança do sistema.
- **Média:** importante para completar a experiência e a consistência do uso.
- **Baixa:** melhoria de qualidade que não impeça o funcionamento básico.

### 𓇼 3.2. Requisitos funcionais

#### Cadastro e autenticação
* **RF-001 — Cadastro de usuário**  
  **Prioridade:** Alta  
  **Descrição:** O sistema deve permitir que uma pessoa crie uma conta por meio de um formulário de cadastro.  
  **Critérios:** O nome, e-mail e senha devem ser solicitados; a senha deve ser armazenada utilizando hash.

* **RF-002 — Validação dos dados de cadastro**  
  **Prioridade:** Alta  
  **Descrição:** O sistema deve validar os dados recebidos antes de criar uma conta, impedindo e-mails duplicados.

* **RF-003 — Login**  
  **Prioridade:** Alta  
  **Descrição:** O sistema deve permitir que o usuário cadastrado entre na plataforma com e-mail e senha.

* **RF-004 — Proteção de páginas privadas**  
  **Prioridade:** Alta  
  **Descrição:** O sistema deve restringir acesso ao checkout e perfil apenas a usuários autenticados.

* **RF-005 — Sair (Logout)**  
  **Prioridade:** Alta  
  **Descrição:** O sistema deve disponibilizar uma operação para encerrar a sessão do usuário de forma definitiva.

#### 𓇼 Gerenciamento de produtos e carrinho
* **RF-006 — Listar produtos**  
  **Prioridade:** Alta  
  **Descrição:** O sistema deve apresentar os produtos cadastrados com imagem, nome, preço e opção de parcelamento.

* **RF-007 — Filtrar por categoria**  
  **Prioridade:** Alta  
  **Descrição:** O sistema deve permitir a filtragem por Maiôs, Biquínis, Sungas e Camisas UV.

* **RF-008 — Carrinho de compras em sessão**  
  **Prioridade:** Alta  
  **Descrição:** O sistema deve permitir adicionar, remover e calcular o valor total dos produtos no carrinho.

### 𓇼 3.3. Requisitos não funcionais
* **RNF-001 — Armazenamento seguro de senhas**  
  **Prioridade:** Alta  
  **Descrição:** As senhas dos usuários devem ser armazenadas utilizando `password_hash()` e validadas com `password_verify()`.

* **RNF-002 — Proteção do Banco de Dados**  
  **Prioridade:** Alta  
  **Descrição:** Todas as consultas devem utilizar declarações preparadas (PDO) para evitar SQL Injection.

* **RNF-003 — Padronização Visual**  
  **Prioridade:** Alta  
  **Descrição:** A interface deve manter o padrão estético em tons nude `#D3A79A`, bordô `#802A41` e botões retangulares sem arredondamento.

---

## 𓆝 4. Regras de negócio

* **RN-001 — Unicidade de E-mail:** Cada endereço de e-mail só pode ser associado a uma única conta no sistema.
* **RN-002 — Criptografia de Senha:** Nenhuma senha pode ser salva em texto limpo no banco de dados.
* **RN-003 — Atualização do Carrinho:** O contador no cabeçalho deve refletir em tempo real a soma dos itens armazenados na sessão.

---

## 𓆈 5. Estrutura do projeto

### 5.1. Organização de diretórios e arquivos
```text
moda_mirim/
├── app/
│   ├── carrinho.php
│   ├── checkout.php
│   ├── contato.php
│   ├── select.php
│   └── sobre.php
├── database/
│   └── connect.php
├── imagens/
├── includes/
│   ├── footer.php
│   ├── functions.php
│   └── header.php
├── login/
│   ├── cadastro.php
│   ├── login.php
│   ├── logout.php
│   ├── update.php
│   └── verifica_user.php
├── produtos/
│   ├── biquini.php
│   ├── maio.php
│   ├── Protecaouv.php
│   └── sunga.php
├── banco.sql
└── style.css

```

---

## 𓃦 6. Banco de dados e DER

### 6.1. Relacionamentos

* **Usuários e Pedidos:** Relacionamento 1:N entre a tabela `usuarios` e suas compras.
* **Produtos:** Tabela independente utilizada para alimentar o catálogo dinâmico.

### 6.2. Dicionário de Dados

#### Tabela 1: `usuarios`

| Nome do Campo | Nome no Banco | Tipo de Dado | Descrição | Chave | Obrigatório |
| --- | --- | --- | --- | --- | --- |
| ID do Usuário | `id` | INT | Identificador único do usuário | PK | NOT NULL |
| Nome Completo | `nome` | VARCHAR(100) | Nome informado no cadastro | -- | NOT NULL |
| E-mail | `email` | VARCHAR(100) | E-mail exclusivo para login | -- | NOT NULL |
| Senha | `senha` | VARCHAR(255) | Hash gerado via `password_hash()` | -- | NOT NULL |

#### Tabela 2: `produtos`

| Nome do Campo | Nome no Banco | Tipo de Dado | Descrição | Chave | Obrigatório |
| --- | --- | --- | --- | --- | --- |
| ID do Produto | `id` | INT | Identificador único do produto | PK | NOT NULL |
| Nome do Produto | `nome` | VARCHAR(150) | Nome descritivo da peça | -- | NOT NULL |
| Preço | `preco` | DECIMAL(10,2) | Valor do produto | -- | NOT NULL |
| Categoria | `categoria` | VARCHAR(50) | Categoria da peça de roupa | -- | NOT NULL |
| Imagem | `imagem` | VARCHAR(255) | Nome do arquivo de imagem | -- | NOT NULL |

---

## 𓃗 7. Ciclo de navegação e execução

### 7.1. Fluxo de navegação

1. **Acesso Inicial:** O visitante abre o Moda Mirim no navegador (`index.php`).
2. **Navegação no Catálogo:** Acessa a lista de produtos em `/app/select.php` ou filtra pelas categorias na pasta `/produtos/`.
3. **Gerenciamento do Carrinho:** Adiciona itens, visualiza o subtotal em `/app/carrinho.php`.
4. **Autenticação:** Realiza login em `/login/login.php` ou cadastro em `/login/cadastro.php`.

---

## 𓃰 8. Backlog do Produto

| ID | Item | Descrição / Resultado Esperado | Prioridade |
| --- | --- | --- | --- |
| PB-001 | Cadastro de usuário | Permitir que novos clientes criem conta. | Alta |
| PB-002 | Login de usuário | Autenticação segura com e-mail e senha. | Alta |
| PB-003 | Listagem de produtos | Exibir os produtos e categorias. | Alta |
| PB-004 | Carrinho dinâmico | Gerenciar produtos selecionados em sessão. | Alta |
| PB-005 | Formulário de contato | Envio de mensagens de dúvidas. | Alta |

---

## 𓆗 9. Execução do Projeto

### Pré-requisitos

* PHP instalado e configurado;
* PostgreSQL instalado e em execução;
* Navegador web.

### Passo a Passo

#### Passo 1: Configurar o Banco de Dados

Abra o Terminal ou PowerShell e conecte-se ao PostgreSQL:

```bash
psql -U postgres

```

Crie a base de dados do projeto:

```sql
CREATE DATABASE moda_mirim;

```

Restaure a estrutura do banco utilizando o ficheiro `banco.sql`:

```bash
psql -U postgres -d moda_mirim -f banco.sql

```

#### Passo 2: Configurar a conexão no PHP

No ficheiro `database/connect.php`, ajuste as credenciais de acesso local:

```php
<?php
$host = "localhost";
$port = "";
$dbname = "moda_mirim";
$user = "moda_mirim";
$password = "moda_mirim";

try {
    $conn = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    $conn = null;
}
?>

```

#### Passo 3: Executar a Aplicação

Com o terminal aberto na pasta raiz do projeto (`moda_mirim`), inicie o servidor interno do PHP:

```bash
php -S localhost:8000

```

O projeto estará acessível através do endereço:

`http://localhost:8000`


