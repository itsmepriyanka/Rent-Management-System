

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
.content {
    margin-right: 80px;
    margin-left: 280px;
    height: 400px;
    display: grid;
    grid-template-columns: auto auto auto;
    justify-content: space-evenly;
    background-color: aliceblue;
    padding: 10px;
    border-radius: 0.5rem;
}

.item1 {   
    margin: auto;
    background-color: grey;
    width: 20vmax;
    height: 12.5vmax;
}

.item2 {
    margin: auto;
    background-color: grey;
    width: 20vmax;
    height: 12.5vmax;
}

.item3 {
    margin: auto;
    background-color: grey;
    width: 20vmax;
    height: 12.5vmax;
}

.view {
    margin-top: 30px;
    height: 50px;
    background-color: rgb(244, 248, 248);
    bottom: 0;
    border: 0.5px #6e0cd6 solid;
    display: flex;
    justify-content: center;
    align-items: center;
}

.view a {
    text-decoration: none;
}
.box{
    display: flex;
    justify-content: space-evenly;
}

.logo {
    display: flex;
    justify-content: flex-end;
    width: 150px;
    height: 100px;  
    z-index: 1;
    align-items: center;
}

.pic {
    color: white;
    height: 80px;
    width: 80px;
    margin-right: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 80px;
}
.text-content{
    font-size: 1.14vmax;
    color: white;
    width: 8vmax;
    height: 4vmax;
    margin-top: 4.57vmax;
    padding-top: 10px;
    padding-left: 10px;
}
@media only screen and (max-width: 1000px) {
    .content {
    display: grid;
    grid-template-rows: auto auto auto;
    /* justify-content: space-evenly; */
    background-color: whitesmoke;
    padding: 10px;
    border-radius: 0.5rem;
}
}


</style>

<?php include('common.php'); ?>
<?php 
include('db_connect.php');
$queryHouses = "SELECT COUNT(*) as house_count FROM houses";
$resultHouses = $conn->query($queryHouses);

$queryTenants = "SELECT COUNT(*) as tenant_count FROM tenants";
$resultTenants = $conn->query($queryTenants);

$queryTotalPayments = "SELECT SUM(amount) as total_payment FROM payments"; // Adjust the query to match your payment table structure
$resultTotalPayments = $conn->query($queryTotalPayments);

$rowHouses = $resultHouses->fetch_assoc();
$houseCount = $rowHouses['house_count'];

$rowTenants = $resultTenants->fetch_assoc();
$tenantCount = $rowTenants['tenant_count'];

$rowTotalPayments = $resultTotalPayments->fetch_assoc();
$totalPayment = $rowTotalPayments['total_payment'];


?>

<div id="dashboard">    
    <div class="body">
        <div class="content">
            <div class="item1">
                <div class="box">
                    <div class="text-content"><?php echo $houseCount ?><br><br>Total Houses</div>
                    <div class="logo">
                        <div class="pic"><i class="fa fa-home"></i></div>
                    </div>
                </div>                
                <div class="view"><a href="houses.php"><b>View List <span class="fa fa-angle-right"></span></b></a></div>
            </div>
            <div class="item2">
                <div class="box">
                    <div class="text-content"><?php echo $tenantCount ?><br><br>Total Tenants</div>
                    <div class="logo">
                        <div class="pic"><i class="fa fa-users friends"></i></div>
                    </div>
                </div>
                <div class="view"><a href="tenant.php"><b>View List <span class="fa fa-angle-right"></span></b></a></div>
            </div>
            <div class="item3">
            <div class="box">
                    <div class="text-content">Rs.<?php echo number_format($totalPayment, 2); ?><br><br>Total Payments</div>
                    <div class="logo">
                        <div class="pic"><i class="fa fa-file-text-o report"></i></div>
                    </div>
                </div>  
                <div class="view"><a href="payment.php"><b>View List <span class="fa fa-angle-right"></span></b></a></div>
            </div>
        </div>
    </div> 
</div>
