<?php include "includes/Database.php"; ?>
<?php include "includes/header.php"; ?>
  
   
    <!-- Navigation -->
    <?php include "includes/navigation.php"; ?>

    <!-- Navigation -->
   
    <?php
    if(isset($_POST['Submit'])){
       
        
        $to = "RyanMike2323@gmail.com";
        $Email = "From:" .$_POST['Email'];
        $Subject = wordwrap($_POST['Subject'], 70);
        $Message = $_POST['Message'];
       
    mail($to,$Subject,$Message,$Email);    
        
        
    if(!empty($Email) && !empty($Subject) && !empty($Message)){
            
    
                
        if(!$_POST['Submit']){
                die("Query Failed". mysqli_error($conn));
            } 
        $message = "<h4 class='text-success text-center bg-success alert'>Message successfully sent</h4>";
            
        } else {
            $message = "<h4 class='text-danger text-center bg-danger alert'>Fields should not be empty</h4>";
        }
        
        } else {
        $message = "";
        }

?>
    
    
 
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Contact</h1>
                    <form role="form" action="" method="post" id="login-form" autocomplete="off">
                       <?php echo $message; ?>
                        <div class="form-group">
                            <label for="Email" class="sr-only">Email</label>
                            <input type='text' name='Email' id='username' class='form-control' placeholder='Email'>
                        </div>
                        
                         <div class="form-group">
                            <label for="Subject" class="sr-only">Subject</label>
                            <input type='text' name='Subject' id='username' class='form-control' placeholder='Subject'>
                        </div>
                         <div class="form-group">
                            <label for="Message" class="sr-only">username</label>
                            <textarea name="Message" id="" class="form-control" placeholder="Message here"></textarea>
                        </div>
                        <input type="submit" name="Submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Submit">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



  <?php  include "includes/footer.php"; ?>
