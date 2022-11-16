<?php
session_start();
if(isset($_POST['sub']))
{
    $conn=mysqli_connect('localhost','shoppingweb','test123','datas');
    if($conn)
    {
        echo 2;
        if(isset($_POST['name']))
        {
            
             $name=$_POST['name'];
             if(strlen($name)>0){
             $e=$_SESSION['email'];
             $n=$_SESSION['name'];
             $sql = "UPDATE  userdata SET name='$name' where name= '$n'";
             $result = mysqli_query($conn,$sql);
            if($result)
            {
                $_SESSION['name']=$name;
            } 
        }
             
        }


         if(isset($_POST['age']))
        {
             $age=$_POST['age'];
             $e=$_SESSION['email'];
             if($age>0){
             $sql = "UPDATE userdata SET age='$age' WHERE email='$e'";
             $result = mysqli_query($conn,$sql);
            if($result)
            {
                $_SESSION['age']=$age;
            } 
            }
        }
        
         if(isset($_POST['gender']))
        {
            $gender=$_POST['gender'];
            $e=$_SESSION['email'];
            $sql = "UPDATE userdata SET gender='$gender' WHERE email='$e'";
            $result = mysqli_query($conn,$sql);
            if($result)
            {
                $_SESSION['gender']=$gender; 
            } 
           

        }
        if(isset($_POST['email']))
        {

                $e=$_SESSION['email'];
                $email=$_POST['email'];
                $que="SELECT * from userdata WHERE email='$email'";
                $res = mysqli_query($conn,$que);
                $row = mysqli_fetch_array($res,MYSQLI_ASSOC);
                $output = mysqli_num_rows($res);
                echo 70;
                echo $e;
                if($output<=0)
                {
                    $email=$_POST['email'];
                    $sql = "UPDATE userdata SET email='$email' WHERE email='$e'";
                    $result = mysqli_query($conn,$sql);
                    if($result)
                    {
                        $_SESSION['email']=$email; 
                    }
                           
                }              
        }
        if(isset($_POST['password']))
        {
                if(($_POST['password'])===($_POST['password2']))
                {
                    $password=$_POST['password'];
                    $password = password_hash($password, PASSWORD_DEFAULT);
                    $e=$_SESSION['email'];
                    echo 10;
                    $sql = "UPDATE userdata SET password='$password' WHERE email='$e'";
                    if ($conn->query($sql) === TRUE) 
                    {
                        $_SESSION['password']=$password;
                       
                    } 
                   
                }
         
         }

        //if(isset($_POST['file']))
        if($_FILES["file"]["size"]>0)
        {
            $doc=$_POST['file'];
            
            $pname=$_FILES["file"]["name"];
            $tname=$_FILES["file"]["tmp_name"];
            $upload_dir='uploads/'; 
            $email=$_SESSION['email'];
            $sql = "UPDATE userdata SET picture='$pname' WHERE email='$email'";
            $result = mysqli_query($conn,$sql);
            
            if($result)
            {
                $_SESSION['picture']=$pname;
                header("location:mainpage.php");
            } 
            else
            {
                header("location:mainpage.php");
            }                     
        }
    }
}
?>