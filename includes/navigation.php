<?php 

session_start();

?>


<!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="./index.php">CMS-NIDDAY</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="#">About</a>
                    </li>
                    <li>
                        <a href="#">Services</a>
                    </li>
                    <li>
                        <a href="contact.php">Contact</a>
                    </li>
                    
                    <?php 
                    
                    if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'){
                        
                        ?>
                     <li>
                        <a href="admin"><?php echo $_SESSION['user_role']; ?></a>
                    </li>
                    
                    <?php
                        
                    }
                    
                    ?>
                   
                    
                    <?php 
                    
                    if(!isset($_SESSION['username'])){
                        
                        ?>
                    
                         <li><a href="registration.php">Register</a></li>
                    
                        
                <?php    }
                       
                    
                    ?>
                    
                   
                    <?php 
                    
                        if (isset($_SESSION['username'])){
                            
                            if(isset($_GET['p_id'])){
                                
                                $post_to_edit = $_GET['p_id'];
                                
                                ?>
                                <li>
                                <a href ="admin/posts.php?edit_post=<?php echo $post_to_edit; ?>&source=edit_post">Edit post</a>
                                </li>
                    
                       <?php     }
                            
                        }
                    
                    ?>
                    
                    
                    
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
