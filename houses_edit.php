<?php 
// include('common.php'); 
include("img.php"); ?>
<?php 
if (is_numeric($_GET['id'])){
    $id=$_GET['id'];
}else{
    header('location:houses.php?#');
}
require_once 'db_connect.php';
?>
<?php
if(isset($_POST['btnUpdate'])){
    include('houses_engine.php');
    
   echo $sql="UPDATE `houses` SET house_no='$house_no',category_id='$category_id',description='$description',price='$price',location='$location',longitude='$longitude',latitude='$latitude',image='$path',electricity='$electricity',parking='$parking',internet='$internet',drinking_water='$drinking_water',security='$security' where id='$id'";
    $data=mysqli_query($conn,$sql);
    if($data){
        $success="category successfully updated";
    }else{
              $error= "category updated failed";
    }
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
            margin:0px 10px 0 20vmax;
            display:flex
        }
        table{
            border-collapse: collapse;
        }
        .first-enter{
            width:300px;
            margin:30px;
            height:80%;
        }
        .second-list{
            background-color: aliceblue;
            padding:0 0 30px 0;
            width:40vmax;
            margin:30px;
            height:80%;
        }
        .form{
            background-color: rgb(176, 172, 172);
            padding: 10px;
        }
        .list{
            background-color: aliceblue;
        }
        .list label, .list input, .list select{
            margin: 10px;
            height: 30px;
            width: 17vmax;
        } 
        button{        
            color: black;
        }
        button a{
            text-decoration: none;
            color: black;
        } 
        .button {
            padding: 10px 0 10px 0;
            height: 40px;
            background-color: rgb(176, 172, 172);
            display: flex;
            justify-content: space-evenly;
            margin-top: auto;
        }
        .button button,.button a{
            width: 80px;
            border-radius: 10px;
        }
        .button button:hover{
            background-color:  #6e0cd6;
            color:white;
        }
        .body_1{
            display: flex;
            justify-content: space-between;
            padding:10px 20px 0 20px;
            font-size: large;
        }
        h4{
            margin-top: 0;
        }
        .box{
            width: 15vmax;
        }
        table{
            width:37vmax;
        }
        .house{
            width:23vmax;
        }
        .btnDisabled {
            pointer-events: none;
            opacity: 0.3;
        }
        .feature_box {
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .feature__group {
            display: flex;
            align-items: center;
        }

        .feature__group input {
            width: 12px;
            margin: 0 15px 0 30px;
        }

    </style>
</head>
<body>
    <div id="gap"></div>
    <div class="container">
        <div class="first-enter">
        <?php if(isset($error)){ ?>
        <p style="color: red; font-size: 20px; font-family:cursive"><?php echo $error ?></p>
         <?php } ?>
         <?php if(isset($success)){ ?>
    <p style="color: green; font-size: 20px; font-family:cursive"><?php echo $success ?></p>
  <?php } ?>
            <div class="form">House Form</div>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="list">
                    <br><label>House No</label><br>
                    <input type="text" name="house_no" value="<?php echo isset($row['house_no'])?$row['house_no']:''?>">
                    <?php
                    if(isset($err['house_no'])){?>
                        <span style="color: red;"><?php echo $err['house_no'] ?></span>
                    <?php } ?><br>
                    <label>Category</label><br>
                    <select name="category_id" id="" class="custom-select">
                    <option  value=""><?php echo isset($row['name'])?$row['name']:''?></option>
					<?php 
                        include 'db_connect.php';
						$categories = $conn->query("SELECT * FROM `house_categories` order by name asc");
						if($categories->num_rows > 0):
						while($row1= $categories->fetch_assoc()) :
					?>
						<option value="<?php echo $row1['id'] ?>"><?php echo $row1['name'] ?></option>
					<?php endwhile; ?>
					<?php else: ?>
						<option selected="" value="" disabled="">Please check the category list.</option>
					<?php endif; ?>
				</select><br>
                    <label>Location</label><br>
                    <input type="text" name="location" value="<?php echo isset($row['location'])?$row['location']:''?>">
                    <?php
                    if(isset($err['location'])){?>
                        <span style="color: red;"><?php echo $err['location'] ?></span>
                    <?php } ?><br>               

                    <label>longitude</label><br>
                <input type="text" name="longitude" value="<?php echo isset($row['longitude'])?$row['longitude']:''?>">
                <?php
                    if(isset($err['longitude'])){?>
                    <span style="color: red;"><?php echo $err['longitude'] ?></span>
                    <?php } ?><br>
                    <label>latitude</label><br>
                <input type="text" name="latitude" value="<?php echo isset($row['latitude'])?$row['latitude']:''?>">
                <?php
                    if(isset($err['latitude'])){?>
                    <span style="color: red;"><?php echo $err['latitude'] ?></span>
                    <?php } ?><br>
                    <label>Description</label><br>
                    <input type="message" name="description" value="<?php echo isset($row['description'])?$row['description']:''?>">
                    <?php
                    if(isset($err['description'])){?>
                        <span style="color: red;"><?php echo $err['description'] ?></span>
                    <?php } ?><br>
                    <label>Price</label><br>
                    <input type="number" name="price" value="<?php echo isset($row['price'])?$row['price']:''?>">
                    <?php
                    if(isset($err['price'])){?>
                        <span style="color: red;"><?php echo $err['price'] ?></span>
                    <?php } ?><br>
                    <label for="card_photo">Facilities</label><br>
                    <div class="feature_box">
                        <div class="feature__group"><input type="checkbox"  name="electricity">Electricity</div>
                        <div class="feature__group"><input type="checkbox"  name="drinking_water">Drinking Water</div>
                        <div class="feature__group"><input type="checkbox"  name="internet">internet</div>
                        <div class="feature__group"><input type="checkbox"  name="parking">Parking</div>
                        <div class="feature__group"><input type="checkbox"  name="security">security</div>

                    </div>
                    <label for="card_photo">Update image</label>
                <input type="file" class="form-control" placeholder="Update image" name="image" accept="images/*" >
                <?php
                    if(isset($err['image'])){?>
                    <span style="color: red;"><?php echo $err['image'] ?></span>
                <?php } ?>
                    <div class="button">
                        <button type="submit" name="btnUpdate">Update</button>
                        <button><a href="houses.php">Cancel</a></button>
                    </div>
                </div>
            </form>
        </div>
        <div class="second-list">
            <div class="form">House List</div>
            <div class="body_1">                
                <h4>Search<input type="text"></h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover" border="1">
                    <thead>
                        <tr>
                            <th class="text-center">SN</th>
                            <th class="text-center house">House</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $i = 1;
                        $house = $conn->query("SELECT h.*, c.name as cname FROM houses h INNER JOIN house_categories c ON c.id = h.category_id ORDER BY id ASC");                       
                        while($row = $house->fetch_assoc()):
                        ?>
                        <tr>
                            <td class="text-center"><?php echo $i++ ?></td>
                            <td class="text-center box">
                                <p>House No.: <b><?php echo $row['house_no'] ?></b></p>
                                <p><small>House Type: <b><?php echo $row['cname'] ?></b></small></p>
                                <p><small>Location: <b><?php echo $row['location'] ?></b></small></p>
                                <p><small>Description: <b><?php echo $row['description'] ?></b></small></p>
                                <p><small>Price: <b><?php echo number_format($row['price'], 2) ?></b></small></p>
                                <?php if ($row['availability'] == 0) { ?>
                                        <p><small>Status:<b style="color: red;"> Booked</b></small></p>
                                    <?php } else { ?>
                                        <p><small>Status:<b style="color: blue;"> Available</b></small></p>
                                    <?php } ?>
                            </td>
                            <td class="text-center">                                
                            <?php if ($row['availability'] == 0) { ?>
                                        <button class="btnDisabled"><a href="houses_edit.php?id=<?php echo $row['id'] ?>">Edit</a></button>
                                        <button class="btnDisabled"><a href="house_delete.php?id=<?php echo $row['id'] ?>" onclick="return confirm('Are you sure to delete?')">Delete</a></button>
                                        <button><a href="house_view.php?id=<?php echo $row['id'] ?>">View</a></button>
                                    <?php } else { ?>
                                        <button><a href="houses_edit.php?id=<?php echo $row['id'] ?>">Edit</a></button>
                                        <button><a href="house_delete.php?id=<?php echo $row['id'] ?>" onclick="return confirm('Are you sure to delete?')">Delete</a></button>
                                        <button><a href="house_view.php?id=<?php echo $row['id'] ?>">View</a></button>
                                    <?php } ?>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
