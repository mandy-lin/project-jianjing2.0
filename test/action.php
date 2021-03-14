<?php

//action.php

include('database_connection.php');

if(isset($_POST["action"]))
{ 
 
 if($_POST["action"] == "add")
 {
  $data = array(
   ':name'  => $_POST["name"],
   ':country'  => $_POST["country"]
  );
  
  $query = "
  INSERT INTO sample_data (name, country) 
  VALUES (:name, :country)
  ";
  
  $statement = $connect->prepare($query);
  if($statement->execute($data))
  {
   echo 'Data Inserted';
  }
 }
 
 if($_POST["action"] == 'fetch_single')
 {
  $query = "SELECT * FROM sample_data WHERE id='".$_POST["id"]."'";
  $statement = $connect->prepare($query);
  $statement->execute();
  $result = $statement->fetchAll();
  foreach($result as $row)
  {
   $output['name'] = $row["name"];
   $output['country'] = $row["country"];
  }
  echo json_encode($output);
 }
 
 if($_POST["action"] == "edit")
 {
  $data = array(
   ':name'  => $_POST["name"],
   ':country'  => $_POST["country"],
   ':id'  => $_POST["hidden_id"]
  );
  $query = "
  UPDATE sample_data 
  SET name = :name, country = :country 
  WHERE id = :id
  ";
  $statement = $connect->prepare($query);
  if($statement->execute($data))
  {
   echo 'Data Updated';
  }
 }
 
}

?>
