
    <?php require_once("header.php");?>
       <!--- add User -->
       <?php
              spl_autoload_register(function($classes){
              require_once('class/'. $classes .'.php');
            
              });
              $admin = new Admin();
              if (isset($_REQUEST['update'])) {
                  $data = $_REQUEST;
                $update=  $admin->update($data);
              }
              if(isset($_REQUEST['id'])){
                  $id =$_REQUEST['id'];
              }
              $sql= "select * from post where post_id =  $id";
            $readmore =  $admin->readmore($sql);
              $row = mysqli_fetch_assoc($readmore);
              ?>
                     <div class="container">
                     <div class="row">
                    
    <div class="col-md-8 offset-md-4 mt-5">
        <!-- update massage-->
    <?php if(isset($update)){echo "<div class='alert alert-success alert-dismissible fade show my-4 ' role='alert'>
                  <strong>Update </strong> successfuly !
                  <button type='button' class='close' data-dismiss='alert' aria-label='Close '>
                    <span aria-hidden='true'>&times;</span>
                  </button>
                </div>";}?> 
    
  <form class="form-horizontal" method="post" action="" enctype="multipart/form-data">

<div class="form-group pt-3">
    <label for="post_title" class="cols-sm-2 control-label">Title</label>
    <div class="cols-sm-10">
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
            <input type="text" value="<?= $row['post_title']?>" class="form-control" name="post_title" id="post_title" placeholder="Enter Product Title" />
        </div>
    </div>
</div>
<div class="input-group my-3">
  <div class="input-group-prepend">
    <span class="input-group-text" id="inputGroupFileAddon01"></span>
  </div>
  <div class="custom-file">
    <input type="file"  name="postImg" class="custom-file-input" id="inputGroupFile01"
      aria-describedby="inputGroupFileAddon01">
    <label class="custom-file-label" for="inputGroupFile01"><span class="material-icons" style="font-size: 20px; margin:-51px ">
perm_media
</span></label>
  </div>
</div>
<div class="form-group pt-3">
    <label for="m_one" class="cols-sm-2 control-label">Market One Price</label>
    <div class="cols-sm-10">
        <div class="input-group">
        <span class="input-group-addon"><i class="fa fa-money"></i></span>
            <input value="<?= $row['m_one']?>" type="text" class="form-control" name="m_one" id="m_one" placeholder="Enter Market One Price"/>
        </div>
    </div>
</div>
<div class="form-group pt-3 my-3">
    <label for="m_tow" class="cols-sm-2 control-label">Market Two Price</label>
    <div class="cols-sm-10">
        <div class="input-group">
        <span class="input-group-addon"><i class="fa fa-money"></i></span>
            <input type="text" value = "<?= $row['m_tow'] ?>" class="form-control" name="m_tow" id="m_tow" placeholder="Enter Market Tow Price"/>
        </div>
    </div>
</div>
<div class="form-group pt-3">
    <label for="m_three" class="cols-sm-2 control-label">Market Three Price</label>
    <div class="cols-sm-10">
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-money"></i></span>
            <input type="text" value="<?= $row['m_three']?>" class="form-control" name="m_three" id="m_three" placeholder="Enter Market Three Price"/>
             <input type="hidden" name="post_id" value="<?= $row['post_id']?>">
        </div>    
    </div>
</div>
<div class="form-group ">
    <button type="submit" class="btn btn-primary btn-lg btn-block login-button" name="update">update</button>
</div>

</form>
                     </div>
                     </div>
                     </div>
      <?php require_once("footer.php");?>