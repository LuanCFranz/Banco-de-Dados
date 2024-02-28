<?php
// Verifica se os dados foram enviados via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conexão com o banco de dados
    $conexao = mysqli_connect("localhost:3306", "root", "Lu@n1105", "tcc");

    // Verifica se houve erro na conexão
    if (!$conexao) {
        die("Falha na conexão com o banco de dados: " . mysqli_connect_error());
    }

    // Prepara os dados do formulário para inserção no banco de dados
    $nomeStartup = isset($_POST['nomeStartup']) ? mysqli_real_escape_string($conexao, $_POST['nomeStartup']) : '';
    $cnpjStartup = isset($_POST['cnpjStartup']) ? mysqli_real_escape_string($conexao, $_POST['cnpjStartup']) : '';
    $telefoneStartup = isset($_POST['telefoneStartup']) ? mysqli_real_escape_string($conexao, $_POST['telefoneStartup']) : '';
    $ramo = isset($_POST['ramo']) ? mysqli_real_escape_string($conexao, $_POST['ramo']) : '';
    $qtdFuncionario = isset($_POST['qtdFuncionarios']) ? mysqli_real_escape_string($conexao, $_POST['qtdFuncionarios']) : '';
    $desStartup = isset($_POST['descricaoEmpre']) ? mysqli_real_escape_string($conexao, $_POST['descricaoEmpre']) : '';
    $emailStartup = isset($_POST['emailStartup']) ? mysqli_real_escape_string($conexao, $_POST['emailStartup']) : '';
    $senhaStartup = isset($_POST['senhaStartup']) ? mysqli_real_escape_string($conexao, $_POST['senhaStartup']) : '';


    // Verifica se o CNPJ já está cadastrado
    $query_verificacao = "SELECT cnpjStartup FROM cadastro_startup WHERE cnpjStartup=' $cnpjStartup'";
    $resultado_verificacao = mysqli_query($conexao, $query_verificacao);

    if (!$resultado_verificacao) {
        die("Erro ao executar consulta: " . mysqli_error($conexao));
    }

    if (mysqli_num_rows($resultado_verificacao) > 0) {
        echo "CNPJ já cadastrado.";
    } else {
        // Insere os dados no banco de dados
        $query_insercao = "INSERT INTO cadastro_startup(nomeStartup, cnpjStartup, telefoneStartup,ramo,qtdFuncionarios,descricaoEmpre, emailStartup, senhaStartup) 
        VALUES (' $nomeStartup', ' $cnpjStartup', '$telefoneStartup', '$ramo', '$qtdFuncionario', '$desStartup',' $emailStartup','$senhaStartup')";
        $resultado_insercao = mysqli_query($conexao, $query_insercao);

        if ($resultado_insercao) {
            echo "Cadastro realizado com sucesso.";
        } else {
            echo "Erro ao cadastrar: " . mysqli_error($conexao);
        }
    }

    // Fecha a conexão com o banco de dados
    mysqli_close($conexao);
} else {
    echo "Formulário não submetido.";
}
?>