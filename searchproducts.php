<!-- Enable debug using ?debug=true" -->

<?php
ob_start();
session_start();
include("db_config.php");
if (!$_SESSION["username"]){
header('Location:Login1.php?msg=1');
}
ini_set('display_errors', 1);
?>

<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>B&uacute;squeda de productos</title>

    <link href="./css/htmlstyles.css" rel="stylesheet">
	</head>

  <body>
  <div class="container-narrow">
		
		<div class="jumbotron">
			<p class="lead" style="color:white">
				Bienvenido <?php echo $_SESSION["name"]; ?>!<br/>
			</p>
        </div>

		<div class="response">
		
			<form method="POST" autocomplete="off">
			
			<p style="color:#00828F">
				B&uacute;squeda de un producto:  
				<br/>
				<input type="text" id="searchitem" name="searchitem" value="<?php if(isset($_POST["searchitem"])) { echo $_POST["searchitem"]; }?>">&nbsp;&nbsp;
				<br/>
					<input type="submit" value="Buscar!"/> 
				<br/>
			</p>

			</form>
        </div>
		<br />

<?php
if (isset($_POST["searchitem"])) {

$q = "Select * from products where product_name like '%".$_POST["searchitem"]."%'";

if (isset($_GET['debug']))
{
	if ($_GET['debug']=="true")
{
	echo "<pre>".$q."</pre><br /><br />";
	}
}

$result = mysqli_query($con,$q);
$row_cnt = mysqli_num_rows($result);
echo "Se han encontrado " . $row_cnt . " coincidencias para su búsqueda usando el término " . $_POST["searchitem"] . "<br/>" ;
?>
<table class="styled-table">
 	<thead>
		<tr>
		    <td style="width:200px " >
		        <b>Nombre de producto</b>
		    </td>
		    
		    <td style="width:200px " >
		        <b>Tipo de producto</b>
		    </td>
		    
		    <td style="width:450px " >
		        <b>Descripcion</b>
		    </td>
		    
		    <td style="width:110px " >
		        <b>Precio (en USD)</b>
		    </td>
	    </tr>
  	</thead>
  	<tbody>
<?php
	if (!$result)
	{
		die("</tbody></table></div>".mysqli_error($con));
	}
	while($row = mysqli_fetch_array($result))
	  {
	  echo "<tr><td style=\"width:200px\">".$row[1]."</td><td style=\"width:200px\">".$row[2]."</td><td style=\"width:450px\">".$row[3]."</td><td style=\"width:110px\">".$row[4]."</td></tr>";
	  }

	}
?>
	<tbody>
</table> 
  	<div class="footer">
		<p><h4><a href="index.php">Home</a><h4></p>|<p><h4><a href="logout.php">Cerrar sesión</a><h4></p>
	</div>
	  
	  
	  <div class="footer">
		<p>Desarrollado by 4ng3l.</p>
      </div>

	</div> <!-- /container -->
  
</body>
</html>