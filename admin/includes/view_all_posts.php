<?php 

include ('delete_modal.php');

if (isset($_POST['checkBoxArray'])){
    
    foreach ( $_POST['checkBoxArray'] as $checkBoxValue ) {
        
        $bulk_options = $_POST['bulk_options'];
        
        switch ($bulk_options) {
                
            case "Published": $published_update = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = $checkBoxValue ";
                
                $update_published = mysqli_query($conn, $published_update);
                
                if (!$update_published){
                    
                    echo "WHYYYYYYYYYYY";
                    
                }
                
                break;
                
            case "Draft": $draft_update = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = $checkBoxValue ";
                
                $update_draft = mysqli_query($conn, $draft_update);
                
                 if (!$update_draft){
                    
                    echo "WHYYYYYYYYYYY";
                    
                }
                
                
                break;
                
            case "Do Not Care": 
                
                $do_not_care =  "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = $checkBoxValue ";
                
                $do_not_care_update = mysqli_query($conn, $do_not_care);
                
                 if (!$do_not_care_update){
                    
                    echo "WHYYYYYYYYYYY";
                    
                }
                
                
                break;
                
                
                 case "Clone": 
                        
                        $to_be_cloned = "SELECT * FROM posts WHERE post_id = $checkBoxValue ";
                        
                        $result = mysqli_query($conn, $to_be_cloned);
                
                        while($row = mysqli_fetch_assoc($result)){
                            
                            $post_title = $row['post_title'];
                            $cat = $row['post_category'];
                            $post_category_id = $row['post_category_id'];
                            $post_author = $row['post_author'];
                            $post_status = $row['post_status'];
                            $post_image = $row['post_image'];
                            $post_content = mysqli_real_escape_string($conn, $row['post_content']);
                            $post_tags = $row['post_tags'];
                            $post_comment_count = $row['post_comment_count'];
                        }
                       
                        $clone = "INSERT INTO posts(post_id, post_title, post_category, post_category_id, post_author, post_status, post_image, post_content, post_tags, post_date, post_comment_count, post_view_count) ";

                        $clone .= "VALUES(NULL, '{$post_title}', '{$cat}', {$post_category_id}, '{$post_author}', '{$post_status}', '{$post_image}', '{$post_content}', '{$post_tags}', now(), {$post_comment_count}, 0) ";

                        $query_result_clone = mysqli_query($conn, $clone);


                            /*CONFIRM QUERY POR FAVOR*/

                            confirm_query($query_result_clone, " CLONE");

         
                break;
                
                
            case "Delete": 
                
               $delete = "DELETE FROM posts WHERE post_id = $checkBoxValue ";
                
                $delete_result = mysqli_query($conn, $delete);
                
                if (!$delete_result){
                    
                    echo "NIDDAY PLIZ B PERFECT";
                    
                }
                
                break;
                
        }
        
        
    }
    
}

?>

