<!DOCTYPE html>
<html>
    <head>
        <title>Login Page</title>
        <link rel="stylesheet" href="styles.css">
        <style>
            a {
                    text-decoration: none;  
                }
                header {
                    text-align: center;
                }
                h1 {
            font-family: 'Nosifer', cursive;
            font-size: 130%;
            color: #FFFF66;

        }
        body {
            background-image: url("images.jpg");
            font-family: 'Nosifer', cursive;
            font-family: 'Rosario', sans-serif;
            
        background-size: cover;
            
        }
        .login {
    margin:0 auto;
    max-width:500px;
    }
    .login-header {
    color:#fff;
    text-align:center;
    font-size:300%;
    }
    /* .login-header h1 {
    text-shadow: 0px 5px 15px #000; */
    }
    .login-form {
    border:.5px solid #fff;
    back.login-form input[type="email"],ground:#4facff;
    border-radius:10px;
    box-shadow:0px 0px 10px #000;
    }
    .login-form h3 {
    text-align:left;
    margin-left:40px;
    color:#fff;
    }
    .login-form {
    box-sizing:border-box;
    padding-top:15px;
        padding-bottom:10%;
    margin:5% auto;
    text-align:center;
    }
    .login-form input[type="text"],
    .login-form input[type="password"] {
    max-width:400px;
        width: 80%;
    line-height:3em;
    font-family: 'Ubuntu', sans-serif;
    margin:1em 2em;
    border-radius:5px;
    border:2px solid #f2f2f2;
    outline:none;
    padding-left:10px;
    }
    .login-form input[type="submit"] {
    height:30px;
    width:100px;
    background:#fff;
    border:1px solid #f2f2f2;
    border-radius:20px;
    color: slategrey;
    text-transform:uppercase;
    font-family: 'Ubuntu', sans-serif;
    cursor:pointer;
    }
            
        </style>
    </head>
    <body>
        <?php
            function process($data){
                $data=htmlspecialchars($data);
                $data=trim($data);
                $data=stripslashes($data);
                return $data;
            }
            $userErr=$passErr="";
            if(isset($_POST['submit'])){
                $username=$password="";
                $userErr=$passErr="";
                if($_SERVER["REQUEST_METHOD"]=="POST"){
                    if(empty($_POST["username"])) $userErr="username required"; else $username=process($_POST["username"]);
                    if(empty($_POST["password"])) $passErr="password required"; else $password=process($_POST["password"]);
                }
                
                $host="localhost";
                $user="root";
                $pass="";
                $db="property";
                $conn =new mysqli($host,$user,$pass,$db);
                if($conn->connect_error){
                    die("connection failed". $conn->connect_error);
                }
                $sql="SELECT * from `user` WHERE  `username`='$username' AND `password`= '$password' ;";
                $result=$conn->query($sql);
                if( $result->num_rows > 0 ){
                    $val=$result->fetch_assoc();
                    if($val['password']===$password){
                        print "
                            <script>
                                alert('sucessfully logged in');
                            </script>
                        ";
                        session_start();
                        $_SESSION['username']=$val['username'];
                        $_SESSION['email']=$val['email'];
                        $_SESSION['userid']=$val['userId'];
                        header('location: upload.php');
                        
                    }else{
                        $passErr="Inccorect Password!!";
                    }
                }else{
                    print "<script>
                        alert('user does not exist ');
                    </script>";
                    header('location: signuppage.php');
                }
            }
            
        ?>
        <header>
            <nav>
                <ul>
                   <a href="home.php">Home</a> &nbsp
                    <a href="loginpage.php">LogIn</a> &nbsp
                    <a href="signuppage.php">SignUp</a>
                </ul>
            </nav>
        </header>
        <div class="login">
        <div class="login-header">
            <h1>Login</h1>
            </div>
            <div class="login-form">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" id="loginForm" method="post">
            <label for="username"><h3>Username :</h3> </label>
            <input type="text" name="username" placeholder="username" id="username">
            <span class="errorMsg"> * <?php print $userErr ?></span>
            <br>
            <label for="password"><h3>Password :</h3> </label>
            <input type="password" name="password" placeholder="password" id="password" >
            <span class="errorMsg"> * <?php print $passErr ?></span>
            <br>
            <input type="submit" value="Submit" class="submit" name="submit">
        </form>
        </div>
        </div>
    </body>
</html>