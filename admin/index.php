<?php
require_once('header.php');

$admin = new Admin();

?>

<div class="container">
  <div class="row">
    <!-- manage user -->
    <div class="col-md-10 offset-md-2">
      
    
    
      <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title ">manage user</h4>
                  <p class="card-category"> Here you can manage of all user</p>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table">
                    <thead class="text-primary">
          <?php
              $query = 'select * from user';
              $output = $admin->readmore($query);
              ?>
          <?php if(mysqli_num_rows($output)>0){
            echo  "<th>S.N</th>";
            echo   "<th>Name</th>";
            echo "<th>user name</th>";
             echo " <th>role</th>";
             echo" <th>Action</th>";
            }else{
              echo "<h3 class='text-center'>There is no post</h3>";
            } ?>
        </thead>
                      <tbody>
                      <?php
    
    $sn = 0;
    while($alluser = mysqli_fetch_array($output)){ $sn++; ?>
         <tr>

           <td><?= $sn; ?></td>
           <td><?= $alluser['name']?></td>
           <td><?=  $alluser['username']?></td>
           <td><?php if($alluser['role']==0){echo "subscrib";}else{echo "admin";}?></td>

           <td><a class="btn btn-sm" href="edituser.php?id=<?= $alluser['id']?>" id="editPost" post-id="<?= $allRow['post_id']?>"
               data-toggle="tooltip" data-placement="bottom" title="edit!"><i class="fa fa-pencil-square-o"
                 aria-hidden="true"></i>
             </a>
             <a class="btn btn-sm" href="javascript:void(0)" id="deleteuser" user-id="<?= $alluser['id']?>" data-toggle="tooltip"
               data-placement="bottom" title="Delete!"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
         </tr>

         <?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
      <!-- manage user end -->
     

    </div>
  </div>
</div>
<!-- manage post start-->
<div class="container">
  <div class="row">
  <div class="col-md-10 offset-md-2">
  <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title ">manage post</h4>
                  <p class="card-category"> Here you can manage of all post</p>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table">
                    <thead class="text-primary">

        <thead>
          <?php
          $query = 'select * from post';
          $output = $admin->readmore($query);
          
          if(mysqli_num_rows($output)>0){
            echo  "<th>S.N</th>";
            echo   "<th>Product Name</th>";
            echo "<th>image</th>";
              echo"<th>price M1</th>";
             echo " <th>price M2</th>";
             echo" <th>price M3</th>";
             echo" <th>Action</th>";
            }else{
              echo "<h3 class='text-center'>There is no post</h3>";
            } ?>
        </thead>

        <tbody>
          <?php
    
          $sn = 0;
          while($allRow = mysqli_fetch_array($output)){ $sn++; ?>
                <tr>

            <td><?= $sn; ?></td>
            <td><?= $allRow['post_title']?></td>
            <td><img src="<?= '../upload/'.$allRow['post_img']?>" alt="" height="50px" width="60px"></td>
            <td><?= "$". $allRow['m_one']?></td>
            <td><?= "$". $allRow['m_tow']?></td>
            <td><?= "$". $allRow['m_three']?></td>
            <td><a href="editpost.php?id=<?= $allRow['post_id']?>" class="btn btn-sm" id="editPost" post-id="<?= $allRow['post_id']?>"
                data-toggle="tooltip" data-placement="bottom" title="edit!"><i class="fa fa-pencil-square-o"
                  aria-hidden="true"></i>
              </a>
              <a href="javascript:void(0)" class="btn btn-sm" id="deletepost" post-id="<?= $allRow['post_id']?>" data-toggle="tooltip"
                data-placement="bottom" title="Delete!"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
          </tr>

          <?php } ?>

        </tbody>
      </table>
      </div>
                </div>
              </div>
            </div>
          </div>
  </div>
          </div>
<!--manage post end-->
<?php require_once("footer.php"); ?>
<script>
  $("tbody").on('click', '#deletepost', function () {
    var confmag = confirm("Do you want to delete");
    if (confmag == true) {
      var postId = $(this).attr('post-id');

      $.post("dt.php", {
          postId: postId
        }

      );

      $(this).closest('tr').remove();
    }
  });
  $("tbody").on('click', '#deleteuser', function () {
    var confmag = confirm("Do you want to delete");
    if (confmag == true) {
      var userId = $(this).attr('user-id');

      $.post("dt.php", {
          userId: userId
        }

      );

      $(this).closest('tr').remove();
    }
  });
</script>