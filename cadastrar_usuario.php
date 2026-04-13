<?php
// O bloco PHP fica no topo. Se o formulário for enviado, ele salva e redireciona.
if (isset($_POST['nome']) && $_POST['nome'] != "") {
    
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    
    // Monta a linha e salva no txt
    $linha = $nome . "|" . $email . PHP_EOL;
    file_put_contents('usuarios.txt', $linha, FILE_APPEND);
    
    // Redireciona para a página de criar pergunta e encerra o script
    header("Location: cadastrar_pergunta.php");
    exit(); 
}
?>

<h2>Cadastro de Gestor</h2>

<form method="POST">
    Nome: <br>
    <input type="text" name="nome" required><br><br>
    
    E-mail: <br>
    <input type="email" name="email" required><br><br>
    
    <input type="submit" value="Salvar Gestor e Continuar">
</form>

<br>
<a href="index.php">Voltar</a>
