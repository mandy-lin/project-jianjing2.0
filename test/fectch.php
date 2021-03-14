<?php

//fetch.php

include('database_connection.php');

$query = "SELECT * FROM sample_data ORDER BY id DESC";
$statement = $connect->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$total_row = $statement->rowCount();
$output = '';
if($total_row > 0)
{
 foreach($result as $row)
 {
  $output .= '
  <tr>
   <td>'.$row["name"].'</td>
   <td>'.$row["country"].'</td>
   <td><button type="button" name="edit" class="btn btn-primary btn-xs edit" id="'.$row["id"].'">Edit</button></td>
  </tr>
  ';
 }
}
else
{
 $output .= '
 <tr>
  <td colspan="3" align="center">Data not found</td>
 </tr>
 ';
}

echo $output;

?>