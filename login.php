<?php
    session_start();
    $conn = new mysqli('localhost','root','','user_login');
    if(!$conn) echo "Not connected";

    $empMsg_email =  $empMsg_pass = '';
    $user_email = $user_password = '';

    if(isset($_POST['submit'])){
        $user_email = $_POST['user_email'];
        $user_password = $_POST['user_password'];

        if(empty( $user_email)){
            $empMsg_email = 'Fill up this field';
        }
        if(empty($user_password)){
            $empMsg_pass = 'Fill up this field.';
        }

        if(!empty($user_email)&& !empty($user_password)){
            $sql = "SELECT * FROM users WHERE user_email= '$user_email' AND user_password = '$user_password'";

            $query = $conn->query($sql);

            if($query-> num_rows > 0){
                $_SESSION['login'] = 'login success';
                header('location:dashboard.php');
            }else{
                echo 'not found';
            }

        }

    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>user login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-4"></div>
            <div class="col-4 mt-5">
                <?php
                    if(isset($_GET['usercreated'])){
                        echo 'User Created Succesfully!!';
                    }
                ?>
                <form action="login.php" method="post">
                    <div class="mt-5">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input type="email" name="user_email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo  $user_email ?>" >     
                        <?php if(isset($_POST['submit'])){echo "<small class='text-danger'>" .$empMsg_email."</small>" ;}  ?>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" name="user_password" class="form-control" id="exampleInputPassword1" value="<?php echo  $user_password ?>">
                        <?php if(isset($_POST['submit'])){echo "<small class='text-danger'>" .$empMsg_pass."</small>" ;}  ?>
                    </div>
                    
                    <button type="submit" name="submit" class="mb-3 btn btn-primary">Log in</button>
                </form>
                <h5>Not have account? <a href="user.php">Register</a></h5>
            </div>
            <div class="col-4"></div>
        </div>
    </div>

</body>

</html>