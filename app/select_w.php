<?php
require_once '../database/connect.php';
require_once '../login/verifica_user.php';
verificarAdmin();

// Lista Produtos
$stmtProdutos = $conn->query("SELECT * FROM produtos ORDER BY id DESC");
$produtos = $stmtProdutos->fetchAll();

// Lista Clientes
$stmtClientes = $conn->query("SELECT * FROM usuarios WHERE perfil = 'cliente' ORDER BY id DESC");
$clientes = $stmtClientes->fetchAll();

require_once '../includes/header.php';
?>

<h2>Painel de Administração - Moda Mirim</h2>

<section style="margin-bottom: 3rem; margin-top: 1.5rem;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
        <h3>Gerenciar Produtos</h3>
        <a href="create.php" class="btn" style="width: auto; text-decoration: none;">+ Novo Produto</a>
    </div>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Categoria</th>
                <th>Tamanho</th>
                <th>Preço</th>
                <th>Estoque</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($produtos as $p): ?>
                <tr>
                    <td><?= $p['id']; ?></td>
                    <td><?= htmlspecialchars($p['nome']); ?></td>
                    <td><?= htmlspecialchars($p['categoria']); ?></td>
                    <td><?= htmlspecialchars($p['tamanho']); ?></td>
                    <td><?= formatarPreco($p['preco']); ?></td>
                    <td><?= $p['estoque']; ?></td>
                    <td>
                        <a href="update.php?id=<?= $p['id']; ?>" style="color: #00838f; font-weight: bold; margin-right: 10px;">Editar</a>
                        <a href="delete.php?id=<?= $p['id']; ?>&tipo=produto" onclick="return confirm('Deseja excluir este produto?')" style="color: red; font-weight: bold;">Excluir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</section>

<section>
    <h3>Clientes Cadastrados</h3>
    <table style="margin-top: 1rem;">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Telefone</th>
                <th>Data Cadastro</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($clientes as $c): ?>
                <tr>
                    <td><?= $c['id']; ?></td>
                    <td><?= htmlspecialchars($c['nome']); ?></td>
                    <td><?= htmlspecialchars($c['email']); ?></td>
                    <td><?= htmlspecialchars($c['telefone']); ?></td>
                    <td><?= date('d/m/Y', strtotime($c['data_cadastro'])); ?></td>
                    <td>
                        <a href="delete.php?id=<?= $c['id']; ?>&tipo=cliente" onclick="return confirm('Deseja excluir este cliente?')" style="color: red; font-weight: bold;">Excluir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</section>

<?php require_once '../includes/footer.php'; ?>