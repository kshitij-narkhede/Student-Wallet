<?php

@include 'config.php';

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $College_name = mysqli_real_escape_string($conn, $_POST['College_name']);
   $Gender = mysqli_real_escape_string($conn, $_POST['Gender']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = md5($_POST['password']);
   $cpass = md5($_POST['cpassword']);
   // $user_type = $_POST['user_type'];

   $select = " SELECT * FROM demo WHERE email = '$email' && password = '$pass' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $error[] = 'user already exist!';

   }else{

      if($pass != $cpass){
         $error[] = 'password not matched!';
      }else{
         $insert = "INSERT INTO demo(name,College_name,Gender, email, password) VALUES('$name','$College_name','$Gender','$email','$pass')";
         mysqli_query($conn, $insert);
         header('location:login_form.php');
      }
   }

};


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register form</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<div class="form-container">

   <form action="" method="post">
      <h3>register now</h3>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
      <div class="form-group">
                                <i class="zmdi zmdi-account material-icons-name"></i>
                                <input type="text" name="name" id="name" placeholder="Your Name"/>
                            </div>
                            <div class="form-group">
                                <i class="zmdi zmdi-time"></i>
                                <input type="int" name="age" id="age" placeholder="Your Age"/>
                            </div>
                            <div class="form-group">
                                <i class="zmdi zmdi-book"></i>
                                <input type="College_name" name="College_name" id="College_name" placeholder="Your College"/>
                            </div>
                            <div class="form-group">
                                <i class="zmdi zmdi-male-female"></i>
                                <input type="Gender" name="Gender" id="Gender" placeholder="Your Gender"/>
                            </div>
                            <div class="form-group">
                                <i class="zmdi zmdi-account-box"></i>
                                <input type="Phone_No" name="Phone_No" id="Phone_No" placeholder="Your Phone_No"/>
                            </div>
                            <div class="form-group">
                                <i class="zmdi zmdi-email"></i>
                                <input type="email" name="email" id="email" placeholder="Your Email"/>
                            </div>
                            <div class="form-group">
                                <i class="zmdi zmdi-lock"></i>
                                <input type="password" name="password" id="pass" placeholder="Password"/>
                            </div>
                            <div class="form-group">
                                <i class="zmdi zmdi-lock-outline"></i>
                                <input type="password" name="cpassword" id="re_pass" placeholder="Repeat your password"/>
                            </div>
                           
                            
                            
                            <div class="form-group form-button">
                                <input type="submit" name="submit" id="submit" class="form-submit" value="Register"/>
                            </div>
                        </form>
   

</div>

</body>
</html>