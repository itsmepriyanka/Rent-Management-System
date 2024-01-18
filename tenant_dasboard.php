<?php
session_start();
if(!isset($_SESSION['tenant_id'])){
  header('location:tenant_login.php?err=1');
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>User Dashboard</title>
    <style>
.dashboard-container {
    width: 100%;
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
}
.top-right {
    text-align: right;
    background-color: rgb(191, 34, 199);
    padding: 20px;
}
.profile-link,
.logout-link {
    margin-left: 10px;
    text-decoration: none;
    color: whitesmoke;
}
.content {
    margin-left: 160px;
}
h2,
h3 {
    margin-bottom: 10px;
}
.house-gallery {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
}
.house-card {
    margin: 10px;
    padding: 10px;
    width: 300px;
    border: 1px solid #ccc;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
}
.house-card img {
    width: 100%;
    height: 200px;
    object-fit: cover;
}
.house-details {
    margin-top: 20px;
}
#map {
    height: 400px;
    width: 100%;
    margin-top: 20px;
}
.btnDisabled{
    pointer-events: none;
    opacity: 0.3;
}

</style>
<?php
  require_once 'db_connect.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve longitude and latitude data from your table (replace 'your_table' with your actual table name)
$sql = "SELECT h.*,c.name as cname FROM houses h inner join house_categories c on c.id = h.category_id order by id asc";
$result = $conn->query($sql);

// Fetch all rows and store them in an array
$houses = array();
while ($row = $result->fetch_assoc()) {
    $houses[] = $row;
}

$conn->close();

?>
</head>
<body>
   <?php
   include('nav_tenant.php');
   ?>
   <div class="content">
            <h2>Welcome, <?php  echo $_SESSION['tenant_name']?></h2>
        </div>

        

    <div class="house-gallery">
    <?php foreach($houses as $house){?>
     <div class="house-card">
       <img src="<?php echo $house['image'];?>" alt="">
       <div class="house-details">
       <h3> <?=$house['house_no']?></h3>
       <p>Category: <?= $house['cname']?> </p>
       <p>Description:  <?=$house['description']?> </p>
       <p>Price: Rs. <?=$house['price']?></p>
       <p class="location">Location: <?=$house['location'] ?></p>           
       </div><a href="houseouter_view.php?id=<?php echo $house['id'];?>"><button>View</button></a>
       <?php if($house['availability']==0){?>
        <a href="" class="btnDisabled"><button>Booked</button></a>
        <?php }else{?>
    <a href="update_house.php?id=<?php echo $house['id'];?>" onclick="return confirm('Are you sure you want to book this?  Once you booked cannot be cancled!');"><button class="book-button" data-house-id="<?php echo $house['id']; ?>">Book</button></a>

    <?php }?> 
</div>
       <?php }?>
    </div>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const bookButtons = document.querySelectorAll('.book-button');

        bookButtons.forEach((button) => {
            button.addEventListener('click', function () {
                const houseId = this.getAttribute('data-house-id');

                // Send an AJAX request to book the house
                const xhr = new XMLHttpRequest();
                xhr.open('POST', 'book_house.php', true);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        // Handle the server's response (success or failure)
                        const response = xhr.responseText;
                        // if (response === 'success') {
                        //     // Handle success (e.g., show a success message)
                        //     alert('Booking successful!');
                        // } else {
                        //     // Handle failure (e.g., show an error message)
                        //     alert('Booking failed. Please try again.');
                        // }
                    }
                };

                // Send data to the server (you can send tenant and house IDs as POST parameters)
                xhr.send('tenant_id=<?php echo $_SESSION['tenant_id']; ?>&house_id=' + houseId);
            });
        });
    });
</script>

</body>
</html>