<?php
$id_procurado = $_GET['id']; // 
$dados_pergunta = []; 

// 1. SE O FORMULÁRIO FOI ENVIADO (Atualizar o arquivo txt)
if (isset($_POST['pergunta'])) {
    $id = $_POST['id'];
    $tipo = $_POST['tipo'];
    $pergunta = $_POST['pergunta'];

    // Monta a nova linha dependendo do tipo
    if ($tipo == "multipla") {
        $opA = $_POST['opA'];
        $opB = $_POST['opB'];
        $opC = $_POST['opC'];
        $opD = $_POST['opD'];
        $correta = $_POST['correta'];
        $nova_linha = $id . "|" . $tipo . "|" . $pergunta . "|" . $opA . "|" . $opB . "|" . $opC . "|" . $opD . "|" . $correta . PHP_EOL;
    } else {
        $resposta = $_POST['resposta'];
        $nova_linha = $id . "|" . $tipo . "|" . $pergunta . "|" . $resposta . "||||" . PHP_EOL;
    }

    // Lê o arquivo antigo, substitui a linha alterada e salva
    $linhas = file('perguntas.txt');
    $novo_conteudo = "";
    
    foreach ($linhas as $linha) {
        $dados = explode('|', trim($linha));
        if ($dados[0] == $id) {
            $novo_conteudo .= $nova_linha; // Coloca a linha nova
        } else {
            $novo_conteudo .= $linha; // Mantém a linha velha
        }
    }
    
    file_put_contents('perguntas.txt', $novo_conteudo);
    echo "<b>Pergunta alterada com sucesso!</b><hr>";
}

// 2. BUSCAR OS DADOS ATUAIS PARA PREENCHER O FORMULÁRIO
$linhas = file('perguntas.txt');
foreach ($linhas as $linha) {
    $dados = explode('|', trim($linha));
    if ($dados[0] == $id_procurado) {
        $dados_pergunta = $dados;
        break;
    }
}
?>

<h2>Alterar Pergunta</h2>

<form method="POST">
    <input type="hidden" name="id" value="<?php echo $dados_pergunta[0]; ?>">
    <input type="hidden" name="tipo" value="<?php echo $dados_pergunta[1]; ?>">

    <b>Texto da Pergunta:</b><br>
    <textarea name="pergunta" rows="3" cols="50" required><?php echo $dados_pergunta[2]; ?></textarea><br><br>

    <?php 
    
    if ($dados_pergunta[1] == "multipla") { 
    ?>
        <b>Opções de Resposta:</b><br>
        <input type="radio" name="correta" value="A" <?php if($dados_pergunta[7]=='A') echo 'checked'; ?> required> A) <input type="text" name="opA" value="<?php echo $dados_pergunta[3]; ?>" required><br>
        
        <input type="radio" name="correta" value="B" <?php if($dados_pergunta[7]=='B') echo 'checked'; ?>> B) <input type="text" name="opB" value="<?php echo $dados_pergunta[4]; ?>" required><br>
        
        <input type="radio" name="correta" value="C" <?php if($dados_pergunta[7]=='C') echo 'checked'; ?>> C) <input type="text" name="opC" value="<?php echo $dados_pergunta[5]; ?>" required><br>
        
        <input type="radio" name="correta" value="D" <?php if($dados_pergunta[7]=='D') echo 'checked'; ?>> D) <input type="text" name="opD" value="<?php echo $dados_pergunta[6]; ?>" required><br><br>
    
    <?php 
    
    } else if ($dados_pergunta[1] == "texto") { 
    ?>
        <b>Resposta Esperada:</b><br>
        <textarea name="resposta" rows="3" cols="50" required><?php echo $dados_pergunta[3]; ?></textarea><br><br>
    <?php } ?>

    <input type="submit" value="Salvar Alterações">
</form>

<br>
<a href="index.php">Voltar ao Menu Principal</a>
