<?php include('common.php'); ?>
<?php
    if (is_numeric($_GET['id'])){
        $id=$_GET['id'];
    }else{
        header('location:houseType.php?msg=1');
    } 
    if(isset($_POST['btnUpdate'])){
        $err=[];
        if(isset($_POST['name']) && !empty($_POST['name']) && trim($_POST['name'])){
            $name = $_POST['name'];
          }else{
            $err['name']= "Please enter category name";
          }
          if(count($err)==0){
            require_once 'db_connect.php';
            $sql="UPDATE `house_categories`SET name='$name' WHERE id='$id'";
            $conn->query($sql);
            if($conn->affected_rows==1){
              $success="category successfully updated";
            }else{
              $error= "category updated failed";
            }
          }
        }

      require_once 'db_connect.php';
      $sql="SELECT * FROM `house_categories` WHERE id=$id";
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
            height: 150px;
        }
        #container {
            display: flex;
            justify-content: space-evenly;
            margin-left: 280px;
        }
        .left {
            width: 22vmax;
            height: 15vmax;
            background-color: aliceblue;
            display: flex;
            flex-direction: column;
            border: 0.1px solid grey;
        }
        .right {
            width: 45vmax;           
            background-color: aliceblue;
        }
        .category {
            font-size: 20px;
            height: 2vmax;
            background-color: rgb(176, 172, 172);
            padding:0.5vmax 0 0 1vmax;
            top: 0;
        }
        .body1 {            
            margin-left: 20px;
            padding-top: 40px;
        }
        .body1 input{
            width: 70%;
            height: 30px;
        }
        .button {
            padding: 10px 0 10px 0;
            height: 40px;
            background-color:rgb(176, 172, 172);
            display: flex;
            justify-content: space-evenly;
            margin-top: auto;
        }
        button a{
            text-decoration: none;
            color: black;
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
        #num{
            width:30px;
            margin: 0 8px 0 8px;
        }
        table{
            width:39vmax;
        }       
        .first_col{
            width:60px;
        } 

    </style>
</head>
<body>
    <div id="gap"></div>
    <div id="container">
        <form  action="" id="manage-category" method="post"> 
        <?php if(isset($error)){ ?>
        <p style="color: red; font-size: 20px; font-family:cursive"><?php echo $error ?></p>
         <?php } ?>
         <?php if(isset($success)){ ?>
    <p style="color: green; font-size: 20px; font-family:cursive"><?php echo $success ?></p>
  <?php } ?>    
        <div class="left">
            <div class="category">Category Form</div>
            <div class="body1">
                <label>Name</label><br>
                <input type="text" id="name" name="name" placeholder="Enter category name" value="<?php echo isset($row['name'])?$row['name']:''?>"><br>
                    <?php
                    if(isset($err['name'])){?>
                    <span style="color: red;"><?php echo $err['name'] ?></span>
                    <?php } ?>
            </div>            
            <div class="button">
                <button type="submit" name="btnUpdate">Update</button>
                <button>cancel</button>
            </div>
        </div>
        </form>
        <div class="right">
            <div class="category">Category List</div>
            <div>
                <?php if(isset($_GET['msg'])&& $_GET['msg']==1){?>
                    <p>Invalid request</p>
               <?php } ?>
               <?php if(isset($_GET['msg'])&& $_GET['msg']==2){?>
                    <p>deleted successfully</p>
               <?php } ?>
               <?php if(isset($_GET['msg'])&& $_GET['msg']==3){?>
                    <p>Unable to delete</p>
               <?php } ?>
            </div>
            <div class="body_1">
                <div>
                Show<select name="num" id="num">
                    <option></option>
                    <option>5</option>
                    <option>10</option>
                </select>entries
                </div>
                <h4>search<input type="text"></h4>
             </div>
            <table border="1">
                <thead>
                    <tr>
                        <th class="text-center first_col">SN</th>
                        <th class="text-center" style="width: 280px;">Category</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include 'db_connect.php';
                    $sql="SELECT * FROM `house_categories`";
                    $result=$conn->query($sql);
                    $data=[];
                    if($result->num_rows>0){
                        while($row=$result->fetch_assoc()){
                            array_push($data,$row);
                        }
                    }        
                 ?>
                 <?php
                 if(count($data)>0){ ?>  
                 <?php foreach($data as $key=> $record){?>                             
                    <tr>
                        <td class="text-center"><?php echo $key+1;?></td>
                        <td class=""><?php echo $record['name'] ?></td>
                        <td class="text-center">
                            <button><a href="houseType_edit.php?id=<?php echo $record['id']?>">Edit</a></button>
                            <button><a href="houseType_delete.php?id=<?php echo $record['id']?>" onclick="return confirm('Are you sure to delete?')">Delete</a></button>
                        </td>
                    </tr>
                    <?php } ?>
                    <?php } else{ ?>
                        <tr>
                            <td colspan="3">No categories found into databases</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>
