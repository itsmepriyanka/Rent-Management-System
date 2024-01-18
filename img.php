
<?php
function inputFields($placeholder,$name,$value,$type){
  $ele="
  <div class=\"form-group\">      
      <input type='$type' class=\"form-control\" placeholder='$placeholder' name='$name' value='$value'>
  </div>
  ";
  echo $ele;
}
?>