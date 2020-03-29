<?php
    session_start();
    include 'header.php';
    include 'menu_compare.php';
?>
<?php


if(isset($_SESSION['array'])){

    $array= $_SESSION['array'];

     
if($array == null){
    session_unset();
     session_destroy();
 }else{
     $_SESSION['array']= $array;
 }
     $data ="";
     for($x=0; $x<count($array); $x++){
     
         if($x == count($array)-1){
            $data .= $array[$x];
         }else{
            $data .= $array[$x].',';
         }
     }
    
    
    // sql connection 
    spl_autoload_register(function($classes){
        require_once('admin/class/'. $classes .'.php');
        });
      
      $admin = new Admin;
      $query = "select * from post where post_id in ($data)";
      $output = $admin->readmore($query);

?>


    <!-- Popular Products -->
    <section class="light-gray-bg padding-top-150 padding-bottom-150">
      <div class="container"> 
        
        <!-- Main Heading -->
        <div class="heading text-center">
          <h4>YOUR SELECTED PRODUCT </h4>
        
        <!-- Popular Item Slide -->
        <div class="papular-block block-slide"> 

        <?php
        
        while($op= mysqli_fetch_assoc($output)){
        ?>
          
          <!-- Item -->
          <div class="item"> 
            <!-- Item img -->
            <div class="item-img"> <img class="img-1" src="<?php echo 'upload/'.$op['post_img'];?>" alt="" > <img class="img-2" src="<?php echo 'upload/'.$op['post_img'];?>" alt="" > 
              <!-- Overlay -->
              <div class="overlay">
                <div class="position-center-center">
                  <div class="inn"><a href="<?php echo 'upload/'.$op['post_img'];?>" data-lighter><i class="icon-magnifier"></i></a> <a href="#."><i class="icon-basket"></i></a> </div>
                </div>
              </div>
            </div>
            <!-- Item Name -->
            <div class="item-name"> <a href="#"><?php echo 'upload/'.$op['post_title'];?></a>
            </div>
            </div>

        <?php } ?>

      </div>
    </section>



<?php 
} 

include 'footer.php';

?>

