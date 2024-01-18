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

// Close the connection
$conn->close();

// Convert the PHP array to JSON format
$json_data = json_encode($houses);

// Output the JSON data
// echo $json_data;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Houses</title>
    <style>
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
        .container {
            text-align: center;
        }
        .form-control {
            width: 60%;
            margin: 0 auto;
        }
        #btn_view{
            margin-top:10px ;
        }
    </style>
</head>
<body>
<br>
<div class="container">
  <input class="form-control" type="text" placeholder="Enter location to search house." id="myInput" onkeyup="searchFun()" name="search_property" aria-label="Search">
</div>
<br><br>
<div class="house-gallery" id="myTable">
    <!-- // Loop through each house in the $houses array and generate the HTML for each house card -->
    <?php foreach($houses as $house){?>
     <div class="house-card">
       <img src="<?php echo $house['image'];?>" alt="">
       <div class="house-details">
       <h3> <?=$house['house_no']?></h3>
       <p>Category: <?= $house['cname']?> </p>
       <p>Description:  <?=$house['description']?> </p>
       <p>Price: Rs. <?=$house['price']?></p>
       <p class="location">Location: <?=$house['location'] ?></p>  
       <button onclick="showMap(<?php echo $house['latitude']; ?>, <?php echo $house['longitude']; ?>, '<?php echo $house['house_no']; ?>')">Map</button>

       </div ><a href="houseouter_view.php?id=<?php echo $house['id'];?>"><button id="btn_view">View</button></a></div> 
       <?php }?>
</div>
<div id="map"></div>

<script>
        function initMap() {
            console.log("initMap function is called.");
            var map;
            var marker;
            function showMarker(lat, lng, title) {
                if (marker) {
                    marker.setMap(null); 
                }
                marker = new google.maps.Marker({
                    position: {lat: lat, lng: lng},
                    map: map,
                    title: title
                });
                map.setCenter(marker.getPosition());
            }
            window.showMap = function(lat, lng, title) {
                if (!map) {
                    map = new google.maps.Map(document.getElementById('map'), {
                        center: {lat: lat, lng: lng}, 
                        zoom: 12 
                    });
                } else {
                    map.setZoom(12);
                }
                showMarker(lat, lng, title);
            }
        }

        function loadGoogleMapsScript() {
            var script = document.createElement('script');
            script.src = 'https://maps.googleapis.com/maps/api/js?key=AIzaSyAgsWxMdxiugBrwti-GAs8KH3FOKW24c8s&callback=initMap';
            script.async = true;
            script.defer = true;
            document.head.appendChild(script);
        }

        // Load the Google Maps API script dynamically
        loadGoogleMapsScript();
    </script>
    <script>
    const searchFun = () => {
    const filter = document.getElementById('myInput').value.toUpperCase();
    // let myTable = document.getElementById('myTable');
    let houseCards = myTable.getElementsByClassName('house-card');
    for (let i = 0; i < houseCards.length; i++) {
        let location = houseCards[i].querySelector('p.location');
        if (location) {
            let textValue = location.textContent || location.innerText;
            if (textValue.toUpperCase().indexOf(filter) > -1) {
                houseCards[i].style.display = "";
            } else {
                houseCards[i].style.display = "none";
            }
        }
    }
}
</script>
</body>
</html>
