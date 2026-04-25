<?php
// 1. Verifica se o ID foi passado lá na URL (ex: excluir_pergunta.php?id=123456)
if (isset($_GET['id']) && $_GET['id'] != "") {
    
    $id_para_excluir = $_GET['id'];
    $arquivo = 'perguntas.txt';

    // 2. Só tenta fazer algo se o arquivo existir
    if (file_exists($arquivo)) {
        
        // 3. Lê todas as linhas e guarda num array
        $linhas = file($arquivo);
        
        // Variável vazia para guardar o texto atualizado (sem a pergunta excluída)
        $novo_conteudo = "";

        // 4. Passa por cada linha do arquivo
        foreach ($linhas as $linha) {
            $dados = explode('|', $linha);

            // 5. Se o ID da linha for DIFERENTE do ID que clicamos para excluir...
            
            if (trim($dados[0]) != $id_para_excluir) {
                $novo_conteudo .= $linha;
            }
        }

        // 6. Sobrescreve o arquivo antigo apenas com as perguntas que sobraram
       
        file_put_contents($arquivo, $novo_conteudo);
    }
}

// 7. Depois de excluir (ou se o ID nem existir), joga o Gestor de volta pro Menu
header("Location: index.php");
exit();
?>
