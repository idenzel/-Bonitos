<!DOCTYPE html>
<html>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="styles/index.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="icon" href="img/favicon.ico" type="image/ico">
<body>
<script>
$(document).ready(function(){
		
		$('#loading_image').hide();
		$('#enviar').hide();
		$('#aplicativo').hide();
		$('#application').hide();
	});
	
</script>

<div id="header">
<img src="img/logo-dric.png">
<h2 style=" top:0;left:80%; position:absolute;">FTP Uploader</h2>
<h4 style="position: absolute; top:50px; left:80%;">Support Team</h4>

</div>
<div id="cajaupload" >

    <p><i class="glyphicon glyphicon-upload" id="uploadicon"></i></p>
	<form enctype="multipart/form-data" action="index.php" method="post">
    <input type="file" name="fileToUpload" id="fileuploader" onchange="algo()">
	<p style="position: absolute; top:130px; left:-20px;font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif;" id="application">Application:</p>
	<select class="form-control" name="aplicativo" id="aplicativo" style="position: absolute; top:150px; left:-30px;width:180px">
	
	<option value="ServiceDeskPlus">Servicedesk Plus</option>
	<option value="OPManager">OPManager</option>
	<option value="APPManager">APPManager</option>
	<option value="ADaudit">ADaudit</option>
	<option value="ADManager">ADManager</option>
	<option value="ADSelfService">ADSelfService</option>
	<option value="EventlogAnalyzer">Eventlog Analyzer</option>
	<option value="Footprints">Footprints</option>
	<option value="Otro">Otro</option>
	</select>
	
    <input type="submit" value="Upload" name="Enviar" id="enviar" class="btn btn-info" style="position: absolute; top:200px; left:20px" onclick="upload">
	</form>
<img src='img/loading.gif' style='position:relative;left:20px;top:250px;' id="loading_image">
</div>
<div class='alert alert-info' style='top:600px;position:absolute;'>
  <strong>Notes:</strong> Maximum upload file size 2GB  
</div>
<?PHP
 if(isset($_POST['Enviar'])){

//$removeExtension = explode('.',basename($_FILES["fileToUpload"]["name"]);
//$target_file = $target_dir .date("m-d-y").date("h-i-sa").".$removeExtension[1]")
	$folder=$_POST['aplicativo'];

	switch($folder){
		case "ServiceDeskPlus": 
		
		$target_dir = "uploads/ServiceDeskPlus/";
	    $aplicacion="ServiceDeskPlus";
		break;
		case "OPManager": 
		
		$target_dir = "uploads/OPManager/";
		$aplicacion="OPManager";
		break;
		case "APPManager": 
		
		$target_dir = "uploads/APPManager/";
		$aplicacion="APPManager";
		break;
		case "ADaudit": 
		
		$target_dir = "uploads/ADaudit/";
		$aplicacion="ADAudit";
		break;
		case "ADManager": 
		
		$target_dir = "uploads/ADManager/";
		$aplicacion="ADManager";
		break;
		case "ADSelfService": 

		$target_dir = "uploads/ADSelfService/";
		$aplicacion="ADSelfService";
		break;
		
		case "EventlogAnalyzer": 
		
		$target_dir = "uploads/EventlogAnalyzer/";
		$aplicacion="EventlogAnalyzer";
		break;
		case "Footprints": 
		
		$target_dir = "uploads/Footprints/";
		$aplicacion="Footprints";
		break;
		default:
        
		$target_dir = "uploads/";
		$aplicacion="Otro";
	}
	

$target_file = $target_dir . basename($_FILES['fileToUpload']['name']);
//Creamos la variable de nombre de archivo
$archivo = basename($_FILES['fileToUpload']['name']);

//Empezamos con la conexión a la base de datos




    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        
		$urldescarga= "http://". $_SERVER['HTTP_HOST'] . "/bonitos/" .$target_dir .basename( $_FILES["fileToUpload"]["name"]) ;
		$hostname="localhost";
$user="root";
$password="";
$database="bonitos";

$con=mysqli_connect($hostname,$user,$password,$database);
//si es que falla la conexión a mysql
if(mysqli_connect_errno()){
echo "Failed to connect to MySQL:" . mysqli_connect_error();
echo "<script> alert('Fallo la conexión');</script>";
}

//ejecuta las query
$query="insert into files (name,url,app) values ('$archivo','$urldescarga','$aplicacion')";
//$query="insert into files (name,url,app) values ('Prueba','Prueba2','Prueba3')";
$result=mysqli_query($con,$query);
$last_id = $con->insert_id;
mysqli_close($con);
		echo "<div class='alert alert-success' style='top:400px;position:relative;'>
  <strong>Success!</strong> Your file with id <strong>$last_id </strong>has been uploaded <input type='text' name='url' id='copiar' value='$urldescarga'> <input type='submit' name='submit' value='Copy Link' onclick='copy()' class='btn btn-info' >
</div>";
		



		//echo '<script>alert (" Ha respondido '.$urldescarga.' respuestas afirmativas");</script>';
		//echo '<script>var copyText = document.getElementById("copiar");copyText.select();document.execCommand("Copy"); alert("Copied the text: " + copyText.value);</script>';
		
 
 
    } else {
        
		echo "<div class='alert alert-warning'>
  <strong>UPS!, algo salio mal</strong>  
</div>";
    }
}


?>

<script>
function copy(){
var copyText = document.getElementById("copiar");
copyText.select();
document.execCommand("Copy"); 
alert("Se ha copiado: " + copyText.value);;
		
}
function algo(){
	$('#enviar').show();
	$('#aplicativo').show();
	$('#application').show();
	
}


$("#enviar").click(function(){
	$('#loading_image').show(); // show loading image, as request is about to start
/*$.ajax({
    url: '..',
    type: '..',
    complete: function() {
        // request is complete, regardless of error or success, so hide image
        $('#loading_image').hide();
    }
});*/

	
});
	
	
</script>



</body>
</html>