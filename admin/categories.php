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
                    <h1 class="page-header">
                    
                    Blank Page
                    <small>Subheading</small>

                    </h1>

                    <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-file"></i> Blank Page
                    </li>
                    </ol>
                </div>



                <!--ADD CATEGORY QUERY-->

                <?php insert_categories(); ?>

                <div class="col-xs-6">
                <!--ADD CATEGORY FORM-->


                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">

                    <div class = "form-group">

                    <input type="text" class="form-control" name="cat_title" placeholder="Add Category">

                    </div>

                    <div class = "form-group">

                    <input type="submit" class="btn btn-md btn-primary" value="Add Category" name="addcat">

                    </div>


                    </form>


                    <?php update_categories(); ?>



                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="get">

                    <div class = "form-group">


                    <?php edit_categories(); ?>

                    </div>

                    </form>

                </div>



                <div class="col-sm-6">

                    <table class="table table-bordered table-hover">

                        <thead>

                            <tr>


                            <th>#</th>

                            <th>CATEGORY</th>


                            </tr>

                        </thead>

                        <tbody>

                        <!--DISPLAY DATA IN TABLE-->

                        <?php display_category_data(); ?>

                        </tbody>

                    </table>

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
