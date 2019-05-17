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
                
                if (isset($_GET['category'])){
                    
                    
                    $post_category_id = $_GET['category'];
                
                
                    $query_posts = mysqli_prepare($conn, "SELECT * FROM posts WHERE post_category_id = ?");
                
                    $query_posts_result = mysqli_query($conn, $query_posts);
                
                    while ($row_posts = mysqli_fetch_assoc($query_posts_result)){
                        
                        $post_id = $row_posts['post_id'];
                        $post_title = $row_posts['post_title'];
                        $post_author = $row_posts['post_author'];
                        $post_date = $row_posts['post_date'];
                        $post_image = $row_posts['post_image'];
                        $post_comments = substr($row_posts['post_comments'], 0, 200);
                        
                       ?>
                       
                        
                         <!-- First Blog Post -->
                <h2>
                    <a href="post.php?p_id=<?php echo $post_id ?>"><?php echo $post_title; ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_author; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?></p>
                <hr>
                
                <a href="post.php?p_id=<?php echo $post_id ?>"><img class="img-responsive" src="images/<?php echo $post_image?>" alt=""></a>
                 
                <hr>
                <p><?php echo $post_comments; ?></p>
                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>
       
                        
               <?php     }
                
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
                                    
                                    <li><a href="category.php?category=<?php echo $cat_id; ?>"><?php echo $cat_title; ?></a></li>
                                    
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

        <?php 
        
        include "includes/footer.php";
        
        ?>