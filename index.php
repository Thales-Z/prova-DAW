<h2>Sistema do Game Corporativo</h2>
<p>Bem-vindo, Sr. Water Falls.</p>

<a href="cadastrar_usuario.php">[+] Novo Gestor</a> | 
<a href="cadastrar_pergunta.php">[+] Nova Pergunta Múltipla Escolha</a> |
<a href="cadastrar_pergunta_texto.php">[+] Nova Pergunta de Texto</a>
<hr>

<h3>Gestores Cadastrados:</h3>
<ul>
<?php
if (file_exists('usuarios.txt')) {
    $linhas_usuarios = file('usuarios.txt');
    foreach ($linhas_usuarios as $linha) {
        $dados = explode('|', trim($linha)); 
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
if (file_exists('perguntas.txt')) {
    $linhas_perguntas = file('perguntas.txt');
    
    echo "<table border='1' cellpadding='5'>";
    echo "<tr><th>ID</th><th>Tipo</th><th>Pergunta</th><th>Opções / Resposta Esperada</th><th>Correta</th><th>Ações</th></tr>";
    
    foreach ($linhas_perguntas as $linha) {
        $dados = explode('|', trim($linha));
        
        if (count($dados) >= 4) { // Verifica se a linha tem o mínimo de dados
            echo "<tr>";
            echo "<td>{$dados[0]}</td>"; 
            echo "<td>" . strtoupper($dados[1]) . "</td>"; 
            echo "<td>{$dados[2]}</td>"; 
            
            if ($dados[1] == "multipla") {
                echo "<td>
                        A) {$dados[3]} <br>
                        B) {$dados[4]} <br>
                        C) {$dados[5]} <br>
                        D) {$dados[6]}
                      </td>";
                echo "<td><b>{$dados[7]}</b></td>";
            } else if ($dados[1] == "texto") {
                echo "<td><i>{$dados[3]}</i></td>"; 
                echo "<td>-</td>"; 
            }
            
            
            echo "<td>
                    <a href='ver_pergunta.php?id={$dados[0]}'>Ver</a> | 
                    <a href='alterar_pergunta.php?id={$dados[0]}'>Alterar</a> | 
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
