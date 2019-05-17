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

                <!--POSTS CATEGORY-->
              
                
                <?php 
                    
                    
                if (isset($_GET['p_id'])&& isset($_GET['author'])){
                
                    $post_id = $_GET['p_id'];
                    $author = $_GET['author'];
                    
                    
                    ?>
                
                <h1 class="page-header">
                    Posts By <?php echo $author ?>
                </h1>
                
                
                <?php
                    
                    
                    
                    $query_posts = "SELECT * FROM posts WHERE post_author = '{$author}' ";
                
                    $query_posts_result = mysqli_query($conn, $query_posts);
                
                    while ($row_posts = mysqli_fetch_assoc($query_posts_result)){

                        $post_title = $row_posts['post_title'];
                        $post_author = $row_posts['post_author'];
                        $post_date = $row_posts['post_date'];
                        $post_image = $row_posts['post_image'];
                        $post_comments = $row_posts['post_content'];
                        
                       ?>
                       
                        
                         <!-- First Blog Post -->
                <h2>
                    <a href="post.php?p_id=<?php echo $post_id ?>"><?php echo $post_title; ?></a>
                </h2>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?></p>
                <hr>
                <a href="post.php?p_id=<?php echo $post_id ?>"><img class="img-responsive" src="images/<?php echo $post_image?>" alt=""></a>
                <hr>
                <p><?php echo $post_comments; ?></p>

                <hr>
       
                        
               <?php     }
                
                }
                
                ?>
                
                
                   <!-- Blog Comments -->
                   
                   <?php 
                       
                        if (isset($_POST['create_comment'])){
                            
                            $the_post_id = $_GET['p_id'];
                            
                            $comment_author = $_POST['comment_author'];
                            
                            $comment_email = $_POST['comment_email'];
                            
                            $comment = $_POST['comment'];
                            
                           if (!empty($comment_author) && !empty ($comment_email) && !empty ($comment)){
                               
                                $comment_query = "INSERT INTO comments (comment_id, comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date) ";
                            
                            $comment_query.= "VALUES (NULL, '{$the_post_id}', '{$comment_author}', '{$comment_email}', '{$comment}', 'Unapproved', now())";
                            
                            $comment_query_result = mysqli_query($conn, $comment_query);
                            
                            /*CONFIRM QUERY*/
                            
                            if (!$comment_query_result){
                                
                                die ("ERROR ADDING COMMENT". " " . mysqli_error($conn));
                                
                            }
                            
                            else {
                                
                                echo "<div class='alert alert-success'>Comment Added Dawg</div>";
                                
                            }
                            
                            $comment_count = "UPDATE posts SET post_comment_count = post_comment_count + 1 ";
                            $comment_count .= "WHERE post_id = {$the_post_id}";
                            
                            $comment_count_result = mysqli_query($conn, $comment_count);
                            
                               
                           } else {
                               
                               echo "<div class = 'alert alert-warning'>SERIOUSLY!! YOU JUST HAD TO LEAVE AN EMPTY INPUT FOR ME TO PROCCESS</div>";
                               
                           }
                        }
                
                
                            
                
                
                
                    ?>
                   
                   


                <hr>
                
                

                <!-- Posted Comments -->
                
                <?php 
                        if (isset($_GET['p_id'])){
                            
                            $post_id = $_GET['p_id'];
                            
                            $comments_query = "SELECT * FROM comments WHERE comment_post_id = {$post_id} ";
                            $comments_query.= "AND comment_status = 'Approved' ";
                            $comments_query.= "ORDER BY comment_id DESC";

                            $comments_query_result = mysqli_query($conn, $comments_query);

                            while ($comment_row = mysqli_fetch_assoc($comments_query_result)){

                                $comment_date = $comment_row['comment_date'];  
                                $comment_content = $comment_row['comment_content'];
                                $comment_author = $comment_row['comment_author'];
                                
                               ?>
                               
                
                  
                                               <!-- Comment -->
                                               
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment_author; ?>
                            <small><?php echo $comment_date; ?></small>
                        </h4>
                        <?php echo $comment_content; ?>
                    </div>
                </div>

  
                 
                    <?php        }
                            
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
                                    
                                    ?>
                                    
                                    <li><a href="#"><?php echo $cat_title; ?></a></li>
                                    
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