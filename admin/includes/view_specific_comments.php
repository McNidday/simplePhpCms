<table class="table table-bodered table-hover">


    <thead>

        <thead>
            <tr>
                <th>Id</th>
                <th>Author</th>
                <th>Comment</th>
                <th>Email</th>
                <th>Status</th>
                <th>Responce To</th>
                <th>Date</th>
                <th>Approve</th>
                <th>Decline</th>
                <th>Delete</th>
            </tr>
        </thead>




    </thead>

    <tbody>
        <?php 
        
        if (isset($_GET['comment_id'])){
            
            $comment_id = $_GET['comment_id'];
            
            
                            $query_display_comments = "SELECT * FROM comments WHERE comment_post_id = {$comment_id}";
                    
                            $query_display_comments = mysqli_query($conn, $query_display_comments);
                       
                            if (!$query_display_comments){
                                
                                die("ERROR FETCHING POSTS" . mysqli_error($conn));
                                
                            } else {
                                
                                while ($row_display_comments = mysqli_fetch_assoc($query_display_comments)){
                                    
                                    $comment_id = $row_display_comments['comment_id'];
                                    
                                    $comment_post_id = $row_display_comments['comment_post_id'];
                                   
                                    $comment_author = $row_display_comments['comment_author'];
                                    
                                    $comment_email = $row_display_comments['comment_email'];
                                    
                                    $comment_content = substr($row_display_comments['comment_content'], 0, 50) . "...";
                                    
                                    $comment_status = $row_display_comments['comment_status'];
                                    
                                    $comment_date = $row_display_comments['comment_date'];
                                    
            
        }
                    
                            ?>

        <tr>

            <td>
                <?php echo $comment_id; ?>
            </td>
            <td>
                <?php echo $comment_author; ?>
            </td>
            <td>
                <?php echo $comment_content; ?>
            </td>

            <td>
                <?php echo $comment_email; ?>
            </td>

            <td>
                <?php echo $comment_status; ?>
            </td>

            <?php 
                                     
                                     $query = "SELECT * FROM posts WHERE post_id = {$comment_post_id}";
                                    
                                     $select_post_id_query = mysqli_query($conn, $query);
                                    
                                    while ($row = mysqli_fetch_assoc($select_post_id_query)){
                                        
                                        $post_id = $row['post_id'];
                                        $post_title = $row['post_title'];
                                        
                                        echo "<td><a href = '../post.php?p_id=$post_id'>$post_title</a></td>";
                                        
                                    }
                                     
                                     ?>


            <td>
                <?php echo $comment_date; ?>
            </td>

            <td><a href="comments.php?approve_comment=<?php echo $comment_id; ?>" type="button" class="btn btn-default btn-primary btn-md"><span class="glyphicon glyphicon-thumbs-up"></span></a></td>

            <td><a href="comments.php?decline_comment=<?php echo $comment_id; ?>" type="button" class="btn btn-default btn-danger btn-md"><span class="glyphicon glyphicon-thumbs-down"></span></a></td>

            <td><a href="comments.php?delete_comment=<?php echo $comment_id; ?>" type="button" class="btn btn-default btn-danger btn-md"><span class="glyphicon glyphicon-trash"></span></a></td>


        </tr>

        <?php      }
                                
                            }
                    
                       ?>



        <?php 
                      
                        if (isset($_GET['approve_comment'])){
                            
                            $approve_comment_id = $_GET['approve_comment'];
                            
                            $approve_query = "UPDATE comments SET comment_status = 'Approved' WHERE comment_id = {$approve_comment_id} ";
                            
                            $approve_query_result = mysqli_query($conn, $approve_query);
                            
                             header("LOCATION: comments.php");
        
                        } else if (isset($_GET['decline_comment'])){
                            
                            $decline_comment_id = $_GET['decline_comment'];
                            
                            $decline_query = "UPDATE comments SET comment_status = 'UnApproved' WHERE comment_id = {$decline_comment_id} ";
                            
                            $decline_query_result = mysqli_query($conn, $decline_query);
                            
                                                    
                            header("LOCATION: comments.php");
                        }
                      
      
                      
                       ?>

        <?php 
                      
                            if (isset($_GET['delete_comment'] ) ) {
                                
                                $delete_comment_id = $_GET['delete_comment'];
                                
                                $delete_comment_query = "DELETE FROM comments WHERE comment_id = {$delete_comment_id} ";
                                
                                $delete_comment_query_result = mysqli_query($conn, $delete_comment_query);
                                
                                confirm_query($delete_comment_query_result, " DELETING COMMENTS");
                                
                                header("LOCATION: comments.php");
                    
                            }
                      
                      
                      ?>



    </tbody>

</table>