<?php
// Conectar ao banco de dados
$host = 'localhost';
$dbname = 'db_projeto'; 
$username = 'root';
$password = 'root'; 

$conn = new mysqli($host, $username, $password, $dbname, 3307);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Selecionar uma pergunta aleatória
$sql = "SELECT * FROM tb_questoes ORDER BY RAND() LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    // Pega a pergunta e as respostas
    $pergunta = $row['ds_Pergunta'];
    $respostas = [
        $row['ds_questaoCerta'],
        $row['ds_questaoErrada1'],
        $row['ds_questaoErrada2'],
        $row['ds_questaoErrada3']
    ];

    // Embaralhar as respostas
    shuffle($respostas);
} else {
    echo "Nenhuma pergunta encontrada.";
    exit;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form action="processa_quiz.php" method="POST">
        <div class="question">
            <?php echo htmlspecialchars($pergunta); ?>
        </div>
        <div class="answers">
            <?php
            foreach ($respostas as $resposta) {
                echo "<button class='answer-btn' type='submit' name='answer' value='" . htmlspecialchars($resposta) . "'>" . htmlspecialchars($resposta) . "</button>";
            }
            ?>
        </div>
        <!-- Passa a resposta correta como um campo oculto -->
        <input type="hidden" name="resposta_certa" value="<?php echo htmlspecialchars($row['ds_questaoCerta']); ?>">
    </form>
</body>
</html>