<form action="" method="post">


    <table class="table table-bodered table-hover">

        <div id="bulkoptionsContainer" class="col-xs-4" style="padding: 0;">

            <select class="custom-select form-control" id="bulk_options" name="bulk_options">

                <option value="" selected disabled hidden>Commit..</option>
                <option value="Draft">Draft</option>
                <option value="Published">Published</option>
                <option value="Do Not Care">Do not care</option>
                <option value="Clone">Clone</option>

                <option value="Delete" style="background-color: red;">Delete</option>

            </select>

        </div>

        <div class="col-xs-4">

            <input type="submit" name="submit" class="btn btn-success" value="Apply">
            <a class="btn btn-primary" href="posts.php?source=add_posts">Add new</a>

        </div>

        <br />

        <hr />
        <thead>

            <thead>
                <tr>
                    <th><input type="checkbox" id="selectAllBoxes" onClick="toggle(this)"></th>
                    <th>Id</th>
                    <th>Author</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Image</th>
                    <th>Tags</th>
                    <th>P.Content</th>
                    <th>Comments</th>
                    <th>View.P</th>
                    <th>Date</th>
                    <th>Edit</th>
                    <th>Delete</th>
                    <th>views</th>
                </tr>
            </thead>




        </thead>

        <tbody>
            <?php 
                    
                            // $query_display_posts = "SELECT * FROM posts ORDER BY post_id DESC ";
                            $query_display_posts = "SELECT posts.post_id, posts.post_title, posts.post_category, posts.post_category_id, posts.post_author, posts.post_date, post_image, categories.cat_title, ";
                            $query_display_posts .= "posts.post_tags, posts.post_content, posts.post_status, posts.post_view_count ";
                            $query_display_posts .= "FROM posts LEFT JOIN categories ON posts.post_category_id = categories.cat_id ORDER BY post_id DESC";
            
                            $query_display_posts = mysqli_query($conn, $query_display_posts);
                       
                            if (!$query_display_posts){
                                
                                die("ERROR FETCHING POSTS" . mysqli_error($conn));
                                
                                
                            } else {
                                
                                while ($row_display_posts = mysqli_fetch_assoc($query_display_posts)){
                                    
                                    $post_id = $row_display_posts['post_id'];
                                    
                                    $post_title = $row_display_posts['post_title'];
                                    
                                    $post_category = $row_display_posts['post_category'];
                                    
                                    $post_category_id = $row_display_posts['post_category_id'];
                                        
                                    $post_author = $row_display_posts['post_author'];
                                    
                                    $post_date = $row_display_posts['post_date'];
                                    
                                    $post_image_name = $row_display_posts['post_image'];
                                    
                                    //Comment Count!!
                                    
                                    $comment_count_query = "SELECT * FROM comments WHERE comment_post_id = {$post_id} " ;
                                    $comment_count_result = mysqli_query($conn, $comment_count_query);
                                    $comments_rows = mysqli_fetch_assoc($comment_count_result);
                                    $comment_id = $comments_rows['comment_post_id'];
                                    $post_comment_count = mysqli_num_rows($comment_count_result);
                                    
                                    
                                    $post_tags = $row_display_posts['post_tags'];
                                    
                                    $post_content = substr ($row_display_posts['post_content'], 0, 100)."...";
                                    
                                    $post_status = $row_display_posts['post_status'];
                                    
                                    $post_views = $row_display_posts['post_view_count'];
                                    
                                    $category = $row_display_posts['cat_title'];
                            ?>

            <tr>

                <td><input class="checkBox" type="checkbox" name="checkBoxArray[]" value="<?php echo  $post_id; ?>"></td>
                <td>
                    <?php echo $post_id; ?>
                </td>
                <td>
                    <?php echo $post_author; ?>
                </td>
                <td>
                    <?php echo $post_title; ?>
                </td>

                <script>


                    function toggle(source){
    
                                        var checkBoxes = document.getElementsByClassName('checkBox');

                                        for (var i = 0; i<checkBoxes.length; i++){

                                            checkBoxes[i].checked = source.checked;

                                                }

                                            }
                                     
                                     
                                     
                                     </script>


                
                                     
                <td>
                    <?php echo $category; ?>
                </td>                  
                                   
                <td>
                    <?php echo $post_status; ?>
                </td>
                <td><img width="150" class="img-thumbnail" src="../images/<?php echo $post_image_name; ?>" alt="Post Image"></td>
                <td>
                    <?php echo $post_tags; ?>
                </td>
                <td>
                    <?php echo $post_content; ?>
                </td>
                <td>
                    <a href="comments.php?comment_id=<?php echo $comment_id; ?>&source=view_specific_comments">
                        <?php echo $post_comment_count; ?> </a>
                </td>
                <td><a href="../post.php?p_id=<?php echo $post_id ?>">View Post</a></td>
                <td>
                    <?php echo $post_date; ?>
                </td>

                <td><a href="posts.php?edit_post=<?php echo $post_id; ?>&source=edit_post" type="button" class="btn btn-default btn-primary btn-md"><span class="glyphicon glyphicon-edit"></span></a></td>

                <td><a onClick="doIt(this)" href="posts.php?delete_post=<?php echo $post_id; ?>" type="button" class="btn btn-default btn-danger btn-md"><span class="glyphicon glyphicon-trash"></span></a></td>

                <td><a href="posts.php?reset=<?php echo $post_id; ?>">
                        <?php echo $post_views; ?></a></td>

                <script>
                    function doIt(source) {

                        return window.confirm('Are you sure You want to delete this post!');

                    }
                </script>
            </tr>

            <?php      }
                                
                            }
                    
                       ?>

            <?php 
                      
                            if (isset($_GET['delete_post'] ) ) {
                                
                                $delete_post_id = $_GET['delete_post'];
                                
                                $delete_post_query = "DELETE FROM posts WHERE post_id = {$delete_post_id} ";
                                
                                $delete_post_query_result = mysqli_query($conn, $delete_post_query);
                                
                                confirm_query($delete_post_query_result, " DELETING POSTS");
                                
                                
                                $delete_comments_related_to_posts = "DELETE FROM comments WHERE comment_post_id = {$delete_post_id} ";
                                
                                $delete_comments_related_to_posts = mysqli_query($conn, $delete_comments_related_to_posts);
                                
                                header("LOCATION: posts.php");
                    
                            }
                      
                      
                            if (isset($_GET['reset'] ) ) {
                                
                                $reset_post_id = $_GET['reset'];
                                
                                $reset_post = "UPDATE posts SET post_view_count = 0 WHERE post_id = {$reset_post_id} "; 
                                
                                $reset_post_view = mysqli_query($conn, $reset_post);
                                
                                header("LOCATION: posts.php");
                            }
                      
                      
                      
                      ?>

        </tbody>


    </table>


</form>