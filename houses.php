<?php include('common.php'); ?>
<?php include("img.php"); ?>
<?php
$image = '';

if (isset($_POST['btnSave'])){
    include('houses_engine.php');
    if(count($err)==0){
        try{
      require_once 'db_connect.php';
      $sql="INSERT INTO `houses`(house_no,category_id,description,price,location,longitude,latitude,image,electricity,parking,internet,drinking_water,security) VALUES ('$house_no','$category_id','$description','$price','$location','$longitude','$latitude','$path','$electricity','$parking','$internet','$drinking_water','$security')";
      $conn->query($sql);
      if($conn->affected_rows==1 && $conn->insert_id > 0){
        $success="Data successfully inserted";
      }else{
        $error= "Data inserted failed";
      }
    }catch (Exception $e) {
        $error = "An error occurred: " . $e->getMessage();
    }
}

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        #gap {
            width: 100%;
            height: 5vmax;
        }

        .container {
            margin: 0px 10px 0 20vmax;
            display: flex
        }

        table {
            border-collapse: collapse;
        }

        .first-enter {
            width: 300px;
            margin: 30px;
            height: 80%;
        }

        .second-list {
            background-color: aliceblue;
            padding: 0 0 30px 0;
            width: 45vmax;
            margin: 30px;
            height: 80%;
        }

        .form {
            background-color: rgb(176, 172, 172);
            padding: 10px;
        }

        .list {
            background-color: aliceblue;
        }

        .list label,
        .list input,
        .list select {
            margin: 10px;
            height: 30px;
            width: 17vmax;
        }

        button {
            color: black;
        }

        button a {
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

        .button button {
            width: 80px;
            border-radius: 10px;
        }

        .button button:hover {
            background-color: #6e0cd6;
            color: white;
        }

        .body_1 {
            display: flex;
            justify-content: space-between;
            padding: 10px 20px 0 20px;
            font-size: large;
        }

        h5 {
            margin-top: 0;
        }

        .box {
            width: 15vmax;
        }

        table {
            width: 37vmax;
        }

        .house {
            width: 23vmax;
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
            <?php if (isset($error)) { ?>
                <p style="color: red; font-size: 20px; font-family:cursive"><?php echo $error ?></p>
            <?php } ?>
            <?php if (isset($success)) { ?>
                <p style="color: green; font-size: 20px; font-family:cursive"><?php echo $success ?></p>
            <?php } ?>
            <div class="form">House Form</div>
            <form action="houses.php" method="post" enctype="multipart/form-data">
                <div class="list">
                    <br><label>House No</label><br>
                    <input type="text" name="house_no">
                    <?php
                    if (isset($err['house_no'])) { ?>
                        <span style="color: red;"><?php echo $err['house_no'] ?></span>
                    <?php } ?><br>
                    <label>Category</label><br>
                    <select name="category_id" id="" class="custom-select">
                        <option value=""></option>
                        <?php
                        include 'db_connect.php';
                        $categories = $conn->query("SELECT * FROM `house_categories` order by name asc");
                        if ($categories->num_rows > 0) :
                            while ($row = $categories->fetch_assoc()) :
                        ?>
                                <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
                            <?php endwhile; ?>
                        <?php else : ?>
                            <option selected="" value="" disabled="">Please check the category list.</option>
                        <?php endif; ?>
                    </select>
                    <?php
                    if (isset($err['category_id'])) { ?>
                        <span style="color: red;"><?php echo $err['category_id'] ?></span>
                    <?php } ?>
                    <br>
                    <label>Location</label><br>
                    <input type="text" name="location">
                    <?php
                    if (isset($err['location'])) { ?>
                        <span style="color: red;"><?php echo $err['location'] ?></span>
                    <?php } ?><br>
                    <label>longitude</label><br>
                    <input type="text" name="longitude">
                    <?php
                    if (isset($err['longitude'])) { ?>
                        <span style="color: red;"><?php echo $err['longitude'] ?></span>
                    <?php } ?><br>
                    <label>latitude</label><br>
                    <input type="text" name="latitude">
                    <?php
                    if (isset($err['latitude'])) { ?>
                        <span style="color: red;"><?php echo $err['latitude'] ?></span>
                    <?php } ?><br>
                    <label>Description</label><br>
                    <input type="text" name="description">
                    <?php
                    if (isset($err['description'])) { ?>
                        <span style="color: red;"><?php echo $err['description'] ?></span>
                    <?php } ?><br>
                    <label>Price</label><br>
                    <input type="number" name="price">
                    <?php
                    if (isset($err['price'])) { ?>
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
                    <label for="card_photo">Upload image</label>
                    <input type="file" class="form-control" placeholder="Upload image" name="image" accept="images/*">
                    <?php
                    if (isset($err['image'])) { ?>
                        <span style="color: red;"><?php echo $err['image'] ?></span>
                    <?php } ?>

                    <div class="button">
                        <button type="submit" name="btnSave">Save</button>
                        <button>cancel</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="second-list">
            <div class="form">House List</div>
            <div class="body_1">
             
                <h5>search<input type="text" id="myInput" placeholder="search....." onkeyup="searchFun()"></h5>
            </div>
            <div class="card-body">
                <table border="1" id="myTable">
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
                        $house = $conn->query("SELECT h.*,c.name as cname FROM houses h join house_categories c on c.id = h.category_id order by id asc");
                        while ($row = $house->fetch_assoc()) :
                         
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
                                <td>
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
    <script>
        const searchFun = () => {
            const filter = document.getElementById('myInput').value.toUpperCase();
            let myTable = document.getElementById('myTable');
            let tr = myTable.getElementsByTagName('tr');
            for (let i = 0; i < tr.length; i++) {
                let td = tr[i].getElementsByTagName('td')[1];
                if (td) {
                    let textValue = td.textContent || td.innerHTML;
                    if (textValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>
</body>

</html>