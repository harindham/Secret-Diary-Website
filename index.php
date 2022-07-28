<?php
    session_start();
    $error="";
    if(array_key_exists("logout",$_GET)){
        session_destroy();
        header("location: index.php");
    }
    else if(array_key_exists("id",$_SESSION)){
        header("location: main-page.php");
    }
    if(array_key_exists("submit",$_POST)){
    $link=mysqli_connect("sdb-g.hosting.stackcp.net","secretdiaryusers-31383551ee","harindam18","secretdiaryusers-31383551ee");
    if(mysqli_connect_error()){
        die("error connecting to database");
    }
    else{
        if(array_key_exists("signup",$_POST)){
            $query="select id from users_data where email='".mysqli_real_escape_string($link,$_POST['email'])."' LIMIT 1";
            $result=mysqli_query($link,$query);
            if(mysqli_num_rows($result) > 0){
                echo("<p style='color:red'>This Email is Already taken</p>");
            }
            else{
                $query="insert into users_data(Username,email,password) values('".$_POST['username']."','".$_POST['email']."','".$_POST['password']."')";
                //$query="DELETE from users_data";
                if($result=mysqli_query($link,$query)){
                    $_SESSION['Username']=$_POST['username'];
                    $_SESSION['id']=mysqli_insert_id($link);
                    header("location: main-page.php");
                }
            }
        }
        else{
            //print_r($_POST);
            $query="select * from users_data where email='".mysqli_real_escape_string($link,$_POST['email'])."' LIMIT 1";
            $result=mysqli_query($link,$query);
            $row=mysqli_fetch_array($result);
            //echo($row['password']);
            if(mysqli_num_rows($result) > 0){
                if($_POST['password']==$row['password']){
                    $_SESSION['id']=$row['id'];
                    $_SESSION['Username']=$_POST['username'];
                    header("location: main-page.php");
                }
                else{
                    echo ("<p style='color:red'>Incorrect Password!</p>");
                }
            }
            else{
                echo ("<p style='color:red'>No such email id found!</p>");
            }
        }
    }
    }
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Secret Diary</title>
    <style>
      html{
          background: url(background2.jpg) no-repeat center center fixed; 
          -webkit-background-size: cover;
          -moz-background-size: cover;
          -o-background-size: cover;
          background-size: cover;
      }
      body{
        background: none;  
        text-align: center;
        color: white;
      }
      .container{
          width: 400px;
          align: center;
          text-align: center;
      }
      form{
        margin-top: 30px;
        
      } 
      #signupemail{
          margin-top: 20px;
      }
      #signuppassword{
          margin-top: 20px;
      }
      #loginemail{
          margin-top: 20px;
      }
      #loginpassword{
          margin-top: 20px;
      }
      #submit{
          margin-top: 20px;
      }
      .nodisplay{
          display: none;
      }
      #emailHelp{
        color: white;
      }
      #main-title{
        color: white;
        margin-top: 150px;
      }
      .alert{
          margin-left: 450px;
          margin-right: 450px;
      }
      h1{
        font-size: 54px;
      }
      h4{
        font-size: 17px;
      }
      #error{
          margin-top: 20px;
      }
      #signupline{
          margin-top: 10px;
          text-decoration: underline;
          
      }
      #loginline{
          margin-top: 10px;
      }
      #loginswitch{
          text-decoration: underline;
      }
    </style>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/jquery-ui.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </head>
  <body>
    <div class="container">
    <div id="main-title">
     <h1>Secret Diary</h1><br>
     <h4>A place to store your amazing thoughts,ideas,quotes and much more!</h4> 
    </div>
    <form method="post" class="form-group" id="signupform">
      <fieldset class="form-group">
        <input name="username" id="signupusername" type="text" class="form-control" placeholder="username">
      </fieldset>
      <fieldset class="form-group">
        <input name="email" id="signupemail" type="email" class="form-control" aria-describedby="emailHelp" placeholder="Email">
      </fieldset>
      <fieldset class="form-group">
        <input name="password" id="signuppassword" type="password" class="form-control"  placeholder="Password">
      </fieldset>
      <input type="hidden" name="signup" value="1">
      <fieldset class="form-group"><br>
      <input name="submit" type="submit" class="btn btn-primary" value="signup">
      </fieldset>
    </form>
    <form method="post" class="form-group nodisplay" id="loginform">
      <fieldset class="form-group">
        <input name="username" id="loginusername" type="text" class="form-control" placeholder="username">
      </fieldset>
      <fieldset class="form-group">
        <input name="email" id="loginemail" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email">
      </fieldset>
      <fieldset class="form-group">
        <input name="password" id="loginpassword" type="password" class="form-control"  placeholder="Password">
      </fieldset>
      <fieldset class="form-group"><br>
      <input name="submit" type="submit" class="btn btn-primary" value="login">
      </fieldset>
    </form>
    <div id="loginline">already have an account?  <a id="loginswitch" style="color: white;">Login</a></div>
    <div class="nodisplay" id="signupline"><a id="signupswitch">signup</a></div>
    </div>
    <div id="error">
    </div>
    
    
    <script type="text/javascript">
        $("#loginswitch").click(function(){
              $("#signupform").toggleClass("nodisplay")
              $("#loginline").toggleClass("nodisplay")
              $("#loginform").toggleClass("nodisplay")
              $("#signupline").toggleClass("nodisplay")
          });
          $("#signupswitch").click(function(){
              $("#signupform").toggleClass("nodisplay")
              $("#loginline").toggleClass("nodisplay")
              $("#loginform").toggleClass("nodisplay")
              $("#signupline").toggleClass("nodisplay")
          });
       $("#signupform").submit(function(e) {
              e.preventDefault();
              
              var error = "";
              if ($("#signupusername").val() == "") {
                  
                  error += "Please enter your username.<br>";
                  $("#signupusername").css("outline", "4px solid #F44336");
                  
              }
              
              if ($("#signupemail").val() == "") {
                  
                  error += "The email field is required.<br>";
                  $("#signupemail").css("outline", "4px solid #F44336");
                  
              }
              
              if ($("#signuppassword").val() == "") {
                  
                  error += "The password field is required.<br>";
                  $("#signuppassword").css("outline", "4px solid #F44336");
                  
              }
              if (error != ""){
                  
                 $("#error").html('<div class="alert alert-danger" role="alert"><p><strong>There were error(s) in signing up:</strong></p>' + error + '</div>');
                  
                  return false;
                  
              } else {
                  
                    $("form").unbind("submit").submit();
                  
              }
          });
          
          $("#loginform").submit(function(e) {
              
              e.preventDefault();
              
              var error = "";
              
              if ($("#loginusername").val() == "") {
                  
                  error += "Please enter your username.<br>";
                  $("#loginusername").css("outline", "4px solid #F44336");
                  
              }
              
              if ($("#loginemail").val() == "") {
                  
                  error += "The email field is required.<br>"
                  $("#loginemail").css("outline", "4px solid #F44336");
              }
              
              if ($("#loginpassword").val() == "") {
                  
                  error += "The password field is required.<br>"
                  $("#loginpassword").css("outline", "4px solid #F44336");
              }
              
              
              if (error != "") {
                  
                 $("#error").html('<div class="alert alert-danger" role="alert"><p><strong>There were error(s) in logging in:</strong></p>' + error + '</div>');
                  
                  return false;
                  
              } else {
                  
                    $("form").unbind("submit").submit();
                  
              }
          });
          
          
    </script>
  </body>
</html>