<?php 
include('common.php'); 
?>
<?php 
require_once 'db_connect.php';
$id=$_GET['id'];
$em=$_GET['em'];
$na=$_GET['na'];
$co=$_GET['co'];
$ad=$_GET['ad'];
$dt=$_GET['dt'];
$idt=$_GET['idt'];
$idp=$_GET['idp'];
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
            margin:0px 10px 0 20vmax;
            display:flex;
        }
        button{
            width:50px;
            height: 20px;            
            position: absolute;
            top: 80px; /* Adjust the top position as needed */
            right: 10px; /* Adjust the right position as needed */
        }  
        .first-enter{
            margin: auto 25vmax;
            width:20vmax;          
         
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
            height: 15vmax;
            width:20vmax;
        }

    </style>
</head>
<body>
    <div id="gap"></div>
    <div class="container">
    <a href="tenant.php"><button>back</button></a>
        <div class="first-enter">
            <div class="form"><h2>Tenant id. <?php echo "$id" ?> </h2></div>

                <div class="list">

                    Name:<span><?php echo "$na" ?></span>
                    <br> 

                    Email:<span><?php echo "$em" ?></span>
                    <br>
                    
                    Phone Number:<span><?php echo "$co" ?></span>
                    <br>
                    
                    Registered in:<span><?php echo "$dt" ?></span>
                    <br>

                    Id Type:<span><?php echo "$idt" ?></span>
                    <br> 

                    Id Photo:<br>                     

                   <?php    echo '<img src="' . $idp. '" alt="">'?>
                

                    </div>
                </div>
            </div>
        </div>
       
    </div>
</body>
</html>
