<?php 
include('common.php'); 
 ?>
<?php 
require_once 'db_connect.php';
if (is_numeric($_GET['id'])){
    $id=$_GET['id'];
}else{
    header('location:houses.php?#');
}
$sql="select * from houses as h join house_categories as hc on h.category_id=hc.id where h.id=$id";
$result=$conn->query($sql);
if($result->num_rows==1){
  $row=$result->fetch_assoc();
}else{
  $row=[];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        #gap{
            width: 100%;
            height: 5vmax;
        }
        .container{                      
            display:flex;   
            justify-content: center;                
        }

        .first-enter{            
            margin: auto 25vmax;
            width:20vmax;   
         
        } 
        button{
            width:50px;
            height: 20px;            
            position: absolute;
            top: 80px; /* Adjust the top position as needed */
            right: 10px; /* Adjust the right position as needed */
        }        
        h2{
            margin-left: 100px;
        }    
        .list{            
            font-style:italic;        
            font-size: 22px;
            padding: 0 20px;
        }
        .list span{            
            color:blue;
            font-weight:bold;                 
        }
        img{
            height: 20vmax;
            width:25vmax;
        }

    </style>
</head>
<body>
    <div id="gap"></div>
    <div class="container">
        <a href="houses.php"><button>back</button></a>
        <div class="first-enter">
            <div class="form"><h2>House No. <?php echo $row['house_no'] ?></h2></div>

                <div class="list">

                   <?php    echo '<img src="' . $row['image']. '" alt="">'?>
                
                    <br>
                    <br>
                    House No:<span><?php echo $row['house_no'] ?></span>
                    <br>                  
                    Category:<span><?php echo $row['name'] ?></span>
                    <br>
                    Location:<span><?php echo $row['location'] ?></span>
                    <br>

                    Latitude:<span><?php echo $row['latitude'] ?></span>
                    <br>

                    Longitude:<span><?php echo $row['longitude'] ?></span>
                    <br>
					
                    Description:<span><?php echo $row['description'] ?></span>
                    <br>

                    Price:<span><?php echo $row['price'] ?></span>
                    <br>
                    <?php if($row['availability']==0){?>
                    Status:<span style="color: red;"> Booked</span>
                    <?php }else{?>
                    Status:<span style="color: green;"> Available</span>  
                                <?php } ?><br>
                    Facilities:<br>
                    <?php if($row['electricity']==1){?>
                    <li>Electricity</li>
                    <?php } ?>
                    <?php if($row['parking']==1){?>
                    <li>parking</li>
                    <?php } ?>
                    <?php if($row['internet']==1){?>
                    <li>internet</li>
                    <?php } ?>
                    <?php if($row['security']==1){?>
                    <li>security</li>
                    <?php } ?>
                    <?php if($row['drinking_water']==1){?>
                    <li>drinking Water</li>
                    <?php } ?>


                    </div>
                </div>
            </div>
        </div>
       
    </div>
</body>
</html>
