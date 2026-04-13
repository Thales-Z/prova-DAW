<h2>Sistema do Game Corporativo</h2>
<p>Bem-vindo!</p>

<a href="cadastrar_usuario.php">[+] Novo Gestor</a> | 
<a href="cadastrar_pergunta.php">[+] Nova Pergunta Múltipla Escolha</a>
<hr>

<h3>Gestores Cadastrados:</h3>
<ul>
<?php
// Verifica se o arquivo de usuários existe antes de tentar ler
if (file_exists('usuarios.txt')) {
    // A função file() lê o arquivo e coloca cada linha em uma posição de um Array
    $linhas_usuarios = file('usuarios.txt');
    
    foreach ($linhas_usuarios as $linha) {
        // O explode quebra a linha onde tem o '|'
        $dados = explode('|', trim($linha)); 
        // $dados[0] é o Nome, $dados[1] é o E-mail
        if (count($dados) >= 2) {
            echo "<li><b>{$dados[0]}</b> - {$dados[1]}</li>";
        }
    }
} else {
    echo "<li>Nenhum gestor cadastrado ainda.</li>";
}
?>
</ul>

<hr>

<h3>Perguntas Cadastradas:</h3>
<?php
// Verifica se o arquivo de perguntas existe
if (file_exists('perguntas.txt')) {
    $linhas_perguntas = file('perguntas.txt');
    
    // Vamos usar uma tabela simples de HTML para organizar os dados
    echo "<table border='1' cellpadding='5'>";
    echo "<tr><th>ID</th><th>Pergunta</th><th>Opções (A, B, C, D)</th><th>Resposta Correta</th><th>Ações</th></tr>";
    
    foreach ($linhas_perguntas as $linha) {
        $dados = explode('|', trim($linha));
        
        // Verifica se a linha tem as 8 partes (id, tipo, pergunta, opA, opB, opC, opD, correta)
        if (count($dados) == 8) {
            echo "<tr>";
            echo "<td>{$dados[0]}</td>"; // ID
            echo "<td>{$dados[2]}</td>"; // Texto da Pergunta
            
            // Junta as opções em uma única célula para não ficar gigante
            echo "<td>
                    A) {$dados[3]} <br>
                    B) {$dados[4]} <br>
                    C) {$dados[5]} <br>
                    D) {$dados[6]}
                  </td>";
                  
            echo "<td><b>{$dados[7]}</b></td>"; // Letra correta
            
            // Os links para as futuras páginas de Editar e Excluir
            // Passamos o ID pela URL usando ?id=numero
            echo "<td>
                    <a href='excluir_pergunta.php?id={$dados[0]}'>Excluir</a>
                  </td>";
            echo "</tr>";
        }
    }
    echo "</table>";
} else {
    echo "<p>Nenhuma pergunta cadastrada ainda.</p>";
}
?>
