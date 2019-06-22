<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
if (!empty($_POST["email"]) && !empty($_POST["psw"])  && !empty($_POST["psw-repeat"])) {
$email = trim($_POST["email"]);
 if ($_POST["psw"] == $_POST["psw-repeat"]){ 
 
    $pw =  md5($_POST["psw"]);
	$id =  md5($_POST["email"].$_POST["psw"]);
  	$file = file_get_contents('file.db');
    $file = json_decode($file, true);
if (empty($file)){
	$new = array(
   $id => array(
        'email' => "$email",
        'password' => "$pw"
    )
);
$userdb = $new;
$db =json_encode($userdb,JSON_FORCE_OBJECT);
	}
else if (is_array($file)){
	
	$new =  array('email' => "$email",'password' => "$pw");
	
	$file["$id"] = $new;
	$db =json_encode($file,JSON_FORCE_OBJECT);
	}
	
	   $filename = 'file.db';  
    $fp = fopen($filename, 'w'); 
     fwrite($fp, $db); 
     fclose($fp); 
    echo 'Registriert!';

}
else {die('Passwords Not the same');}  
  

}
else {die('Fields are empty');}  


  } 
?>

<form  method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" style="border:1px solid #ccc">
  <div class="container">
    <h1>Neuen Account erstellen</h1>
    <p>Zum Bearbeiten der Liedwünsche</p>
    <hr>

    <label for="email"><b>Benutzername</b></label>
    <input type="text" placeholder="Benutzername wählen" name="email" required>
<hr>
    <label for="psw"><b>Passwort</b></label>
    <input type="password" placeholder="Enter Password" name="psw" required>
<hr>
    <label for="psw-repeat"><b>Passwort wiederholen</b></label>
    <input type="password" placeholder="Repeat Password" name="psw-repeat" required>
<hr>
    <div class="clearfix">
       <input type="submit" name="submit" value="Submit">
    </div>
  </div>
</form>