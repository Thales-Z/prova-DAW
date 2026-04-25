<?php

if (isset($_POST['pergunta']) && $_POST['pergunta'] != "") {
    
    $id = time(); 
    $tipo = "texto"; /
    $pergunta = $_POST['pergunta'];
    $resposta = $_POST['resposta'];

    
    $linha = $id . "|" . $tipo . "|" . $pergunta . "|" . $resposta . "||||" . PHP_EOL;
    
    file_put_contents('perguntas.txt', $linha, FILE_APPEND);
    
    echo "<b>Pergunta de texto criada com sucesso!</b><hr>";
}
?>

<h2>Crie sua Pergunta (Texto Livre)</h2>

<form method="POST">
    <b>Texto da Pergunta:</b><br>
    <textarea name="pergunta" rows="3" cols="50" required placeholder="Ex: Como você resolveria o atraso de um projeto?"></textarea><br><br>
    
    <b>Resposta Esperada / Critério de Avaliação:</b><br>
    <textarea name="resposta" rows="3" cols="50" required placeholder="Ex: O gestor deve comunicar a equipe e reajustar o cronograma."></textarea><br><br>

    <input type="submit" value="Salvar Pergunta">
</form>

<br>
<a href="index.php">Voltar ao Menu Principal</a>
