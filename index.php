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
		$("#ticket").on("keypress keyup blur",function (event) {    
           $(this).val($(this).val().replace(/[^\d].+/, ""));
            if ((event.which < 48 || event.which > 57)) {
                event.preventDefault();
            }
        });
	});
	
</script>

<div id="header">
<img src="img/logo-dric.png">
<h2 style=" top:0;left:80%; position:absolute;">Servidor FTP</h2>
<h4 style="position: absolute; top:50px; left:80%;">Equipo de soporte</h4>

</div>

<
<div id="cajaupload" >

    <p><i class="glyphicon glyphicon-upload" id="uploadicon"></i></p>

	<form enctype="multipart/form-data" action="index.php" method="post">
    <input type="file" name="fileToUpload" id="fileuploader" onchange="algo()">
	 
	<p style="position: absolute; top:130px; left:-20px;font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif;" id="application">Aplicativo:</p>
	<select class="form-control" name="aplicativo" id="aplicativo" style="position: absolute; top:150px; left:-30px;width:180px">
	
	<option value="ServiceDeskPlus">Servicedesk Plus</option>
	<option value="DesktopCentral">Desktop Central</option>
	<option value="OPManager">OPManager</option>
	<option value="APPManager">APPManager</option>
	<option value="ADaudit">ADaudit</option>
	<option value="ADManager">ADManager</option>
	<option value="ADSelfService">ADSelfService</option>
	<option value="RecoveryManager">Recovery Manager</option>
	<option value="EventlogAnalyzer">Eventlog Analyzer</option>
	<option value="Footprints">Footprints</option>
	<option value="Otro">Otro</option>
	</select>
	
<!--Inicia formulario -->

<div class="container" style="position: absolute; top:200px; left:-400px" >
	<div class="panel panel-info col-lg-10">
		<div class="panel-body">
			<div class="row">
			<div class="col-sm-3">
				<label>Nombre:</label>
				<input class="form-control" type="text" name="nombre" id="nombre" placeholder="Ingresa tu nombre" required>	

			</div>
			<div class="col-sm-3">
				<label>Empresa:</label>
				<input class="form-control" type="text" name="empresa" id="empresa" placeholder="Ingresa tu empresa" required>	
				
			</div>
			<div class="col-sm-3">
				<label>Ticket:</label>
				<input class="form-control" type="text" name="ticket" id="ticket" placeholder="Ticket con iDric" required>	
				
			</div>
			
			
		</div>	
	</div>
		
			<div class="col-lg-10">
				<label>Comentarios:</label>
				<textarea name="comentarios" id="comentarios" class="form-control" rows="3" placeholder="Comparta sus comentarios(Opcional)"></textarea></br>
			
				<input type="submit" value="Compartir" name="Enviar" id="enviar" class="btn btn-info"  onclick="upload">
			
			</div>
			

		

		</div>
		
</div>






    
	</form>
<img src='img/loading.gif' style='position:relative;left:20px;top:250px;' id="loading_image">
</div>

   
</div>


<div class="panel panel-info" style='top:700px;position:relative;'>
		<div class="panel-heading"><strong>Ayuda</strong></div>
		<div class="panel-body"><p>Con nuestro FTP podrás compartir archivos que son necesarios para llevar a cabo un análisis oportuno a los incidentes reportados
		

		<ol>
			<li>Realiza clic sobre el icono de flecha para seleccionar el archivo a compartir</li>
			<li>Selecciona el archivo a compartir y realiza clic sobre el botón Abrir</li>
			<li>Selecciona el aplicativo que presenta el incidente</li>
			<li>Proporciona la siguiente información: Nombre, Empresa, Comentarios(Opcional)</li>
			<li>Realiza clic sobre el botón compartir</li>
		</ol>

<strong>Nota:</strong> Tamaño máximo de archivo soportado 2GB 
</p> 
	</div>
	</div>

<?PHP
 if(isset($_POST['Enviar'])){

$nombre = $_POST['nombre'];
$empresa = $_POST['empresa'];
$ticket = $_POST['ticket'];
$comentarios = $_POST['comentarios'];
//$removeExtension = explode('.',basename($_FILES["fileToUpload"]["name"]);
//$target_file = $target_dir .date("m-d-y").date("h-i-sa").".$removeExtension[1]")
	$folder=$_POST['aplicativo'];

	switch($folder){
		case "ServiceDeskPlus": 
		
		$target_dir = "uploads/ServiceDeskPlus/";
	    $aplicacion="ServiceDeskPlus";
		break;

		case "Desktop Central": 
		
		$target_dir = "uploads/desktopcentral/";
	    $aplicacion="DesktopCentral";
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

		case "Recovery Manager": 

		$target_dir = "uploads/recoverymanager/";
		$aplicacion="RecoveryManager";
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
//Creamos la variable de nombre de archivo,nombre,empresa,ticket,comentarios
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
$query="insert into files (nombre,empresa,ticket,comentario,name,url,app) values ('$nombre','$empresa','$ticket','$comentarios','$archivo','$urldescarga','$aplicacion')";
//$query="insert into files (name,url,app) values ('Prueba','Prueba2','Prueba3')";
$result=mysqli_query($con,$query);
$last_id = $con->insert_id;
mysqli_close($con);
		echo "<div class='alert alert-success' style='top:400px;position:relative;'>
  <strong>¡Listo!</strong> Tu archivo con id <strong>$last_id </strong>ha sido compartido de manera exitosa <input type='text' name='url' id='copiar' value='$urldescarga'> <input type='submit' name='submit' value='Copiar' onclick='copy()' class='btn btn-info' >
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

	if($('#nombre').val() == ''){
		alert('Proporcione su nombre');
	}


else if($('#empresa').val()=='')
	{
		alert('Proporcione el nombre de su empresa');
	}
	else{
$('#loading_image').show(); // show loading image, as request is about to 


	}
	
	
});
	
	
</script>




</body>
</html>