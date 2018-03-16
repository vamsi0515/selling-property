    <!DOCTYPE html>
    <html>
        <head>
            <title>Signup Page</title>
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
            background-image: url("sign.jpg");
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
    background:#4facff;
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
    .login-form input[type="email"],
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
                if(isset($_POST['submit'])){
                    $username=$password=$confirm=$email="";
                    $userErr=$passErr=$confErr="";
                    if($_SERVER["REQUEST_METHOD"]=="POST"){
                        $username= process($_POST["username"]);
                        $password=process($_POST["password"]);
                        $confirm=process($_POST["repassword"]);
                        $email=process($_POST["email"]);
                    
                    }
                    

                    $host="localhost";
                    $user="root";
                    $pass="";
                    $db="property";
                    $conn = new mysqli($host,$user,$pass,$db);
                    if($conn->connect_error){
                        die("connection failed".$conn->connect_error);
                    }
                    $sql="INSERT INTO `user`(`username`, `password`, `email`) VALUES ('$username','$password','$email');";
                    if($conn->query($sql)===true){
                        print "<script>
                            alert('sucessfully logged in')
                        </script>";
                    }else{
                        print $conn->error;
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
            <h1>Sign Up</h1>
            </div>
            <div class="login-form">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" id="signupForm" method="post">
                <label for="username" ><h3>Username :</h3> </label>
                <input type="text" name="username" placeholder="username" id="username" onkeyup="userVal()">
                <span class="errorMsg" id="userErr" hidden>* username required</span>
                <br>   
                <label for="password"><h3>Password : </h3></label>
                <input type="password" name="password" placeholder="password" id="password" onkeyup="passVal()" >
                <span class="errorMsg" id="passErr" hidden> * password required</span>
                <br>
                <label for="repassword"><h3>Confirm password: </h3></label>
                <input type="password" name="repassword" placeholder="Confirm password" id="repassword" onkeyup="confVal()">
                <span class="errorMsg" id="confErr" hidden> * password must match</span>
                <br>
                <label for="email"><h3>Email :</h3> </label>
                <input type="email" name="email" placeholder="email" id="email" >
                
                <br>
                <input type="submit" name="submit" value="Submit" class="submit" id="loginSub" >
                
            </form>
            </div>
            </div>
        </body>
    </html>