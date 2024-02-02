<?php

@include 'config.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';
function generate_password($len = 8){
	$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
	$parentpass = substr( str_shuffle( $chars ), 0, $len );
	return $parentpass;
}
if(isset($_POST['submit'])){

   $name = $_POST['name'];
   $age = $_POST['age'];
   $College_name = mysqli_real_escape_string($conn, $_POST['College_name']);
   $Gender = mysqli_real_escape_string($conn, $_POST['Gender']);
   $Phone_No = mysqli_real_escape_string($conn, $_POST['Phone_No']);
   $email = $_POST['email'];
   $accountNo = $_POST['accountNo'];
   $adhar = mysqli_real_escape_string($conn, $_POST['adhar']);
   $password = $_POST['password'];
   $re_pass = mysqli_real_escape_string($conn, $_POST['re_pass']);
   $balance=10;
   $parentpass=generate_password();
   $parentmail= $_POST['parentmail'];
   

   $select = " SELECT * FROM sign_up WHERE email = '$email' && password = '$password' ";

   $result = mysqli_query($conn, $select);


   if(mysqli_num_rows($result) > 0){

      $error[] = 'user already exist!';

   }else{

      if($password != $re_pass){
         $error[] = 'password not matched!';
      }else{
         $insert = "INSERT INTO sign_up(name,age,College_name,Gender,Phone_No,email, password,parentmail,parentpass ) VALUES('$name','$age','$College_name','$Gender','$Phone_No','$email','$password','$parentmail','$parentpass')";
         $insert1 = "INSERT INTO useraccounts(email,password,name,balance,accountNo,number,branch) VALUES('$email','$password','$name','$balance','$accountNo','$adhar','$College_name')";
         $insert2 = "INSERT INTO login(email,password,accountNo,name ) VALUES('$parentmail','$parentpass','$accountNo','$name')";
         mysqli_query($conn, $insert);
         mysqli_query($conn1, $insert1);
         mysqli_query($conn1, $insert2);
         $mail = new PHPMailer();
    $mail->IsSMTP();

    $mail->SMTPDebug = 0;
    $mail->SMTPAuth = TRUE;
    $mail->SMTPSecure = "tls";
    $mail->Port = 587;
    $mail->Host = "smtp.gmail.com";
    $mail->Username = "studentwalletvi@gmail.com";
    $mail->Password = "qyewekmaydbziqhr";
    $mail->IsHTML(true);
    $mail->AddAddress("$parentmail", "$name");
    $mail->SetFrom("studentwalletvi@gmail.com", "Student Wallet");
    $mail->Subject = "Student Wallet Registeration";
    $content = "<b>Dear $name Sir/Madam,<br>
    Thanks for Registeration of Student Wallet............<br>
    Login Credentials:  ----<br><br><hr>
    Don't Share this Mail or Forward for Security Reason<br>
    Your Account No: $accountNo <br>
    Student pass :$password <br>
    Parent Email :$parentmail<br>
    Parent Pass :$parentpass<br>   
    <b>Student Wallet Team.</b>";

    $mail->MsgHTML($content);
    if (!$mail->Send()) {
        echo "Error while sending Email.";
        var_dump($mail);
    } else {
        echo "Email sent successfully";
    }
        

    
         header('location:login.php');
      }
   }

};


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>login page</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="css/style.css">
    <script
      type="text/javascript"
      src="https://cdn.jsdelivr.net/npm/@emailjs/browser@3/dist/email.min.js"
    ></script>
    <script src="index.js"></script>

<script
  type="text/javascript"
  src="https://cdn.jsdelivr.net/npm/@emailjs/browser@3/dist/email.min.js"
></script>
<script type="text/javascript">
  (function () {
    emailjs.init("J01QMSmqj93QY8gmJ");
  })();
</script>

    
</head>
<body>

    <div class="main">

        <!-- Sign up form -->
       
        <section class="signup">
            <div class="container">
                <div class="signup-content">
                    <div class="signup-form">
                    <h2 >Student-Wallet</h2>
                        <h2 class="form-title">Sign up</h2>
                        <form action="" method="POST" class="register-form" id="register-form" >
                            <div class="form-group">
                                <i class="zmdi zmdi-account material-icons-name"></i>
                                <input type="text" name="name" id="name" placeholder="Your Name" required/>
                            </div>
                            <div class="form-group">
                                <i class="zmdi zmdi-time"></i>
                                <input type="int" name="age" id="age" placeholder="Your Age" required/>
                            </div>
                            <div class="form-group">
                                <i class="zmdi zmdi-book"></i>
                                <input type="College_name" name="College_name" id="College_name" placeholder="Your College" required/>
                            </div>
                            <div class="form-group">
                                <i class="zmdi zmdi-male-female"></i>
                                <input type="Gender" name="Gender" id="Gender" placeholder="Your Gender" required/>
                            </div>
                            <div class="form-group">
                                <i class="zmdi zmdi-account-box"></i>
                                <input type="text" name="Phone_No" id="Phone_No" placeholder="Your Phone_No" required/>
                            </div>
                            <div class="form-group">
                                <i class="zmdi zmdi-email"></i>
                                <input type="email" name="email" id="email" placeholder="Your Email" required/>
                            </div>
                            <div class="form-group">
                                <i class="zmdi zmdi-email"></i>
                                <input type="text" name="accountNo" id="accountNo" placeholder="Your PRN" required/>
                            </div>
                            <div class="form-group">
                                <i class="zmdi zmdi-email"></i>
                                <input type="text" name="adhar" id="adhar" placeholder="Your adhar number" required/>
                            </div>
                            <div class="form-group">
                                <i class="zmdi zmdi-email"></i>
                                <input type="email" name="parentmail" id="parentemail" placeholder="Parent Email" required/>
                            </div>
                            <div class="form-group">
                                <i class="zmdi zmdi-lock"></i>
                                <input type="password" name="password" id="pass" placeholder="Password" required/>
                            </div>
                            <div class="form-group">
                                <i class="zmdi zmdi-lock-outline"></i>
                                <input type="password" name="re_pass" id="re_pass" placeholder="Repeat your password" required/>
                            </div>
                           
                            
                            <!-- <div class="form-group">
                                <input type="checkbox" name="agree-term" id="agree-term" class="agree-term" />
                                <label for="agree-term" class="label-agree-term"><span><span></span></span>I agree all statements in  <a href="#" class="term-service">Terms of service</a></label>
                            </div> -->
                            <div class="form-group form-button">
                                <!-- <input type="submit" name="submit" id="signup" class="form-submit"  value="Register" onsubmit="sendMail()" /> -->
                                <button class="btn btn-primary" name="submit" id="signup"  onclick="sendMail() ">Submit</button>
                            </div>
                        </form>
                    </div>
                    <div class="signup-image">
                        <figure><img src="Picture1.png" alt="sing up image"></figure>
                        <a href="login.php" class="signup-image-link">I am already member</a>
                    </div>
                </div>
            </div>
        </section>

    </div>

    <!-- JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>