<?php
    $text="";
    session_start();
    if(array_key_exists("logout",$_POST))
    {
        header("location: index.php?logout=1");
    }
    if(array_key_exists("id",$_SESSION)){
        $link=mysqli_connect("sdb-g.hosting.stackcp.net","secretdiaryusers-31383551ee","harindam18","secretdiaryusers-31383551ee");
            if(mysqli_connect_error()){
            die("error connecting to database");
            }
            //echo ($_POST['content']);
            $query="select text from users_data where id='".$_SESSION['id']."' LIMIT 1";
            if($result=mysqli_query($link,$query)){
                $row=mysqli_fetch_array($result);
                $text=$row['text'];
            }
            else{
                
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
    
    <title>secret diary</title>
    <style>
      body{
        background-image: url("background2.jpg");
        background-size: cover;
      }
      #diarypage{
          margin: 50px 20px 0px 20px;
          background-color: white;
          height: 600px;
      }
      #two-btn nav{
        
        text-align: center;
      }
      textarea{
        resize: none;
      }
    </style>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/jquery-ui.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </head>
  <body>
        <nav class="navbar navbar-light bg-light">
        <div class="container-fluid">
          <span class="navbar-brand"><?php   echo(" Welcome <span style='color:red'> ".$_SESSION['Username']."</span>");          ?></span>
          <form method="post">
            <input name="logout" type="submit" class="btn btn-info" value="Sign out">
          </form>
        </div>
      </nav>
      <div class="mb-3" id="diarypage">
        <span id="textareas"><textarea class="form-control" id="textarea1" placeholder="Start Writing here..." style="height: 100%;"><?php  echo($text); ?></textarea></Span>
        <button id="save" type="button" class="btn btn-success" style="float: right;">Save my text</button>
        <div id="two-btn">
          <!--<nav aria-label="Page navigation example">-->
          <!--  <ul class="pagination justify-content-center">-->
          <!--    <li class="page-item">-->
          <!--      <a class="page-link" href="#" tabindex="-1">Previous</a>-->
          <!--    </li>-->
          <!--    <li class="page-item active this-page" id="1"><a class="page-link" href="#"><span >1</span></a></li>-->
          <!--    <li class="page-item" id="2"><a class="page-link" href="#"><span >2</span></a></li>-->
          <!--    <li class="page-item" id="3"><a class="page-link" href="#"><span>3</span></a></li>-->
          <!--    <li class="page-item">-->
          <!--      <a id="next-page" class="page-link" href="#">Next</a>-->
          <!--    </li>-->
          <!--  </ul>-->
          <!--</nav>-->
          
        </div>
      </div>
    <script>
      var c=1;
       $("#next-page").click(function(){
         var val=0;
         if(c%3==0)
         {
           val = parseInt($(".active").text());
           $("#1").html('<a class="page-link" href="#"><span >'+(val+1)+'</span></a>');
           $("#2").html('<a class="page-link" href="#"><span >'+(val+2)+'</span></a>');
           $("#3").html('<a class="page-link" href="#"><span >'+(val+3)+'</span></a>');
         }
         var count=(c+1)%3;
         if((c+1)%3==0){
           count=3;
         }
        $(".this-page").removeClass("active");
        $("#"+count).addClass("active");
        $("#"+count).addClass("this-page");
        c=c+1;
       });
       $("#save").click(function(){
          $.ajax({
            type: "POST",
            url: "sample.php",
            data: {
                content: $("#textarea1").val()
            }
        }).done(function(msg){
            alert("your text is saved");
        })
       });
    </script>
    
  </body>
</html>