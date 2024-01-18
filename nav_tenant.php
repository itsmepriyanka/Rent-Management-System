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
.active_link{
  background-color: black;
}
</style>
<div class="dashboard-container">
        <div class="top-right">
            
        <a href="tenant_dasboard.php"  class="profile-link">Home</a>
            <a href="tenant_profile.php" class="profile-link">My Profile</a>
            <a href="tenant_booking.php" class="profile-link">My bookings</a>
            <a href="tenant_payment.php" class="profile-link">My Payments</a>
            <a href="logout.php" class="logout-link">Logout</a>
        </div>        
    </div>