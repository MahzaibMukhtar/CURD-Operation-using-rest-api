<?php
 header("Access-Control-Allow-Origin: *");
 header("Content-Type: application/json; charset=UTF-8");
 $data=json_decode(file_get_contents("php://input"),true);
 $id=$data['sid'];
 $conn=mysqli_connect('localhost','shoppingweb','test123','inventory');
 if($conn)
 {
  if(is_null($id))
  {
      $sql="SELECT * FROM list";
      $result=mysqli_query($conn,$sql) or die("Query  Failed");
      if(mysqli_num_rows($result)>0)
      {
        $output=mysqli_fetch_all($result,MYSQLI_ASSOC);
        echo json_encode($output);
      }
       else
      {
        echo json_encode(array('message'=>'NO Record Found','status'=>false));
      }
  }
  else
  {
    $sql="SELECT * FROM list WHERE id={$id}";
      $result=mysqli_query($conn,$sql) or die("Query  Failed");
      if(mysqli_num_rows($result)>0)
      {
        $output=mysqli_fetch_all($result,MYSQLI_ASSOC);
        echo json_encode($output);
      }
       else
      {
        echo json_encode(array('message'=>'NO Record Found','status'=>false));
      }

  }
   
 }
?>