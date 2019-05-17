<?php include "includes/header.php"; ?>

<?php include "functions.php"; ?>

<?php ob_start(); 

?>

    <div id="wrapper">

    <?php include "includes/navigation.php";?>


        <div id="page-wrapper">

            <div class="container-fluid">



            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">

               
                <h1 class="page-header">
                    
                    CATCH UP ON YOUR POSTS
                    
                    <small><?php echo $_SESSION['username']; ?></small>

                   
                </h1>
               
              <?php 
                    
                if (isset($_GET['source'] ) ) {
                    
                    $source = $_GET['source'];
                    
                }  else {
                    
                    
                    $source = "Nidday Rocks";
                    
                }    
                    
                    switch ($source) {
                            
                            
                        case 'add_posts': include "add_posts.php";
                        break;
                            
                        case 'edit_post': include "edit_posts.php";
                        break;

                        default: include "includes/view_all_posts.php";
                        break;
                      
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

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>



    </body>

    </html>
