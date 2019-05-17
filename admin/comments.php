<?php include "includes/header.php"; ?>

<?php include "functions.php"; ?>

<?php ob_start(); ?>

<div id="wrapper">

    <?php include "includes/navigation.php";?>


    <div id="page-wrapper">

        <div class="container-fluid">



            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">






                    <?php 
                    
                    if(isset($_GET['source']) && isset($_GET['comment_id']) ){
                        
                        $source = $_GET['source'];
                        $post_id = $_GET['comment_id'];
                        ?>

                    <h1 class="page-header">

                        ALL COMMENTS RELATED TO

                        <?php 
                             
                                $related_comments_query = "SELECT post_title FROM posts WHERE post_id = {$post_id}";
                                
                                $related_comments_query_result = mysqli_query($conn, $related_comments_query);
                        
                                $related_post = mysqli_fetch_assoc($related_comments_query_result);
                        
                                $post_title = $related_post['post_title'];
                        
                             
                             ?>

                        <small><?php echo $post_title; ?></small>


                    </h1>
                    
                    <?php 
                    
                     switch ($source) {
                            
                            
                        case 'view_specific_comments': include "includes/view_specific_comments.php";
                        break;

                        default: include "includes/view_all_comments.php";
                        break;
                             
                      
                    }
                    
                    ?>
                    
                    


                    <?php  } else{
                        
                        ?>
                     <h1 class="page-header">

                        WELCOME TO ADMIN

                        <small><?php echo $_SESSION['username']; ?></small>


                    </h1>
                    
                    <?php 
                    
                         include "includes/view_all_comments.php";
                        
                    ?>
                    
                    <?php
                        
                    }
                    
                    ?>



                </div>

                <!--DELETE CATEGORIES-->

                <?php delete_categories(); ?>


            </div>
            <!-- /.row -->

            <!-- /.container-fluid -->

        </div>


    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<!-- jQuery -->

<script src="js/jquery.js"></script>


<script src="js/scripts.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>


</body>

</html>