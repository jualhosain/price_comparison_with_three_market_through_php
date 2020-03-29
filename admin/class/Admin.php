<?php

class Admin extends Db{ 
   // add user 
   public function addUser($data){
      $name = $data['name'];
      $username= $data['username'];
      $role= $data['role'];
      $password= $data['password'];
     // $password = md5(sha1($password));
      $sql = "INSERT INTO `user`(`name`, `username`, `role`, `password`) VALUES ('$name','$username','$role', '$password')";
      $query = mysqli_query($this->conn,$sql);
     
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


   

} 
?>