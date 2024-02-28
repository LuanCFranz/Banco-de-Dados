// Feito por Luan Carlos


<?php
// Verifica se os dados foram enviados via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // Conexão com o banco de dados
        $conexao = mysqli_connect("localhost:3306", "root", "Lu@n1105", "tcc");
    
    // pessoa física
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $senha = isset($_POST['senha']) ? $_POST['senha'] : '';

    // Verifica se houve erro na conexão
    if (!$conexao) {
        die("Falha na conexão com o banco de dados: " . mysqli_connect_error());
    }
    
    $query_user = "SELECT * FROM pessoa_fisica WHERE email='$email' AND senha='$senha'";
    $result_user = mysqli_query($conexao, $query_user);
    
    if (!$result_user) {
        // Se houver um erro na consulta, exiba uma mensagem de erro
        echo "Erro na consulta: " . mysqli_error($conexao);
    } else {
        // Continue com o processamento dos resultados
    }

    $query_juri = "SELECT * FROM pessoa_juridica WHERE emailPJ='$email' AND senhaPJ='$senha'";
    $result_juri = mysqli_query($conexao, $query_juri);
    
    if (!$result_juri) {
        // Se houver um erro na consulta, exiba uma mensagem de erro
        echo "Erro na consulta: " . mysqli_error($conexao);
    } else {
        // Continue com o processamento dos resultados
    }

    $query_Startup = "SELECT * FROM pessoa_juridica WHERE emailPJ='$email' AND senhaPJ='$senha'";
    $result_Startup = mysqli_query($conexao, $query_Startup);
    
    if (!$result_Startup) {
        // Se houver um erro na consulta, exiba uma mensagem de erro
        echo "Erro na consulta: " . mysqli_error($conexao);
    } else {
        // Continue com o processamento dos resultados
    }

    // Verifica se pelo menos uma das consultas retornou um resultado válido
    if (mysqli_num_rows($result_user) > 0 || mysqli_num_rows($result_juri) > 0 || mysqli_num_rows($result_Startup) > 0) {
        echo "<script>window.location.href='http://localhost/Inova%20Start/Inova%20Start/PaginaInicial/pagina_inicial.html';</script>";
    } else {
        echo "Nome de usuário ou senha incorretos.";
    }

    // Fecha a conexão com o banco de dados
    mysqli_close($conexao);
} else {
    // Se o formulário não foi submetido via POST
    echo "Formulário não submetido.";
}
?>
