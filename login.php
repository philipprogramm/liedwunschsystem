<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
if (!empty($_POST["email"]) && !empty($_POST["psw"]) ) {
$email = trim($_POST["email"]);
$psw = trim($_POST["psw"]);

 
	$id =  md5($_POST["email"].$_POST["psw"]);
  	$file = file_get_contents('_SECRET/file.db');
    $file = json_decode($file, true);

	
	if (array_key_exists($id,$file)){  
	
        session_start();
        $_SESSION["logged_in"] = true;
        Header("Location: admin.php");
	
	}
	else { die('login does not exist');}
	
	
}  


  } 
?>
<head>
<title>Login | LWS</title>

</head>
<form  method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" style="border:1px solid #ccc">
  <div class="container">
    <h1>LOGIN</h1>
   <hr>

    <label for="email"><b>Nutzername</b></label>
    <input type="text" placeholder="Nutzernamen eingeben" name="email" required>
<hr>
    <label for="psw"><b>Passwort</b></label>
    <input type="password" placeholder="Passwort eingeben" name="psw" required>
    <div class="clearfix">
       <input type="submit" name="submit" value="Anmelden">
    </div>
  </div>
</form>