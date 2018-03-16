<!DOCTYPE html>
<html>
    <head>
        <title>upload</title>
        <style>
            body{
                font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
                background:url("upload.jpg");
                repeat:no-repeat;
                background-size:cover;
                color: maroon;
            }
            a {
                text-decoration: none;
            }
            header {
                text-align: center;
                font-size: 170%;
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
            $image=$add=$price=$city=$contact=$owner=$detail=" ";
            if($_SERVER["REQUEST_METHOD"]=="POST"){
                $add=process($_POST["address"]);
                $price=process($_POST["price"]);
                $city=process($_POST["city"]);
                $owner=process($_POST["owner"]);
                $contact=process($_POST["contact"]);
                
                if(isset($_POST["submit"])){
                    $baseDir="uploads/";
                    $baseFile=$baseDir.basename($_FILES['imgUp']['name']);
                    $imageType=strtolower(pathinfo($baseFile,PATHINFO_EXTENSION));
                    $updateok=1;
                    if(getimagesize($_FILES['imgUp']['tmp_name'])===false){
                        $updateok=0;
                    }elseif($imageType !=="jpg" && $imageType!=="png"){
                        print "<script> alert('unsupported file format') </scrpit>";
                        $updateok=0;
                    }
                    print "<script>alert($updateok)</script>";
                    if($updateok===1){
                        if(move_uploaded_file($_FILES['imgUp']['name'],$baseFile)){
                            $image=$baseFile;
                            print $basefile;
                        }else{
                            print "<script> alert('Error uploading the file') </script>";
                        }
                    }
                }

                $conn=new mysqli("localhost","root","","property");
                if($conn->connect_error){
                    die("Error connecting to the datbase".$conn->connect_error);
                }
                $sql = "INSERT INTO `sites`( `images`, `address`, `city`, `owner`, `contact`, `price`,`details`) VALUES ('$image','$add','$city','$owner','$contact','$price','$detail');";
                if($conn->query($sql)===true){
                    print "<script>
                            alert('sucessfully submitted');
                        </script>";
                }else{
                    print "<script>
                        alert('error while submitting');
                    </script>";
                }
            }
            
        ?>
        <header>
                    <nav>
                        <ul>
                            <a href="home.php">Home</a>&nbsp
                            <a href="loginpage.php">LogIn</a>&nbsp
                        <a href="signuppage.php">SignUp</a>
                        </ul>
                    </nav>
                </header>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" id="uploadForm" method="post" enctype="multipart/form-data">
                    <label for="imgUp">Image : </label>
                    <input type="file" name="imgUp" id="imgUp"><br>
                    <label for="address" class="area">Address : </label><br>
                    <textarea name="address" id="address" cols="30" rows="6"></textarea>
                    <br>
                    <label for="price">Cost : </label>
                    <input type="text" name="price" placeholder="cost" id="price" >
                    <br>
                    <label for="city">City : </label>
                    <input type="text" name="city" placeholder="city" id="city" >
                    <br>
                    <label for="owner">Owner of property : </label>
                    <input type="text" name="owner" placeholder="owner" id="owner" >
                    <br>
                    <label for="contact">Contact : </label>
                    <input type="tel" name="contact" placeholder="contact" id="contact" >
                    <br>
                    <label for="details" class="area">Property Details : </label><br>
                    <textarea name="details" id="details" cols="30" rows="5"></textarea>
                    <input type="submit" value="Submit" class="submit" name="submit">
                </form>
            </body>
        </html>
       