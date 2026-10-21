<?php
require_once __DIR__ . '/database/connect.php';
require_once __DIR__ . '/includes/header.php';

$mensagemEnviada = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $assunto = trim($_POST['assunto'] ?? '');
    $mensagem = trim($_POST['mensagem'] ?? '');

    if (!empty($nome) && !empty($email) && !empty($mensagem)) {
        // Tenta salvar no banco de dados se a tabela existir
        if (isset($conn) && $conn) {
            try {
                $stmt = $conn->prepare("INSERT INTO contatos (nome, email, assunto, mensagem) VALUES (:nome, :email, :assunto, :mensagem)");
                $stmt->execute([
                    ':nome' => $nome,
                    ':email' => $email,
                    ':assunto' => $assunto,
                    ':mensagem' => $mensagem
                ]);
            } catch (PDOException $e) {
                // Caso a tabela de contatos não exista no banco
            }
        }
        $mensagemEnviada = true;
    }
}
?>

<div class="container">
    <div style="max-width: 650px; margin: 2rem auto;">
        <h2>Entre em Contato</h2>
        <p style="margin-bottom: 2rem; color: #555;">Ficou com alguma dúvida sobre nossas peças infantis? Envie uma mensagem pra gente!</p>

        <?php if ($mensagemEnviada): ?>
            <div style="background-color: #D4EDDA; color: #155724; padding: 15px; border-radius: 0px; margin-bottom: 2rem; border: 1px solid #C3E6CB;">
                Sua mensagem foi enviada com sucesso! Em breve entraremos em contato.
            </div>
        <?php endif; ?>

        <div class="form-box">
            <form action="contato.php" method="POST">
                <div class="form-group">
                    <label for="nome">Nome Completo</label>
                    <input type="text" id="nome" name="nome" required placeholder="Digite seu nome">
                </div>

                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="email" id="email" name="email" required placeholder="Digite seu e-mail">
                </div>

                <div class="form-group">
                    <label for="assunto">Assunto</label>
                    <input type="text" id="assunto" name="assunto" placeholder="Ex: Dúvida sobre tamanhos">
                </div>

                <div class="form-group">
                    <label for="mensagem">Mensagem</label>
                    <textarea id="mensagem" name="mensagem" rows="5" required placeholder="Escreva sua mensagem aqui..."></textarea>
                </div>

                <button type="submit" class="btn" style="width: 100%;">Enviar Mensagem</button>
            </form>
        </div>

        <div style="margin-top: 3rem; background: #FFFFFF; padding: 2rem; box-shadow: 0 4px 15px rgba(0,0,0,0.04);">
            <h3 style="font-size: 1.1rem; margin-bottom: 1rem; color: #802A41;">Outros Canais de Atendimento</h3>
            <p style="margin-bottom: 0.5rem; color: #444;"><strong>WhatsApp:</strong> (19) 99999-9999</p>
            <p style="margin-bottom: 0.5rem; color: #444;"><strong>E-mail:</strong> contato@modamirim.com.br</p>
            <p style="color: #444;"><strong>Atendimento:</strong> Segunda a Sexta, das 08h às 18h</p>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>