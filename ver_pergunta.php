<?php
// Verifica se o ID foi passado na URL
if (isset($_GET['id']) && $_GET['id'] != "") {
    $id_procurado = $_GET['id'];
    $linhas = file('perguntas.txt');
    $encontrou = false;

    echo "<h2>Detalhes da Pergunta</h2>";

    // Passa linha por linha procurando o ID
    foreach ($linhas as $linha) {
        $dados = explode('|', trim($linha));
        
        if ($dados[0] == $id_procurado) {
            $encontrou = true;
            $tipo = $dados[1];
            
            echo "<b>ID:</b> " . $dados[0] . "<br><br>";
            echo "<b>Pergunta:</b> " . $dados[2] . "<br><br>";

            
            if ($tipo == "multipla") {
                echo "<b>Opção A:</b> " . $dados[3] . "<br>";
                echo "<b>Opção B:</b> " . $dados[4] . "<br>";
                echo "<b>Opção C:</b> " . $dados[5] . "<br>";
                echo "<b>Opção D:</b> " . $dados[6] . "<br><br>";
                echo "<b>Resposta Correta:</b> Letra " . $dados[7] . "<br>";
            } 
            /
            else if ($tipo == "texto") {
                echo "<b>Resposta Esperada:</b> " . $dados[3] . "<br>";
            }
            
            break;
        }
    }

    if ($encontrou == false) {
        echo "Pergunta não encontrada!";
    }
} else {
    echo "Nenhum ID informado.";
}
?>

<br><br>
<a href="index.php">Voltar</a>
