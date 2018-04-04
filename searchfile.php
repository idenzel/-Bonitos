<html>
<header>
<title>Search File</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="styles/search.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script>
$(document).ready(function(){
    $('.filterable .btn-filter').click(function(){
        var $panel = $(this).parents('.filterable'),
        $filters = $panel.find('.filters input'),
        $tbody = $panel.find('.table tbody');
        if ($filters.prop('disabled') == true) {
            $filters.prop('disabled', false);
            $filters.first().focus();
        } else {
            $filters.val('').prop('disabled', true);
            $tbody.find('.no-result').remove();
            $tbody.find('tr').show();
        }
    });

    $('.filterable .filters input').keyup(function(e){
        /* Ignore tab key */
        var code = e.keyCode || e.which;
        if (code == '9') return;
        /* Useful DOM data and selectors */
        var $input = $(this),
        inputContent = $input.val().toLowerCase(),
        $panel = $input.parents('.filterable'),
        column = $panel.find('.filters th').index($input.parents('th')),
        $table = $panel.find('.table'),
        $rows = $table.find('tbody tr');
        /* Dirtiest filter function ever ;) */
        var $filteredRows = $rows.filter(function(){
            var value = $(this).find('td').eq(column).text().toLowerCase();
            return value.indexOf(inputContent) === -1;
        });
        /* Clean previous no-result if exist */
        $table.find('tbody .no-result').remove();
        /* Show all rows, hide filtered ones (never do that outside of a demo ! xD) */
        $rows.show();
        $filteredRows.hide();
        /* Prepend no-result row if all rows are filtered */
        if ($filteredRows.length === $rows.length) {
            $table.find('tbody').prepend($('<tr class="no-result text-center"><td colspan="'+ $table.find('.filters th').length +'">No result found</td></tr>'));
        }
    });
$('#new_user').click(function() {
  $('#newuser').toggle('slow', function() {
    // Animation complete.
  });
});
//animar aparicion de div

});
</script>
</header>

<div id="header">
<h1>Search File</h1>
<button class="btn btn-default" id="new_user">New user</button>
</div>
<!--nueva capa para la administración de usuarios-->
<div id="newuser">
<button class="btn btn-default">Dale</button>

</div>

		<div class="panel panel-primary filterable" style="position:absolute;top:150px;">
            <div class="panel-heading">
					<h3 class="panel-title">Files</h3>
				<div class="pull-right">
                    <button class="btn btn-default btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>
                </div>
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

 echo "<table class='table' ><tr class='filters'><th><input type='text' class='form-control' placeholder='ID' disabled></th><th><input type='text' class='form-control' placeholder='File Name' disabled></th><th><input type='text' class='form-control' placeholder='Aplicativo' disabled></th><th><input type='text' class='form-control' placeholder='URL' disabled></th><th><input type='text' class='form-control' placeholder='Created Time' disabled></th></tr>";

    // output data of each row
    while($row = $result->fetch_assoc()) {

        echo "<tr><td>" . $row["idfile"] . "</td><td>" . $row["name"]. " </td><td> " . $row["app"]. "</td><td>" . $row["url"] . "</td><td>" . $row["createdtime"] ."</td></tr>";
    }
	echo "</table></div>";

} else {
    echo "0 results";
}
mysqli_close($con);




?>