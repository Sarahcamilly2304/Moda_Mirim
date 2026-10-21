<?php
require_once __DIR__ . '/../database/connect.php';
require_once __DIR__ . '/../includes/header.php';

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

<section style="max-width: 600px; margin: 40px auto; padding: 30px; background-color: #ffffff; border-radius: 12px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08); font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
    
    <div style="text-align: center; margin-bottom: 25px;">
        <h2 style="font-size: 2rem; color: #802A41; margin-bottom: 8px; font-weight: 700;">Entre em Contato</h2>
        <p style="color: #666; font-size: 0.95rem; line-height: 1.5; margin: 0;">
            Ficou com alguma dúvida sobre nossas peças infantis? Envie uma mensagem pra gente!
        </p>
    </div>

    <form action="" method="POST" style="display: flex; flex-direction: column; gap: 18px;">
        
        <div style="display: flex; flex-direction: column; gap: 6px;">
            <label style="font-weight: 600; color: #444; font-size: 0.9rem;">Nome Completo</label>
            <input type="text" name="nome" placeholder="Digite seu nome" required style="width: 100%; padding: 12px 14px; border: 1px solid #ccc; border-radius: 6px; font-size: 0.95rem; outline: none; box-sizing: border-radius: 6px; transition: border-color 0.2s;">
        </div>

        <div style="display: flex; flex-direction: column; gap: 6px;">
            <label style="font-weight: 600; color: #444; font-size: 0.9rem;">E-mail</label>
            <input type="email" name="email" placeholder="Digite seu e-mail" required style="width: 100%; padding: 12px 14px; border: 1px solid #ccc; border-radius: 6px; font-size: 0.95rem; outline: none; box-sizing: border-box;">
        </div>

        <div style="display: flex; flex-direction: column; gap: 6px;">
            <label style="font-weight: 600; color: #444; font-size: 0.9rem;">Assunto</label>
            <input type="text" name="assunto" placeholder="Ex: Dúvida sobre tamanhos" required style="width: 100%; padding: 12px 14px; border: 1px solid #ccc; border-radius: 6px; font-size: 0.95rem; outline: none; box-sizing: border-box;">
        </div>

        <div style="display: flex; flex-direction: column; gap: 6px;">
            <label style="font-weight: 600; color: #444; font-size: 0.9rem;">Mensagem</label>
            <textarea name="mensagem" rows="4" placeholder="Escreva sua mensagem aqui..." required style="width: 100%; padding: 12px 14px; border: 1px solid #ccc; border-radius: 6px; font-size: 0.95rem; outline: none; resize: vertical; box-sizing: border-box; font-family: inherit;"></textarea>
        </div>

        <button type="submit" style="background-color: #802A41; color: #ffffff; border: none; padding: 14px; border-radius: 6px; font-size: 1rem; font-weight: 600; cursor: pointer; transition: background-color 0.2s, transform 0.1s; margin-top: 10px;">
            Enviar Mensagem
        </button>

    </form>
</section>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>