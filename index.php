<!-- Enable debug using ?debug=true" -->
<?php
ob_start();
if (!session_id()){
session_start();
}
include("db_config.php");
ini_set('display_errors', 1);
?>

<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Autenticaci&oacute;n</title>

    <link href="./css/htmlstyles.css" rel="stylesheet">
	</head>

  <body>
  <div class="container-narrow">
		
		<div class="jumbotron">
			<p class="lead" style="color:white">
				Login Page
				<?php if (!empty($_REQUEST['msg'])){echo "<br />Por favor autenticarse para ingresar al m&oacute;dulo de b&uacute;squeda searchproducts.php";} ?>
			</p>
        </div>
		
		<div class="response">
		<form method="POST" autocomplete="off">
			<p style="color:#00828F">
				<label>Usuario:</label>
				<input type="text" placeholder="Ingrese su usuario" id="uid" name="uid" required><br /></br />
				<label>Contrase&ntilde;a:</label>
				<input type="password" placeholder="Ingrese su contrase&ntilde;a" id="password" name="password" maxlength="5" minlength="5" onkeypress='validate(event)' required>
			</p>
			<br />
			<p>
			<input type="submit" value="Submit"/> 
			<input type="reset" value="Reset"/>
			</p>
		</form>
        </div>
    
        
		<br />
		
      <div class="row marketing">
        <div class="col-lg-6">
<!---
No olvidar que la clave esta hasheado en md5.
--->
<?php
//echo md5("pa55w0rd");

if (!empty($_REQUEST['uid'])) {
$username = ($_REQUEST['uid']);
$pass = $_REQUEST['password'];

$q = "SELECT * FROM users where username='".$username."'" ;

if (isset($_GET['debug']))
{
	if ($_GET['debug']=="true")
{
	echo "<pre>".$q."</pre><br /><br />";
	}
}

		if (!mysqli_query($con,$q))
	{
		die('Error: ' . mysqli_error($con));
	}
	
	$result = mysqli_query($con,$q);

	// if (!$result) {
 //    		printf("%s\n", mysqli_error($con));
 //    		echo "error";
	// }

if (mysqli_warning_count($con)) { 
   $e = mysqli_get_warnings($con); 
   if ($e){
   do { 
       echo "Warning: $e->errno: $e->message\n"; 
   } while ($e->next()); }
} 

	echo "<br /><br />";
	$row = mysqli_fetch_array($result);

	
	if ($row){
	//header('Location: searchproducts.php');
	}
	else{
		echo "<font style=\"color:#FF0000\">Invalid user!</font\>";
		die();
	}
}

if (!empty($_REQUEST['uid'])) {
$username = ($_REQUEST['uid']);
$pass = $_REQUEST['password'];

$q = "SELECT * FROM users where username='".$username."' AND password = '".md5($pass)."'" ;

if (isset($_GET['debug']))
{
	if ($_GET['debug']=="true")
{
	echo "<pre>".$q."</pre><br /><br />";
	}
}

		if (!mysqli_query($con,$q))
	{
		die('Error: ' . mysqli_error($con));
	}
	
	$result = mysqli_query($con,$q);

	// if (!$result) {
 //    		printf("%s\n", mysqli_error($con));
 //    		echo "error";
	// }

if (mysqli_warning_count($con)) { 
   $e = mysqli_get_warnings($con); 
   if ($e){
   do { 
       echo "Warning: $e->errno: $e->message\n"; 
   } while ($e->next()); }
} 

	echo "<br /><br />";
	$row = mysqli_fetch_array($result);

	
	if ($row){
	//$_SESSION["id"] = $row[0];
	$_SESSION["username"] = $row[1];
	$_SESSION["descrip"] = $row[4];
	$_SESSION["name"] = $row[3];
	//ob_clean();
	
	header('Location: searchproducts.php');
	}
	else{
		echo "<font style=\"color:#FF0000\">Invalid password!</font\>";
	}
}

//}
?>
<script>
function validate(evt) {
  var theEvent = evt || window.event;

  // Handle paste
  if (theEvent.type === 'paste') {
      key = event.clipboardData.getData('text/plain');
  } else {
  // Handle key press
      var key = theEvent.keyCode || theEvent.which;
      key = String.fromCharCode(key);
  }
  var regex = /[0-9]|\./;
  if( !regex.test(key) ) {
    theEvent.returnValue = false;
    if(theEvent.preventDefault) theEvent.preventDefault();
  }
}
</script>
	</div>
	</div>
	  
	  <div class="footer">
		<p><h4><a href="index.php">Home</a><h4></p>
      </div>

	  <div class="footer">
		<p>Desarrollado by 4ng3l.</p>
      </div>
	</div> <!-- /container -->
  
</body>
</html>