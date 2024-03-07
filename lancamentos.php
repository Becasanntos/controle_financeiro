<?php
include 'conexao.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
<meta charset="UTF-8">
<title>Cadastro de Despesas</title>
</head>
<body>
    <a href="index.php"><button>voltar</button></a>
    <h2>lançamentos</h2>

    <h2>Cadastro de Despesas</h2>
    <form action="lancamentos.php" method="post">
       Descrição: <input type="text" name="descrição" required><br>
       Valor: <input type="number" step="0.01" name="valor" required><br>
       Data: <input type="date" name="data" required><br>
       Fixa: <select name="fixa">
            <option value="nao">Nao</option>
            <option value= "sim">Sim</option>
     </select><br>
     tipo:<select name="tipo">
        <option value="entrada">Entrada</option>
        <option value="saida">Saida</option>
</select><br>
    <input type="submit" name="submit" value="Cadastrar Despesas">
</form>
</body>
</html>

<?php
if (isset($_POST['submit'])) {
    $descrição = $_POST['descrição'];
    $valor = $_POST['valor'];
    $data = $_POST['data'];
    $fixa = $_POST['fixa'];
    $tipo = $_POST['tipo'];
    try {
        $sql = "INSERT INTO lançamentos (descrição, valor, tipo, data, fixa) VALUES (?,?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt-> execute ([$descrição, $valor, $tipo, $data, $fixa]);
        echo "Lançamentos Cadastrada com sucesso!";
    } catch (PDOException $e) {
        echo "Erro ao Cadastrar Lançamentos:" . $e->getMessage();
    }

}
?>

<h2>Despesas Cadastradas</h2>
<table border="1">
    <tr>
        <th>Descrição</th>
        <th>Valor</th>
        <th>Tipo</th>
        <th>Data</th>
        <th>Fixa</th>
</tr>
<?php
$sql = "SELECT descrição, valor, tipo, data, fixa FROM lançamentos WHERE tipo = 'saida'";
  foreach($conn->query($sql) as $row) {
    echo "<tr>
    <td>{$row['descrição']}</td>
    <td>R$ {$row['valor']}</td>
    <td>{$row['tipo']}</td> 
    <td>{$row['data']}</td>
    <td>{$row['fixa']}</td>
   </tr>";

}
?>
</table>

