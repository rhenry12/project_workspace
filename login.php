<? #Create a login page that verifies and accepts a valid username and password
    require_once('globals.php'); //contains global user id and password for the database
    
    $message = "";
    if(isset($_POST['username']) && isset($_POST['password'])) {
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
        $statement = sprintf("SELECT `id` FROM `users` WHERE `username` = '%s' AND `password` = '%s' AND `is_active`", $username, $password);
        $pdo_mysql = new PDO("mysql:dbname=".DATABASE.";host=".HOST, DB_USER, DB_PASS);
        $query = $pdo_mysql->prepare($statement);
        $query->execute();
        $verified = $query->fetchAll(PDO::FETCH_ASSOC);
        if($verified){
            //success
            $message = "<p class='success'>success</p>";
        }else{
            $message = "<p class='error'>Sorry, the username and password entered do not match our records!</p>";
        }
    }
?>
<html>
    <head>
        <title>Login page</title>
        <style type="text/css" media="screen">
            p.error {
                color: red;
            }
            p.success {
                color: green;
            }
        </style>
        <script type="text/javascript">
        </script>
    </head>
    <body>
        <!--create a form with 2 text input fields with labels and a submit button-->
        <?=$message?>
        <form action="#" method="post">
            <label for="username_input">Username</label>
            <input type="text" name="username" id="username_input" />
            <label for="password_input">Password</label>
            <input type="password" name="password" id="password_input" />
            <input type="submit" value="Log In" />
        </form>
    </body>
</html>