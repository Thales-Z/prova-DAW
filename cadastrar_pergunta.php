<?php
// 1. Verifica se o formulário foi enviado
if (isset($_POST['pergunta']) && $_POST['pergunta'] != "") {
    
    // 2. Recebe os dados do formulário
    $id = time(); // Cria um ID único usando a hora atual (ajuda na hora de excluir/editar)
    $tipo = "multipla"; // Define o tipo da pergunta
    $pergunta = $_POST['pergunta'];
    $opA = $_POST['opA'];
    $opB = $_POST['opB'];
    $opC = $_POST['opC'];
    $opD = $_POST['opD'];
    $correta = $_POST['correta']; // Recebe qual letra (A, B, C ou D) é a certa

    // 3. Monta a linha com todos os dados separados por |
    $linha = $id . "|" . $tipo . "|" . $pergunta . "|" . $opA . "|" . $opB . "|" . $opC . "|" . $opD . "|" . $correta . PHP_EOL;
    
    // 4. Salva no arquivo perguntas.txt
    file_put_contents('perguntas.txt', $linha, FILE_APPEND);
    
    echo "<b>Pergunta criada com sucesso!</b><hr>";
}
?>

<h2>Crie sua Pergunta (Múltipla Escolha)</h2>

<form method="POST">
    <b>Texto da Pergunta:</b><br>
    <textarea name="pergunta" rows="3" cols="50" required></textarea><br><br>
    
    <b>Opções de Resposta:</b><br>
    <input type="radio" name="correta" value="A" required> A) <input type="text" name="opA" required><br>
    <input type="radio" name="correta" value="B"> B) <input type="text" name="opB" required><br>
    <input type="radio" name="correta" value="C"> C) <input type="text" name="opC" required><br>
    <input type="radio" name="correta" value="D"> D) <input type="text" name="opD" required><br><br>
    
    <small><i>* Marque a bolinha ao lado da resposta que é a correta.</i></small><br><br>

    <input type="submit" value="Salvar Pergunta">
</form>

<br>
<a href="index.php">Voltar ao Menu Principal</a>
