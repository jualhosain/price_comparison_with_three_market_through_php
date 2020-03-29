
    <?php require_once("header.php");?>
       <!--- add User -->
       <?php
              spl_autoload_register(function($classes){
              require_once('class/'. $classes .'.php');
            
              });
              $admin = new Admin();
              if (isset($_POST['addUser'])) {
                  $data = $_POST;
                  $admin->addUser($data);
              }
              ?>
                     <div class="container">
                     <div class="row">
                     
                     <div class="col-md-8 offset-md-4 mt-5">
                     
                     
                     <form class="form-horizontal" method="post" action="">

<div class="form-group pt-3">
    <label for="name" class="cols-sm-2 control-label">Your Full Name</label>
    <div class="cols-sm-10">
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
            <input type="text" class="form-control" name="name" id="name" placeholder="Enter Full your Name" />
        </div>
    </div>
</div>

<div class="form-group pt-3">
    <label for="username" class="cols-sm-2 control-label">Username</label>
    <div class="cols-sm-10">
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-users fa" aria-hidden="true"></i></span>
            <input type="text" class="form-control" name="username" id="username" placeholder="Enter your Username" />
        </div>
    </div>
</div>
<div class="form-group pt-3">
    <label for="password" class="cols-sm-2 control-label">Password</label>
    <div class="cols-sm-10">
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
            <input type="password" class="form-control" name="password" id="password" placeholder="Enter your Password" />
        </div>
    </div>
</div>
<div class="form-group col-sm-6 offset-md-3 pb-5 mb-3">
    <label for="password" class="cols-sm-2 control-label">ROLE</label>
    <div class="role" >
        <select name="role" id="" class="form-control">
          <option value="" selected >SELECT ROLE</option>
          <option value="1">ADMIN</option>
          <option value="0">subscriber</option>
        </select>
    </div>
</div>


<div class="form-group ">
    <button type="submit" class="btn btn-primary btn-lg btn-block login-button" name="addUser">ADD User</button>
</div>
</form>
                     </div>
                     </div>
                     </div>
      <?php require_once("footer.php");?>