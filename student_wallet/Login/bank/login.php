<!DOCTYPE html>
<html>
<head>
	<title>Banking</title>
	<?php require 'assets/autoloader.php'; ?>
	<?php require 'assets/function.php'; ?>
	<?php
    $con = new mysqli('localhost','root','','mybank');
		
		if (isset($_POST['managerLogin']))
		{
			$error = "";
  			$user = $_POST['email'];
		    $pass = $_POST['password'];
		   
		    $result = $con->query("select * from login where email='$user' AND password='$pass' AND type='manager'");
		    if($result->num_rows>0)
		    { 
		      session_start();
		      $data = $result->fetch_assoc();
		      $_SESSION['managerId']=$data['id'];
		      //$_SESSION['user'] = $data;
		      header('location:mindex.php');
		     }
		    else
		    {
		      $error = "<div class='alert alert-warning text-center rounded-0'>Username or password wrong try again!</div>";
		    }
		}

	 ?>
</head>
<body style="background: url(images/bg-login2.jpg);background-size: 100%">
<h1 class="alert alert-success rounded-0"><?php echo 'VIIT Student Bank'; ?><small class="float-right text-muted" style="font-size: 12pt;"><kbd></kbd></small></h1>
<br>
<?php echo $error ?>
<br>
<div id="accordion" role="tablist" class="w-25 float-right shadowBlack" style="margin-right: 222px">
	<br><h4 class="text-center text-white">Select Your Session</h4>
  
  <div class="card rounded-0">
    <div class="card-header" role="tab" id="headingTwo">
      <h5 class="mb-0">
        <a class="collapsed btn btn-outline-success btn-block" data-toggle="collapse" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          Manager Login
        </a>
      </h5>
    </div>
    <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo" data-parent="#accordion">
      <div class="card-body">
         <form method="POST">
       	<input type="email" value="manager@manager.com" name="email" class="form-control" required placeholder="Enter Email">
       	<input type="password" name="password" value="manager" class="form-control" required placeholder="Enter Password">
       	<button type="submit" class="btn btn-primary btn-block btn-sm my-1" name="managerLogin">Enter </button>
       </form>
      </div>
    </div>
  </div>
  
</div>
</body>
</html>