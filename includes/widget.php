
   <div class="well">
    <h4>Latest Articles</h4>
   <?php 
    
    $query = "SELECT * FROM posts ORDER BY post_id DESC LIMIT 5";
    $result = mysqli_query($conn,$query);   
    
       while($row = mysqli_fetch_array($result)){
           $post_title = $row['post_title'];
           $post_image = $row['post_image'];
           $post_author = $row['post_user'];
           $post_image = $row['post_image'];
           $post_content = $row['post_content'];
            
    ?>   
     
   <div class="media">
    <div class="media-left">
      <img src="images/<?php echo $post_image;?>" class="media-object" style="width:50px" class="">
    </div>
    <div class="media-body">
        <h4 class="media-heading"><b><a href="#"><?php echo $post_title; ?></a></b>&nbsp;<small><i>Posted by: <?php echo $post_author;?></i></small></h4>
      <p><?php echo substr($post_content,0,50);?>...</p>
    </div>
  </div>
    
    <?php 
       }
       ?>
</div>