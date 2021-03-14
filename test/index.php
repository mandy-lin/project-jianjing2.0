<?php

//index.php

include('database_connection.php');

$query = "SELECT * FROM apps_countries ORDER BY country_name ASC";
$statement = $connect->prepare($query);
$statement->execute();
$result = $statement->fetchAll();


?>

<html>  
    <head>  
        <title>How to Make Editable Select Box using jQuery with PHP</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <link rel="stylesheet" href="jquery-editable-select.min.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <script src="jquery-editable-select.min.js"></script>
  
    </head>  
    <body>  
        <div class="container">  
            <br />  
            <br />
   <br />
   <h2 align="center">How to Make Editable Select Box using jQuery with PHP</h2><br />
   <div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
     <form method="post" id="sample_form">
      <div class="form-group">
       <label>Enter Name</label>
       <input type="text" name="name" id="name" class="form-control">
      </div>
      <div class="form-group">
       <label>Select Country</label>
       <select name="country" id="country" class="form-control">
       <?php
       foreach($result as $row)
       {
        echo '<option value="'.$row["country_name"].'">'.$row["country_name"].'</option>';
       }
       ?>
       </select>
      </div>
      <div class="form-group">
       <input type="hidden" name="action" id="action" value="add" />
       <input type="hidden" name="hidden_id" id="hidden_id" value="" /> 
       <input type="submit" name="Save" id="save" class="btn btn-success" value="Save" />
      </div>
     </form>
     <br />
     <div class="table-responsive">
      <table class="table table-bordered">
       <thead>
        <tr>
         <th>Name</th>
         <th>Country</th>
         <th>Edit</th>
        </tr>
       </thead>
       <tbody>
        
       </tbody>
      </table>
     </div>
    </div>
    
   </div>
   
   
   <br />
   <br />
   <br />
  </div>
    </body>  
</html>  
<script>  
$(document).ready(function(){
 
 fetch_data();
 
 function fetch_data()
 {
  $.ajax({
   url:"fetch.php",
   method:"POST",
   success:function(data)
   {
    $('tbody').html(data);
   }
  });
 }
 
 $('#country').editableSelect();
 
 $('#sample_form').on('submit', function(event){
  event.preventDefault();
  
  if($('#name').val() == '')
  {
   alert("Enter Name");
   return false;
  }
  else if($('#country').val() == '')
  {
   alert("Select Country");
   return false;
  }
  else
  {
   $.ajax({
    url:"action.php",
    method:"POST",
    data:$(this).serialize(),
    success:function(data)
    {
     alert(data);
     $('#sample_form')[0].reset();
     $('#action').val("add");
     $('#save').val('Save');
     fetch_data();
    }
   });
  }
 });
 
 $(document).on('click', '.edit', function(){
  var id = $(this).attr("id");
  var action = 'fetch_single';
  $.ajax({
   url:"action.php",
   method:"POST",
   data:{id:id, action:action},
   dataType:'json',
   success:function(data)
   {
    $('#hidden_id').val(id);
    $('#name').val(data.name);
    $('#country').val(data.country);
    $('#action').val("edit");
    $('#save').val('Edit');
   }
  });
 });

});  
</script>