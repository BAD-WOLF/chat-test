<!DOCTYPE html>
<html>

<head>
    <title>Tela de Login</title>
    <meta property="og:image" content="https://<?= $_SERVER['HTTP_HOST'] ?>/imgs/evil-cat.jpg" />
    <link rel="stylesheet" href="../css/login/index.css" />
</head>

<body>
    <div class="login-container">
        <h1>Login</h1>
        <form method="post">
            <label for="username">Nome:</label>
            <input type="text" id="username" name="username" placeholder="Digite seu nome ..." required />
            <label for="password">Password:</label>
            <input type="text" id="username" name="password" placeholder="Digite sua senha ..." required />
            <a href="../chat/index.php"><button type="submit">Entrar</button></a>
        </form>
    </div>
    <?php
    require_once "../vendor/autoload.php";
    require_once "../methods/connectdb.php";
    require_once "../methods/chat_messages.php";

    use Models\Connect\connectdb;
    use Models\Connect\chat_messages;

    if (!empty($_POST["username"]) && !empty($_POST["password"])) {

        $conn = new connectdb;
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $username = $_POST["username"];
        $password = $_POST["password"];
        
        $table_login_chat_content = $conn->select_all_in_table("login_chat");
        print_r($table_login_chat_content);
        if (empty($table_login_chat_content)) {
            $conn->save_in_login_chat($username, $password);
            $_SESSION["username"] = $username;
            $table_login_chat_content = $conn->select_all_in_table("login_chat");
        }

        foreach ($table_login_chat_content as $key => $value) {
            if ($username == $value["username"]) {
                $name_inside = true;
            }
        }

        //nao pode ta o nome pq significa q ta querendo salvar de novo o nome
        if (empty($name_inside)) {
            $conn->save_in_login_chat($username, $password);
            $_SESSION["username"] = $username;
        }

        if ($conn->userLogin($username)) {
            print "<h1>$password</h1>";
            if ($pass = $conn->credentialsVaidation($username)) {
                print_r($pass);
                print $password;
                if ($pass[0]["passwd"] === $password) {
                    chat_messages::$server_side_password_to_user = $username . "321";
                } else {
                    print "<h1>" . $pass[0]["passwd"] . "</h1>";
                    print "deu aq ..";
                }
            }
        }
        header("Location: ../chat/index.php");
        print "<pre>";
        print_r($_SESSION["username"]);

        /*
        print "<pre>";
        print_r($conn->select_all_in_table("login_chat"));
        print "</pre>";
        */
    }
    ?>
</body>

</html>