<?php
include("nav.php"); 
require_once 'db_connect.php';
$id=$_GET['id'];
$sql="select * from houses as h join house_categories as hc on h.category_id=hc.id where h.id=$id";
$data=$conn->query($sql);
$houseDetail=[];
if($conn->affected_rows==1){
   $row=$data->fetch_object();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Property Details</title>
    <style>
    
        .list{ 
            font-style:italic;        
            font-size: 22px;
        margin:50px;
        }
       
        .first{
            float: left;
            width: 50%;
        }
        .second{
            margin: 10%;
        }
        .list span{            
            color:blue;
            font-weight:bold;                 
        }
        img{
            height: 30vmax;
            width:35vmax;
        }

    </style>
</head>
<body>
    <div class="list">
       
        <div class="first">
           <img src="<?php echo $row->image;?>" alt="">
        </div>
        <div class="second">
            <br>
            <br>
            House No:<span><?php echo $row->house_no; ?></span>
            <br>                  
            Category:<span><?php echo $row->name; ?></span>
            <br>
            Location:<span><?php echo $row->location ?></span>
            <br>
            Latitude:<span><?php echo  $row->latitude?></span>
            <br>
            Longitude:<span><?php echo $row->longitude ?></span>
            <br>
            Description:<span><?php echo $row->description ?></span>
            <br>
            Price:<span><?php echo $row->price ?></span>
            <br>
            
        </div>
    </div>

</body>
</html>
