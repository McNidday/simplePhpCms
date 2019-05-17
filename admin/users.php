<?php include "includes/header.php"; ?>

<?php include "functions.php"; ?>

<?php ob_start(); ?>

<?php 

if(!is_Admin($SESSION['username'])){
    header("Location: index.php");
}


?>

    <div id="wrapper">

    <?php include "includes/navigation.php";?>


        <div id="page-wrapper">

            <div class="container-fluid">



            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">

               
                <h1 class="page-header">
                    
                    WELCOME TO ADMIN
                    
                    <small><?php echo $_SESSION['username']?></small>

                   
                </h1>
               
              <?php 
                    
                if (isset($_GET['source'] ) ) {
                    
                    $source = $_GET['source'];
                    
                }  else {
                    
                    
                    $source = "Nidday Rocks";
                    
                }    
                    
                    switch ($source) {
                            
                            
                        case 'add_user': include "add_user.php";
                        break;
                            
                        case 'edit_user': include "edit_user.php";
                        break;

                        default: include "includes/view_all_users.php";
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


    <script src="js/scripts.js"></script>
    </body>

    </html>
