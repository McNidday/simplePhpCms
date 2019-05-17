<?php 

    include "connection.php";

    include "includes/header.php";

    include "includes/navigation.php";
   ?>

<!-- Page Content -->
<div class="container">

    <div class="row">





        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <h1 class="page-header">
                Page Heading
                <small>Secondary Text</small>
            </h1>

            <!--POSTS CATEGORY-->



            <?php 
                
                
                 if (isset($_POST['search']) ) {
                        
                       echo $search = $_POST['search_one']; 
                       
                       $query_search = "SELECT * FROM posts WHERE post_tags LIKE '%$search%'";
                        
                       $search_query = mysqli_query($conn, $query_search);
                        
                        if (!$search_query){
                            
                            die ("ERROR SEARCH" . mysqli_error($conn));
                            
                        }
                        
                        $count = mysqli_num_rows($search_query);
                        
                        if ($count == 0){
                            
                            echo "<h1>NO RESULT</h1>";
                            
                        } else {
                            
                 
                    while ($row_posts = mysqli_fetch_assoc($search_query)){

                        $post_title = $row_posts['post_title'];
                        $post_author = $row_posts['post_author'];
                        $post_date = $row_posts['post_date'];
                        $post_image = $row_posts['post_image'];
                        $post_content = $row_posts['post_content'];
                        
                       ?>


            <!-- First Blog Post -->
            <h2>
                <a href="#">
                    <?php echo $post_title; ?></a>
            </h2>
            <p class="lead">
                by <a href="index.php">
                    <?php echo $post_author; ?></a>
            </p>
            <p><span class="glyphicon glyphicon-time"></span> Posted on
                <?php echo $post_date; ?>
            </p>
            <hr>
            <img class="img-responsive" src="http://placehold.it/900x300" alt="">
            <hr>
            <p>
                <?php echo $post_content; ?>
            </p>
            <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

            <hr>


            <?php     }
              
                            
                        }
                
                    }
                
                
        ?>


            <!-- Pager -->
            <ul class="pager">
                <li class="previous">
                    <a href="#">&larr; Older</a>
                </li>
                <li class="next">
                    <a href="#">Newer &rarr;</a>
                </li>
            </ul>

        </div>

        <!-- Blog Sidebar Widgets Column -->
        <div class="col-md-4">

            <!-- Blog Search Well -->
            <div class="well">

                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">

                    <h4>Blog Search</h4>

                    <div class="input-group">

                        <input type="text" class="form-control" name="search_one">

                        <span class="input-group-btn">

                            <button class="btn btn-default" type="submit" name="search">

                                <span class="glyphicon glyphicon-search"></span>

                            </button>

                        </span>

                    </div>

                </form>
                <!-- /.input-group -->
            </div>


            <?php 
                        if(!isset($_SESSION['username'] ) ) {
                            
                            
                            ?>

            <!-- Login Well -->
            <div class="well">

                <form action="includes/login.php" method="post">

                    <h4>Login</h4>


                    <div class="form-group">

                        <input type="text" class="form-control" name="username" placeholder="Enter Username">

                    </div>

                    <br />

                    <div class="input-group">

                        <input type="password" class="form-control" name="password" placeholder="Enter Password">
                        <span class="input-group-btn">
 
                            <button class="btn btn-primary" name="login">Submit

                            </button>

                        </span>


                    </div>

                </form>
                <!-- /.input-group -->
            </div>

            <?php      }
                
                
                ?>


            <!-- Blog Categories Well -->
            <div class="well">
                <h4>Blog Categories</h4>
                <div class="row">
                    <div class="col-lg-6">
                        <ul class="list-unstyled">
                            <?php 
                                
                                $query_categories = "SELECT * FROM categories";
                                
                                $query_categories_result = mysqli_query($conn, $query_categories);
                                
                                while ($row_category = mysqli_fetch_assoc($query_categories_result)){
                                    
                                    $cat_title = $row_category['cat_title'];
                                    $cat_id = $row_category['cat_id'];
                                    
                                    ?>
                            <li><a href="category.php?category=<?php echo $cat_id; ?>">
                                    <?php echo $cat_title; ?></a></li>

                            <?php    }
                                
                                ?>

                        </ul>
                    </div>

                    <!-- /.row -->
                </div>

                <!-- Side Widget Well -->
                <?php include "includes/sidewidget.php"; ?>

            </div>

        </div>
        <!-- /.row -->

        <hr>

        <?php 
        
        include "includes/footer.php";
        
        ?>