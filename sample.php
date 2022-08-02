<?php
session_start();
if(array_key_exists("content",$_POST)){
            $link=mysqli_connect("localhost","root","","secretdiaryusers-31383551ee");
            if(mysqli_connect_error()){
            die("error connecting to database");
            }
            //echo ($_POST['content']);
            $query="update users_data set text='".$_POST['content']."' where id='".$_SESSION['id']."' LIMIT 1";
            if($result=mysqli_query($link,$query)){
                echo("Success");
            }
            else{
                echo("error");
            }
            
}
            
?>   
        
        
        
        