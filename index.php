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
                Latest Posts
            </h1>

            <!--POSTS CATEGORY-->

            <?php 
            
         $per_page = 2;
            
                    if (isset($_GET['page'])){

                        $page = $_GET['page'];

                    } else {


                        $page = "";


                    }

                    if ($page == 1 || $page == ''){

                        $page_1 = 0;

                    } else {

                        $page_1 = ($page * $per_page );

                    }
                
                
                    $post_query_count = "SELECT * FROM posts";
                
                    $find_count = mysqli_query($conn, $post_query_count);
                
                    $count = mysqli_num_rows($find_count);
                
                
                    $count = $count / $per_page ;
                
                
                    floor ($count);
                
                
                    $query_posts = "SELECT * FROM posts WHERE post_status = 'Published' LIMIT $page_1, $per_page ";
                
                
                    $query_posts_result = mysqli_query($conn, $query_posts);
                
                   if (mysqli_num_rows($query_posts_result) > 0){
                
                    while ($row_posts = mysqli_fetch_assoc($query_posts_result)){
                        
                        
                        $post_id = $row_posts['post_id'];
                        $post_title = $row_posts['post_title'];
                        $post_author = $row_posts['post_author'];
                        $post_date = $row_posts['post_date'];
                        $post_image = $row_posts['post_image'];
                        $post_comments = substr($row_posts['post_content'], 0, 200);
                        $post_status = $row_posts['post_status'];
                        
                        
                       ?>


            <!-- First Blog Post -->
            <h2>
                <a href="post.php?p_id=<?php echo $post_id ?>">
                    <?php echo $post_title; ?></a>
            </h2>
            <p class="lead">
                by <a href="author_posts.php?p_id=<?php echo $post_id ?>&author=<?php echo $post_author ?>">
                    <?php echo $post_author; ?></a>
            </p>
            <p><span class="glyphicon glyphicon-time"></span> Posted on
                <?php echo $post_date; ?>
            </p>
            <hr>

            <a href="post.php?p_id=<?php echo $post_id ?>"><img class="img-responsive" src="images/<?php echo $post_image?>" alt=""></a>

            <hr>
            <p>
                <?php echo $post_comments; ?>
            </p>
            <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

            <hr>


            <?php     }
                
                } else {
                    
                    echo "<div class='alert alert-warning'>YOU HAVE NO POSTS YET, NEW HERE!?</div>";
                    
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

                <form action="search.php" method="post">

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
                    
                        if (isset($_GET['wrong_password'])){
                          
                            $warning = $_GET['wrong_password'];
                            
                            if ($warning === "true"){
                                
                                echo "<div class='alert alert-danger'>Wrong Username/Password</div>";
                                
                            }
                         
                        }
                
                        if (isset($_GET['empty_words'])){
                            
                            $EMPTY = $_GET['empty_words'];
                            
                            if ($EMPTY === "true"){
                    
                                echo "<div class='alert alert-warning'>Seriously you want me to process empty data!</div>";
                            }
                            
                        }
                  
                    ?>

            <?php 
            
                if(!isset($_SESSION['username'])){
                    
                    ?>


            <!-- Login Well -->
            <div class="well">



                <form action="includes/login.php" method="post">

                    <h4>Login</h4>


                    <div class="form-group">

                        <input type="text" class="form-control" name="username" placeholder="Enter Username">

                    </div>


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





            <?php
                    
                }
            
            ?>

            <?php 
                if(isset($_SESSION['username'])){

                    ?>
                    <!-- LogOut Well -->
                    <div class="well">
        
        
        
                        <form action="includes/logout.php" method="post">
        
                            <h4>Logged in as <?php echo $_SESSION['username']; ?></h4>
        
                            <div class="input-group">
        
                                <span class="input-group-btn">
        
                                    <button class="btn btn-primary" name="logout">Logout
        
                                    </button>
        
                                </span>
        
        
                            </div>
        
                        </form>
                        <!-- /.input-group -->
                    </div>
        
        <?php

                }
            
            
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

                </div>
                <!-- /.row -->
            </div>

            <!-- Side Widget Well -->
            <?php include "includes/sidewidget.php"; ?>

        </div>

    </div>
    <!-- /.row -->

    <hr>

    <ul class="pager">

        <?php 
        
        
        
       
        
    
for ($i = 1; $i <= $count; $i++) { 
    
    
    
    if ($i==$page){ ?>


        <li>

            <a class="active_link" href="index.php?page=<?php echo $i ?>">
                <?php echo $i ?></a>

        </li>



        <?php   } else {
        
        
    
    ?>


        <li>

            <a href="index.php?page=<?php echo $i ?>">
                <?php echo $i ?></a>

        </li>




        <?php  }
    
}
    
    ?>

    </ul>


    <?php 
        
        include "includes/footer.php";
        
        ?>