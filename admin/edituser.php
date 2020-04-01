
    <?php require_once("header.php");?>
       <!--- add User -->
       <?php
              $admin = new Admin();
              
              if(isset($_REQUEST['id'])){
                $id =$_REQUEST['id'];
            }
            $sql= "select * from user where id =  $id";
          $readmore =  $admin->readmore($sql);
            $row = mysqli_fetch_assoc($readmore);
            // update user 
            if(isset($_REQUEST['edituser'])){
                $name =$_REQUEST['name'];
                $username = $_REQUEST['username'];
                $role = $_REQUEST['role'];
                $password = $_REQUEST['password'];

                $id = $_REQUEST['id'];
                $sql = " UPDATE user SET name ='$name', username ='$username', role ='$role', password = '$password' WHERE id = ''";
               $updateUser =  $admin->updateUser($sql, $id);
            }

            ?>
       
                     <div class="container">
                     <div class="row">
                     
                     <div class="col-md-8 offset-md-4 mt-5">
                     
                   <?php if(isset($updateUser)){echo "
                  <div class='alert alert-success alert-dismissible fade show mb-5' role='alert'>
                  <strong>Update </strong> successfuly !
                  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                  </button>
                </div>
                   "; }?>
                   
                     <form class="form-horizontal" method="post" action="">

<div class="form-group pt-3">

    <label for="name" class="cols-sm-2 control-label">Your Full Name</label>
    <div class="cols-sm-10">
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
            <input type="text" class="form-control" value="<?= $row['name']?>" name="name" id="name" placeholder="Enter Full your Name" />
        </div>
    </div>
</div>

<div class="form-group pt-3">
    <label for="username" class="cols-sm-2 control-label">Username</label>
    <div class="cols-sm-10">
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-users fa" aria-hidden="true"></i></span>
            <input type="text" class="form-control" value="<?= $row['username']?>" name="username" id="username" placeholder="Enter your Username" />
        </div>
    </div>
</div>
<div class="form-group pt-3">
    <label for="password" class="cols-sm-2 control-label">Password</label>
    <div class="cols-sm-10">
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
            <input type="text" class="form-control" name="password" value="<?= $row['password']?>" id="password" placeholder="Enter your Password" />
        </div>
    </div>
</div>
<div class="form-group col-sm-6 offset-md-3 pb-5 mb-3">
    <label for="password" class="cols-sm-2 control-label">ROLE</label>
    <div class="role" >
        <select name="role" id="" class="form-control">

          <option <?= $row['role']==1?'selected':''?> value="1">ADMIN</option>
          <option <?= $row['role']==0?'selected':''?> value="0">subscriber</option>
        </select>
    </div>
</div>


<div class="form-group ">
    <button type="submit" class="btn btn-primary btn-lg btn-block login-button" name="edituser">Update User</button>
</div>
</form>
                     </div>
                     </div>
                     </div>
      <?php require_once("footer.php");?>