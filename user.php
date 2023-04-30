
<?php

    $conn = new mysqli('localhost','root','','user_login');
    if(!$conn) echo "Not connected";

    $empMsg_firstName =$empMsg_lastName= $empMsg_email =  $empMsg_pass = $empMsg_pass_again = '';
    $user_first_name = $user_last_name = $user_email = $user_password = $user_password_again = '';

    if(isset($_POST['submit'])){
         $user_first_name = $_POST['user_first_name'];
         $user_last_name = $_POST['user_last_name'];
         $user_email = $_POST['user_email'];
         $user_password = $_POST['user_password'];
         $user_password_again = $_POST['user_password_again'];

        //  $md5_pass = md5($user_password);
        

         if(empty($user_first_name)){
            $empMsg_firstName = 'Fill up this field.';
         }
         if(empty($user_last_name)){
            $empMsg_lastName = 'Fill up this field.';
         }
         if(empty($user_email)){
            $empMsg_email = 'Fill up this field.';
         }
         if(empty($user_password)){
            $empMsg_pass = 'Fill up this field.';
         }
         if(empty($user_password_again)){
            $empMsg_pass_again = 'Fill up this field.';
         }
    }

    if(!empty($user_first_name) && !empty($user_last_name) && !empty($user_email) && !empty($user_password) && !empty($user_password_again)){
        if($user_password === $user_password_again){
            
            $sql = "INSERT INTO users(user_first_name,user_last_name,user_email,user_password) VALUES('$user_first_name','$user_last_name','$user_email','$user_password')";

            if($conn->query($sql)==TRUE){
                header('location:login.php?usercreated');
            }

        }else{
            echo 'password did not mach';
        }
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>user details</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6">
                <form action="user.php" method="POST">
                    <div class="mt-5">
                        <label for="exampleInputEmail1" class="form-label">First Name</label>
                        <input type="text" class="form-control" name="user_first_name" value="<?php echo  $user_first_name ?>">
                        <?php if(isset($_POST['submit'])){echo "<small class='text-danger'>" .$empMsg_firstName."</small>" ;}  ?>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Last Name</label>
                        <input type="text" class="form-control" name="user_last_name" value="<?php echo  $user_last_name ?>">
                        <?php if(isset($_POST['submit'])){echo "<small class='text-danger'>" .$empMsg_lastName."</small>" ;}  ?>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input type="email" class="form-control" name="user_email" value="<?php echo  $user_email ?>">
                        <?php if(isset($_POST['submit'])){echo "<small class='text-danger'>" .$empMsg_email."</small>" ;}  ?>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" class="form-control" name="user_password" value="<?php echo  $user_password ?>">
                        <?php if(isset($_POST['submit'])){echo "<small class='text-danger'>" .$empMsg_pass."</small>" ;}  ?>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password Again</label>
                        <input type="password" class="form-control" name="user_password_again" value="<?php echo  $user_password_again ?>">
                        <?php if(isset($_POST['submit'])){echo "<small class='text-danger'>" .$empMsg_pass_again."</small>" ;}  ?>
                    </div>

                    <button type="submit" name="submit" class="mb-3 btn btn-primary">Submit</button>
                </form>
                <h5>Have an account? <a href="login.php">Log in</a></h5>
            </div>
            <div class="col-3"></div>
        </div>
    </div>

</body>

</html>