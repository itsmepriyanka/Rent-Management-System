<?php 
include("nav.php");

 ?>


    <section class="container-fluid sign-in-form-section">
        <div class="container">
            <div class="row">
                
                <div class="col-md-12 sign-up" style="text-align: center;">
                    <h3 style="font-weight: bold;">How do you want to Login?</h3><hr>
                    <p>If you want to sign in as a tenant click on tenant login button otherwise click on admin login button.</p><br><br>
                    <button type="submit" class="btn btn-info"  onclick="window.location.href='tenant_login.php'" style="background-color: #6e0cd6;width:200px;">Tenant Login</button>
                    <button type="submit" class="btn btn-info"  onclick="window.location.href='owner_login.php'" style="background-color: #6e0cd6;width:200px;">Admin Login</button>
                </div>
                
            </div>
        </div>
    </section>