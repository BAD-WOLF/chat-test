<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/users/index.css"/>
    <title>Lista de Usuários</title>
</head>
<body>
    <h1>Lista de Usuários</h1>
    <h2>Qual é o seu??:</h2>
    <ul class="user-list">
        <?php
        require_once "../methods/connectdb.php";
        use Models\Connect\connectdb;

        $obj = new connectdb;
        foreach ($obj->getUsers() as $key => $value) {
            print "<li>$value</li>";
        }
        ?>
        <a href="<?='http://'.$_SERVER['HTTP_HOST'].'/chat'?>"><button class="redirectToChat">Chat</button></a>
    </ul>
</body>
</html>