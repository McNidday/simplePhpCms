<?php include "includes/header.php"; ?>


<div id="wrapper">

    <?php include "includes/navigation.php";?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Welcome to admin
                        <small>
                            <?php echo $_SESSION['username']; ?></small>
                    </h1>
                </div>
            </div>
            <!-- /.row -->



            <!-- /.row -->

            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-file-text fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">

                                    <?php 
                        
                        $query_posts = "SELECT * FROM posts";
                        
                        $select_all_posts = mysqli_query($conn, $query_posts);
                        
                        $num_posts = mysqli_num_rows ($select_all_posts);
                        
                        echo " <div class='huge'>$num_posts</div>";
                        
                        ?>

                                    <div>Posts</div>
                                </div>
                            </div>
                        </div>
                        <a href="posts.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-comments fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">


                                    <?php 
                        
                        $query_comments = "SELECT * FROM comments";
                        
                        $select_all_comments = mysqli_query($conn, $query_comments);
                        
                        $num_comments = mysqli_num_rows ($select_all_comments);
                        
                        echo " <div class='huge'>$num_comments</div>";
                        
                        ?>

                                    <div>Comments</div>
                                </div>
                            </div>
                        </div>
                        <a href="comments.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-user fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">



                                    <?php 
                        
                        $query_users = "SELECT * FROM users";
                        
                        $select_all_users = mysqli_query($conn, $query_users);
                        
                        $num_users = mysqli_num_rows ($select_all_users);
                        
                        echo " <div class='huge'>$num_users</div>";
                        
                        ?>

                                    <div> Users</div>
                                </div>
                            </div>
                        </div>
                        <a href="users.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-list fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">

                                    <?php 
                        
                        $query_categories = "SELECT * FROM categories";
                        
                        $select_all_categories = mysqli_query($conn, $query_categories);
                        
                        $num_categories = mysqli_num_rows ($select_all_categories);
                        
                        echo " <div class='huge'>$num_categories</div>";
                        
                        ?>

                                    <div>Categories</div>
                                </div>
                            </div>
                        </div>
                        <a href="categories.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.row -->


            <?php 
                
                    
                        $query_draft_posts = "SELECT * FROM posts WHERE post_status='draft'";
                        
                        $select_all_draft_posts = mysqli_query($conn, $query_draft_posts);
                        
                        $num_draft_posts = mysqli_num_rows ($select_all_draft_posts);
                
                
                
                        $query_active_posts = "SELECT * FROM posts WHERE post_status='published'";
                        
                        $select_all_active_posts = mysqli_query($conn, $query_active_posts);
                        
                        $num_active_posts = mysqli_num_rows ($select_all_active_posts);
                
                
                
                
                        $query_unapproved_comments = "SELECT * FROM comments WHERE comment_status='unapproved'";
                        
                        $select_all_unapproved_comments = mysqli_query($conn, $query_unapproved_comments);
                        
                        $num_comment_unapproved = mysqli_num_rows ($select_all_unapproved_comments);
                
                
                
                
                        $query_subscriber_role = "SELECT * FROM users WHERE user_role='subscriber'";
                        
                        $select_all_subscriber_role = mysqli_query($conn, $query_subscriber_role);
                        
                        $num_subscriber_roles = mysqli_num_rows ($select_all_subscriber_role);
                        
                        
                        
                      
                ?>

            <!-- /.container-fluid -->

            <div class="row">


                <script type="text/javascript">
                    google.charts.load('current', {
                        'packages': ['bar']
                    });
                    google.charts.setOnLoadCallback(drawChart);

                    function drawChart() {
                        var data = google.visualization.arrayToDataTable([
                            ['Data', 'Count'],

                            <?php 
            
            $elements_text = ['All Posts','Active Posts', 'Draft Posts', 'Users','Subscriber Count', 'Comments', 'UnApproved Comments', 'Categories'];
            $elements_count = [$num_posts, $num_active_posts, $num_draft_posts, $num_users, $num_subscriber_roles, $num_comments, $num_comment_unapproved , $num_categories];
                
            for ($i = 0; $i < 7; $i++){
                
                echo "['{$elements_text[$i]}'" . "," . "'{$elements_count[$i]}'],";
                
            }
            
            
            ?>

                        ]);

                        var options = {
                            chart: {
                                title: 'McNidday CMS',
                                subtitle: 'Nidday is awesome!',
                            }
                        };

                        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                        chart.draw(data, google.charts.Bar.convertOptions(options));
                    }
                </script>

                <div id="columnchart_material" style="width: auto; height: 500px;"></div>

            </div>

        </div>


    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<!-- jQuery -->
<script>
    function loadUsersOnline() {

        $.get("functions.php?onlineUsers=result", function(data) {

            $(".usersOnline").text(data);

        });
    }

    setInterval(function() {

        loadUsersOnline();

    }, 1000);
</script>

<script src="js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

<!--<script src="../admin/js/script.js"></script>-->
</body>

</html>