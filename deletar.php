<?php
include 'db.php';

if (!isset($_GET['id'])) {
    header('Location: listar2.php');
    exit;
}

$id = $_GET['id'];
$stmt = $pdo->prepare('SELECT *FROM cliente WHERE id = ?');
$stmt->execute([$id]);
$appointment = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$appointment) {
    header('Location: listar2.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $stmt = $pdo->prepare('DELETE FROM clientes WHERE id = ?');
    $stmt->execute([$id]);

    header('Location: listar2.php');
    exit;
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Cancelar Compra</title>
</head>
<body>
    <h1>Cancelar Compra</h1>
    <p>Tem certeza que deseja cancelar sua a compra de
    <?php echo $appointment['nome']; ?>?</p>
    <form method="post">
        <button type="submit">Sim</button>
        <a href="listar2.php">Não</a>
</form>        
</body>
</html>