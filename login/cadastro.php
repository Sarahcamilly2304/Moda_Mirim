<?php
require_once __DIR__ . '/../database/connect.php';
require_once __DIR__ . '/../includes/header.php';
?>

<div class="container" style="display: flex; justify-content: center; align-items: center; min-height: 80vh; padding: 20px;">
    <div style="background: #fff; padding: 40px; border-radius: 10px; box-shadow: 0 4px 15px rgba(0,0,0,0.08); width: 100%; max-width: 480px; border: 1px solid #e2e2e2;">
        <h2 style="text-align: center; color: #802A41; margin-bottom: 8px; font-size: 1.8rem;">Cadastro de Cliente</h2>
        <p style="text-align: center; color: #666; margin-bottom: 25px; font-size: 0.95rem;">Junte-se à família Moda Mirim</p>

        <form action="processar_cadastro.php" method="POST" style="display: flex; flex-direction: column; gap: 15px;">
            <div>
                <label style="display: block; margin-bottom: 5px; color: #333; font-weight: bold; font-size: 0.9rem;">Nome Completo:</label>
                <input type="text" name="nome" required placeholder="O seu nome" style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 6px; font-size: 1rem; box-sizing: border-box;">
            </div>

            <div>
                <label style="display: block; margin-bottom: 5px; color: #333; font-weight: bold; font-size: 0.9rem;">E-mail:</label>
                <input type="email" name="email" required placeholder="seu@email.com" style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 6px; font-size: 1rem; box-sizing: border-box;">
            </div>

            <div>
                <label style="display: block; margin-bottom: 5px; color: #333; font-weight: bold; font-size: 0.9rem;">Telefone:</label>
                <input type="text" name="telefone" placeholder="(00) 00000-0000" style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 6px; font-size: 1rem; box-sizing: border-box;">
            </div>

            <div>
                <label style="display: block; margin-bottom: 5px; color: #333; font-weight: bold; font-size: 0.9rem;">Senha:</label>
                <input type="password" name="senha" required placeholder="••••••••" style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 6px; font-size: 1rem; box-sizing: border-box;">
            </div>

            <button type="submit" style="background: #802A41; color: white; border: none; padding: 12px; border-radius: 6px; font-weight: bold; font-size: 1rem; cursor: pointer; margin-top: 10px; box-shadow: 0 3px 6px rgba(128,42,65,0.25); transition: background 0.2s;">
                Cadastrar
            </button>
        </form>

        <p style="text-align: center; margin-top: 20px; font-size: 0.9rem; color: #666;">
            Já tem uma conta? <a href="login.php" style="color: #802A41; font-weight: bold; text-decoration: none;">Faça login</a>
        </p>
    </div>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>