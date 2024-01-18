<?php
include('common.php'); 
require_once 'db_connect.php';

?>
 <?php 
 if (isset($_POST['btn_save'])){
  $err=[];
  if(isset($_POST['date']) && !empty($_POST['date']) && trim($_POST['date'])){
    $date = $_POST['date'];
  }else{
    $err['date']= "Please enter date";
  } 
  if(isset($_POST['tenant_id']) && !empty($_POST['tenant_id']) && trim($_POST['tenant_id'])){
      $tenant = $_POST['tenant_id'];
      
    }else{
      $err['tenant']= "Please choose tenant";
    } 
    if(isset($_POST['invoice']) && !empty($_POST['invoice']) && trim($_POST['invoice'])){
        $invoice = $_POST['invoice'];
      }else{
        $err['invoice']= "Please enter invoice";
      }
      if(isset($_POST['amount']) && !empty($_POST['amount']) && trim($_POST['amount'])){
      $amount = $_POST['amount'];
    }else{
      $err['amount']= "Please enter amount";
    } 


    if(count($err)==0){
try{
       
          $sql="INSERT INTO payments(tenant_id,amount,date_created,invoice) VALUES ('$tenant','$amount','$date','$invoice')";

        
          $result = $conn->query($sql);
         
              if ($conn->affected_rows == 1 && $conn->insert_id > 0) {
                  $success = "Data successfully inserted";
              } else {
                  $error = "Data insertion failed";
              
          }
        }catch (Exception $e) {
            $error = " " . $e->getMessage();
        }
        }
    }  
  
 ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #f0f0f0;
}
    #gap{
            width: 100%;
            height: 5vmax;
        }
.container {
    max-width: 400px;
    margin: 0 auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
}

h1 {
    text-align: center;
    margin-bottom: 20px;
}
form{
    margin-right:10px;
}
.form-group {
    margin-bottom: 15px;
}

label {
    display: block;
    font-weight: bold;
    margin-bottom: 5px;
}

input[type="text"],
input[type="number"],
input[type="date"],
select {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

button {
    background-color: #007BFF;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

button:hover {
    background-color: #0056b3;
}

    </style>
</head>
<body>
<div id="gap"></div>
    <div class="container">
    <?php if(isset($error)){ ?>
            <p style="color: red; font-size: 20px; font-family:cursive"><?php echo $error ?></p>
        <?php } ?>
        <?php if(isset($success)){ ?>
            <p style="color: green; font-size: 20px; font-family:cursive"><?php echo $success ?></p>
        <?php } ?>
        <h1>Add Payment</h1>
        <form action="#" method="POST">
            <div class="form-group">
                <label for="date">Date:</label>
                <input type="date" id="date" name="date">
                <?php
                    if(isset($err['date'])){?>
                    <span style="color: red;"><?php echo $err['date'] ?></span>
                <?php } ?><br>
            </div>
            <div class="form-group">
                <label for="tenant">Tenant:</label>
                <select name="tenant_id" id="" class="custom-select">
                    <option value=""></option>
					<?php 
                        include 'db_connect.php';
						$tenants = $conn->query("SELECT * FROM `tenants` order by name asc");
						if($tenants->num_rows > 0):
						while($row= $tenants->fetch_assoc()) :
					?>
						<option value="<?php echo $row['id'] ?>"><?php echo $row['id'] ?>(<?php echo $row['name'] ?>)</option>
					<?php endwhile; ?>
					<?php else: ?>
						<option selected="" value="" disabled="">Please check the tenant id.</option>
					<?php endif; ?>
				</select>
                <br>
                <?php
                    if(isset($err['date'])){?>
                    <span style="color: red;"><?php echo $err['tenant'] ?></span>
                <?php } ?><br>
            </div>
            <div class="form-group">
                <label for="invoice">Invoice:</label>
                <input type="text" id="invoice" name="invoice">
                <?php
                    if(isset($err['invoice'])){?>
                    <span style="color: red;"><?php echo $err['invoice'] ?></span>
                <?php } ?><br>
            </div>
            <div class="form-group">
                <label for="amount">Amount:</label>
                <input type="number" id="amount" name="amount" step="0.01"  >
                <?php
                    if(isset($err['amount'])){?>
                    <span style="color: red;"><?php echo $err['amount'] ?></span>
                <?php } ?><br>
            </div>
            <div class="form-group">
                <button type="submit" name="btn_save">Submit Payment</button>
            </div>
        </form>
    </div>
</body>
</html>
