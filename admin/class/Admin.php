<?php

class Admin extends Db{ 
   // add user 
   public function addUser($data){
      $name = $data['name'];
      $username= $data['username'];
      $role= $data['role'];
      $password= $data['password'];
      
      $sql = "INSERT INTO `user`(`name`, `username`, `role`, `password`) VALUES ('$name','$username','$role', '$password')";
      $query = mysqli_query($this->conn,$sql);
      return $query;
     
   }
   
   public function readmore($query){
      $result = mysqli_query($this->conn, $query);
      return $result;
   }



   // log in function
   public function logIn($data){
    $username = $data['username'];
   $password= $data['password'];
  // $password = md5(sha1($password));
   if(empty($username) or empty($password)){
       header('Location:login.php?error');
   }else{

    $ins_run = mysqli_query($this->conn,"SELECT * FROM user WHERE username='$username' AND password ='$password'");
    $count_row = mysqli_num_rows($ins_run);
    if($count_row===1){
    $row = mysqli_fetch_assoc($ins_run);
    $username =$row['username'];
    setcookie('name',$username, time()+60*60*365);
    header('location:index.php');
}else{
    header('location:login.php?log_err');
}}
   } 
   // Add post/ product 
  public function addPost($data){
  $post_title = mysqli_real_escape_string($this->conn, $data['post_title']);
  $m_one = mysqli_real_escape_string($this->conn, $data['m_one']);
  $m_tow =mysqli_real_escape_string($this->conn,  $data['m_tow']);
  $m_three =mysqli_real_escape_string($this->conn,  $data['m_three']);
  $post_author = $_COOKIE['name'];

$fileName = $_FILES['postImg']['name'];
$fileType = $_FILES['postImg']['type'];
$tmpName = $_FILES['postImg']['tmp_name'];
$fileError = $_FILES['postImg']['error'];
$fileSize = $_FILES['postImg']['size'];

  if(empty($post_title) or empty($m_one) or empty($m_tow) or empty($m_three)){
     header('location:post.php?empty_err');
  }else{
     //check image
if($fileName==null){
   $sql = "INSERT INTO `post`( `post_title`,`m_one`, `m_tow`, `m_three`, `post_author`) VALUES
                       ('$post_title', '$m_one', '$m_tow','$m_three','$post_author')";
                       $query = mysqli_query($this->conn, $sql);
                       // check query
                       if($query==true){header("location:post.php?success");}else{
                          echo"post field!". mysqli_errno($this->conn);
                       }
}else{
   $expName = explode('.', $fileName);
   $expName = end($expName);
   $fileName = uniqid().".".$expName;
   $upload = move_uploaded_file($tmpName, '../upload/'.$fileName);
   $sql = "INSERT INTO `post`( `post_title`,`post_img`, `m_one`, `m_tow`, `m_three`, `post_author`) VALUES
                       ('$post_title', '$fileName', '$m_one', '$m_tow','$m_three','$post_author')";
                       $query = mysqli_query($this->conn, $sql);
                       
                       // check query
                       if($query){
                          header('location:post.php?post_success');
                       }


}} } 


 public function addTocompare($data){
  
  $postTitle = $data['postTitle'];
  $postImg =$data['postImg'];
  $mOne = $data['mOne'];
  $mTow = $data['mTow'];
  $mThree = $data['mThree'];
  $sessionId = $data['sessionId'];
  $postId = $data['postId'];
  $sql ="SELECT * FROM `compare` WHERE `session_id`='$sessionId' AND `post_id`=$postId";
  $query= mysqli_query($this->conn, $sql);
  $countRow = mysqli_num_rows($query);
  if($countRow<1){
   $sql = "INSERT INTO `compare`(`post_title`, `post_img`, `m_one`, `m_tow`, `m_three`, `session_id`, `post_id`) VALUES ('$postTitle', '$postImg', $mOne, $mTow, $mThree,'$sessionId', $postId)";
   $query = mysqli_query($this->conn, $sql);
  }else{
     return "yutodfas";

  }
 
 }
 // delete post
public function deletePost($sql){
   $query = mysqli_query($this->conn, $sql);

}
// update post 

   public function update($data){
      $post_title = mysqli_real_escape_string($this->conn, $data['post_title']);
      $m_one = mysqli_real_escape_string($this->conn, $data['m_one']);
      $m_tow =mysqli_real_escape_string($this->conn,  $data['m_tow']);
      $m_three =mysqli_real_escape_string($this->conn,  $data['m_three']);
      
      $post_id =$data['post_id'];
    
    $fileName = $_FILES['postImg']['name'];
 //   $fileType = $_FILES['postImg']['type'];
    $tmpName = $_FILES['postImg']['tmp_name'];
  //  $fileError = $_FILES['postImg']['error'];
   // $fileSize = $_FILES['postImg']['size'];
    
      if(empty($post_title) or empty($m_one) or empty($m_tow) or empty($m_three)){
         header('location:post.php?empty_err');
      }else{
         //check image
    if($fileName==null){
       $sql =   $sql = "UPDATE post SET `post_title`='$post_title', `m_one`=$m_one, `m_tow`='$m_tow', `m_three`='$m_three' WHERE post_id='$post_id'";
       $query = mysqli_query($this->conn, $sql);
                           // check query
                           if($query==true){
                              return "data update successfully";
                              header("location:editpost.php?id=".$post_id);}else{
                              echo"post field!". mysqli_errno($this->conn);
                           }
    }else{
       $expName = explode('.', $fileName);
       $expName = end($expName);
       $fileName = uniqid().".".$expName;
       $upload = move_uploaded_file($tmpName, '../upload/'.$fileName);
       $sql = "UPDATE post SET `post_title`='$post_title',`post_img`='$fileName', `m_one`=$m_one, `m_tow`='$m_tow', `m_three`='$m_three' WHERE post_id='$post_id'";
                           $query = mysqli_query($this->conn, $sql);
                           
                           // check query
                           if($query){
                              return "data update successfully";
                              header('location:editpost.php?id='.$post_id);
                           }
    
    
    }} } 
    
public function updateUser($sql, $id){
$query = mysqli_query($this->conn, $sql);
if($query==true){
   return "data update successfuly";
   header("location:edituser.php?id=".$id);
}
}
} 
?>