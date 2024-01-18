 <style>
   body,
   html {
     height: 100%;
     margin: 0;
   }

   .bg {
     background-image: url("images/house3.jpg");
     height: 60%;
     background-position: bottom;
     background-repeat: no-repeat;
     background-size: cover;
   }

   .active-cyan-4 input[type=text] {
     border: 1px solid #4dd0e1;
     box-shadow: 0 0 0 1px #4dd0e1;
   }
 </style>
 <?php
  session_start();

  include("nav.php");

  ?>


 <div class="bg"></div>

 <?php

  include("map.php");

  ?>
 <br><br>