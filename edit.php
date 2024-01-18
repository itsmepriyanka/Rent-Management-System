<?php include('common.php'); ?>
<?php
    if (is_numeric($_GET['id'])){
        $id=$_GET['id'];
    }else{
        header('location:houses.php?msg=1');
    }
if (isset($_POST['btnUpdate'])){
    $err=[];
    if(isset($_POST['house_no']) && !empty($_POST['house_no']) && trim($_POST['house_no'])){
        $house_no = $_POST['house_no'];
    }else{
        $err['house_no']= "Please enter House no";
    } 
    if (count($err) === 0) {
        require_once 'db_connect.php';
        $checkDuplicateQuery = "SELECT COUNT(*) as count FROM houses WHERE house_no = '$house_no'";
        $duplicateResult = $conn->query($checkDuplicateQuery);
        $duplicateData = $duplicateResult->fetch_assoc();

        if ($duplicateData['count'] > 0) {
            $err['house_no'] = "House number already exists";
        }
    }
    if(isset($_POST['category_id']) && !empty($_POST['category_id']) && trim($_POST['category_id'])){
        $category = $_POST['category_id'];
    }else{
        $err['category_id']= "Please enter category name";
    } 
    if(isset($_POST['location']) && !empty($_POST['location']) && trim($_POST['location'])){
        $location = $_POST['location'];
    }else{
        $err['location']= "Please enter location";
    } 
    if(isset($_POST['description']) && !empty($_POST['description']) && trim($_POST['description'])){
        $description = $_POST['description'];
    }else{
        $err['description']= "Please enter description";
    }  
    if(isset($_POST['price']) && !empty($_POST['price']) && trim($_POST['price'])){
        $price = $_POST['price'];
    }else{
        $err['price']= "Please enter Amount";
    }  
    if(count($err)==0){
        require_once 'db_connect.php';
        $sql="UPDATE `houses` SET house_no='$house_no',category_id='$category_id',location='$location',description='$description',price='$price' WHERE id='$id'";
        $conn->query($sql);
        if($conn->affected_rows==1){
          $success="House successfully updated";
        }else{
          $error= "House updated failed";
        }
      }
}

// Fetch house details for editing if house_id is provided
      $sql="SELECT * FROM `houses` WHERE id=$id";
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
        .button button{
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
            <form action="houses.php" method="post">
                <div class="list">
                    <br><label>House No</label><br>
                    <input type="text" name="house_no" value="<?php echo isset($row['house_no'])?$row['house_no']:''?>">
                    <?php
                    if(isset($err['house_no'])){?>
                        <span style="color: red;"><?php echo $err['house_no'] ?></span>
                    <?php } ?><br>
                    <label>Category</label><br>
                    <select name="category_id" id="" class="custom-select" required>
                        <option value=""></option>
                        <?php 
                        include 'db_connect.php';
                        $categories = $conn->query("SELECT * FROM `house_categories` ORDER BY name ASC");
                        if($categories->num_rows > 0):
                            while($cat_row = $categories->fetch_assoc()) :
                                $selected = (isset($row['category_id']) && $row['category_id'] == $cat_row['id']) ? 'selected' : '';
                        ?>
                                <option value="<?php echo $cat_row['id'] ?>" <?php echo $selected ?>><?php echo $cat_row['name'] ?></option>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <option selected="" value="" disabled="">Please check the category list.</option>
                        <?php endif; ?>
                    </select><br>
                    <label>Location</label><br>
                    <input type="text" name="location" value="<?php echo isset($row['location']) ? $row['location'] : '' ?>">
                    <?php
                    if(isset($err['location'])){?>
                        <span style="color: red;"><?php echo $err['location'] ?></span>
                    <?php } ?><br>
                    <label>Description</label><br>
                    <input type="message" name="description" value="<?php echo isset($row['description']) ? $row['description'] : '' ?>">
                    <?php
                    if(isset($err['description'])){?>
                        <span style="color: red;"><?php echo $err['description'] ?></span>
                    <?php } ?><br>
                    <label>Price</label><br>
                    <input type="number" name="price" value="<?php echo isset($row['price']) ? $row['price'] : '' ?>">
                    <?php
                    if(isset($err['price'])){?>
                        <span style="color: red;"><?php echo $err['price'] ?></span>
                    <?php } ?><br>
                    <div class="button">
                        <button type="submit" name="btnUpdate">Update</button>
                        <button>Cancel</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="second-list">
            <div class="form">House List</div>
            <div class="body_1">
                <div>
                    Show
                    <select name="num" id="num">
                        <option></option>
                        <option>5</option>
                        <option>10</option>
                    </select>
                </div>
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
                            </td>
                            <td class="text-center">
                                <button><a href="houses_edit.php?id=<?php echo $record['id']?>">Edit</a></button>
                                <button><a href="house_delete.php?id=<?php echo $row['id'] ?>" onclick="return confirm('Are you sure you want to delete?')">Delete</a></button>
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
