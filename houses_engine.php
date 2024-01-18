    <?php
    $err=[];
    if(isset($_POST['house_no']) && !empty($_POST['house_no']) && trim($_POST['house_no'])){
      $house_no = $_POST['house_no'];
    }else{
      $err['house_no']= "Please enter House no";
    } 
    if(isset($_POST['category_id']) && !empty($_POST['category_id']) && trim($_POST['category_id'])){
        $category_id = $_POST['category_id'];
      }else{
        $err['category_id']= "Please choose category name";
      } 
    if(isset($_POST['location']) && !empty($_POST['location']) && trim($_POST['location'])){
        $location = $_POST['location'];
      }else{
        $err['location']= "Please enter location";
      } 
      if(isset($_POST['description']) && !empty($_POST['description']) && trim($_POST['description'])){
        $description = $_POST['description'];
      }else{
        $err['description']= "Please enter descriptio";
      }  
      if(isset($_POST['price']) && !empty($_POST['price']) && trim($_POST['price'])){
        $price = $_POST['price'];
      }else{
        $err['price']= "Please enter price";
      }
      if(isset($_POST['longitude']) && !empty($_POST['longitude']) && trim($_POST['longitude'])){
        $longitude =(float) $_POST['longitude'];
      }else{
        $err['longitude']= "Please enter longitude";
      }
      if(isset($_POST['latitude']) && !empty($_POST['latitude']) && trim($_POST['latitude'])){
        $latitude =(float) $_POST['latitude'];
      }else{
        $err['latitude']= "Please enter latitude";
      }      
        $electricity = isset($_POST['electricity']) ? 1 : 0;
        $parking = isset($_POST['parking']) ? 1 : 0;
        $internet = isset($_POST['internet']) ? 1 : 0;
        $drinking_water = isset($_POST['drinking_water']) ? 1 : 0;
        $security = isset($_POST['security']) ? 1 : 0;

      if(isset($_FILES['image']))
      {
         $image='images/'.$_FILES['image']['name'];
  
     if(!empty($_FILES['image'])){
      $path = "images/";
      $path=$path. basename($_FILES['image']['name']);
          if(move_uploaded_file($_FILES['image']['tmp_name'], $path))
          {
              echo"The file ". basename($_FILES['image']['name']). " has been uploaded";
          }
  
          else{
              echo "There was an error uploading the file, please try again!";
          }
        }
        else{
       
          $err['image']= "Please choose image";
        } 
        }
  
      
      ?>