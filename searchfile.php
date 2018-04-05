<html>
<header>
<title>Search File</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="styles/search.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script>
$(document).ready(function(){
         'use strict';
    var $ = jQuery;
    $.fn.extend({
        filterTable: function(){
            return this.each(function(){
                $(this).on('keyup', function(e){
                    $('.filterTable_no_results').remove();
                    var $this = $(this), 
                        search = $this.val().toLowerCase(), 
                        target = $this.attr('data-filters'), 
                        $target = $(target), 
                        $rows = $target.find('tbody tr');
                        
                    if(search == '') {
                        $rows.show(); 
                    } else {
                        $rows.each(function(){
                            var $this = $(this);
                            $this.text().toLowerCase().indexOf(search) === -1 ? $this.hide() : $this.show();
                        })
                        if($target.find('tbody tr:visible').size() === 0) {
                            var col_count = $target.find('tr').first().find('td').size();
                            var no_results = $('<tr class="filterTable_no_results"><td colspan="'+col_count+'">No results found</td></tr>')
                            $target.find('tbody').append(no_results);
                        }
                    }
                });
            });
        }
    });
    $('[data-action="filter"]').filterTable();
})(jQuery);

$(function(){
    // attach table filter plugin to inputs
    $('[data-action="filter"]').filterTable();
    
    $('.container').on('click', '.panel-heading span.filter', function(e){
        var $this = $(this), 
            $panel = $this.parents('.panel');
        
        $panel.find('.panel-body').slideToggle();
        if($this.css('display') != 'none') {
            $panel.find('.panel-body input').focus();
        }
    });
    $('[data-toggle="tooltip"]').tooltip();
});
</script>
</header>

<div id="header">
<h4>Búsqueda de Archivos</h4>
  


</div>
<div class="container fuente" style="position: absolute;top:10%;width: 100%">
    
            <div class="col-lg-20">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title">Archivos</h3>
                       
                        <input type="text" class="form-control" id="task-table-filter" data-action="filter" data-filters="#task-table" placeholder="Introduce tu búsqueda" />
                            


                        </div>
                           
                   
                  
                  
                       <!--
                        <div class="pull-right">
                            <span class="clickable filter" data-toggle="tooltip" title="Toggle table filter" data-container="body">
                                <i class="glyphicon glyphicon-filter"></i>
                            </span>
                        </div>
                    -->
                    </div>
                    <div class="panel-body">
                        <input type="text" class="form-control" id="task-table-filter" data-action="filter" data-filters="#task-table" placeholder="Introduce tu búsqueda" />

                    <input type="text" name="" placeholder="prueb">
                    </div>
                  
           
		
</html>


<?php 

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
$query="select * from files";

$result=mysqli_query($con,$query);
if ($result->num_rows > 0) {

 echo "<table class='table table-hover fuente' id='task-table' ><tr class='filters'><th>ID</th><th>Archivo</th><th>Aplicativo</th><th>Liga de descarga</th><th>Fecha de subida</th></tr>";

    // output data of each row
    while($row = $result->fetch_assoc()) {

        echo "<tr><td>" . $row["idfile"] . "</td><td>" . $row["name"]. " </td><td> " . $row["app"]. "</td><td><a href='" . $row["url"] . "' class='button'>Descargar</a></td><td>" . $row["createdtime"] ."</td></tr>";
    }
	echo "</table></div>";

} else {
    echo "0 results";
}
mysqli_close($con);




?>