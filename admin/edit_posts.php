
<?php 
if (isset($_GET['case'])){
    
    $post_id = $_GET['post_id'];    
    
    echo "<div class='alert alert-success'>Post Successfully Updated<a href='../post.php?p_id=$post_id'> Veiw current Post</a> / <a href='posts.php'>View more posts</a></div>";
    
}

if (isset($_GET['edit_post'])){

        $edit_post_id = $_GET['edit_post'];
    
        $edit_post_query = "SELECT * FROM posts WHERE post_id = {$edit_post_id} ";
    
        $edit_post_query_result = mysqli_query($conn, $edit_post_query);
    
    if ($edit_post_query_result) {
    
        while ($row_edit = mysqli_fetch_assoc($edit_post_query_result) ) {
    
            $post_title = $row_edit['post_title'];
            $post_category = $row_edit['post_category'];
            $post_author = $row_edit['post_author'];
            $post_status = $row_edit['post_status'];
            $post_date = $row_edit['post_date'];
    
            $post_image = $row_edit['post_image'];
 
            $post_tags = $row_edit['post_tags'];
            $post_content = $row_edit['post_content'];
            $post_comment_count = $row_edit['post_comment_count'];
            
            ?>

            <form action="" method="post" enctype="multipart/form-data">

        
            <div class="form-group">
                <label for="post_title">Post Title</label>
                <input type="text" name="post_title" class="form-control" id="title" value="<?php echo $post_title; ?>">
            </div>


            <div class="form-group">
                <label class="input-group-text" for="post_category">Post Category</label><br>
                <select name="post_category" id="post_category">
                    
                    <option selected disabled><?php echo $post_category; ?></option>

                <?php 

                $choose_category_query = "SELECT * FROM categories";

                $choose_category_query_result = mysqli_query($conn, $choose_category_query);

                while ($row_choose = mysqli_fetch_assoc($choose_category_query_result) ) {

                $cat_title = $row_choose['cat_title'];
                $cat_id = $row_choose['cat_id'];

                ?>

                <option value="<?php echo $cat_id; ?>"><?php echo $cat_title; ?></option>

                <?php   

                }

                ?>

                </select>

            </div>



            <div class="form-group">
                <div class="input-group mb-3">

                    <div class="input-group-prepend">
                    <label class="input-group-text" for="post_status">Post Status: <?php echo $post_status; ?></label>
                    </div>

                    <select class="custom-select" id="post_status" name="post_status">

                    <option value="" selected disabled hidden>Commit..</option>
                    <option value="Draft">Draft</option>
                    <option value="Published">Published</option>
                    <option value="Do not care">Do not care</option>

                </select>

                </div>
            </div>



            <div class="form-group">
                <label for="post_author">Post Author</label>
                <input type="text" name="post_author" class="form-control" id="post_author" value="<?php echo $post_author; ?>">
            </div>


            <div class="form-group">
                <img width="100" src="../images/<?php echo $post_image; ?>" alt="">
                <input type="file" name="post_image">
            </div>


            <div class="form-group">
                <label for="post_tags">Post Tags</label>
                <input type="text" name="post_tags" class="form-control" id="post_tags" value="<?php echo $post_tags; ?>">
            </div>


            <div class="form-group">
                <label for="post_content">Post Content</label>
                <textarea id="body" name="post_content" class="form-control"><?php echo $post_content; ?></textarea>
            </div>


                <script>
        ClassicEditor
            .create( document.querySelector( '#body' ) )
            .catch( error => {
                console.error( error );
            } );
        </script>

                
                
            <div class="form-group">

                <input class="btn btn-primary" type="submit" name="update_post" Value="Update Post">

            </div>

            </form>

            
     <?php   }
        
    } else {
        
        die ("ERROR FETCHING UPDATE INFORMATION " . mysqli_error($conn));
        
    }

}

if(isset($_POST['update_post'] ) ) {
    
        $update_title = $_POST['post_title'];
        $update_category_id = $_POST['post_category'];
        $update_author = $_POST['post_author'];
        $update_status = $_POST['post_status'];
        $update_image = $_FILES['post_image']['name'];
        $update_image_temp = $_FILES['post_image']['tmp_name'];
        $update_tags = $_POST['post_tags'];
        $update_comments = mysqli_real_escape_string ($conn, $_POST['post_content']);
 
          
        if (!empty($update_status)){
            
            $role = "SELECT user_role FROM users";
            
            $role_result = mysqli_query($conn, $role);
            
            $row = mysqli_fetch_array($role_result);
            
            $update_status = $row['post_status'];
            
        }
    
    
        if(empty($update_image)){
            
            $query_image = "SELECT * FROM posts WHERE post_id = {$edit_post_id} ";
            
            $select_image = mysqli_query($conn, $query_image);
            
            $row_image = mysqli_fetch_assoc($select_image);
                
            $update_image = $row_image['post_image'];
                
            
        } else {
            
            move_uploaded_file($update_image_temp, "../images/$update_image");
            
        }
    
    
    
    
        $update_query = "UPDATE posts SET ";
        $update_query .= "post_title = '{$update_title}', ";
        $update_query .= "post_category_id = {$update_category_id}, ";
        $update_query .= "post_author = '{$update_author}', ";
        $update_query .= "post_status = '{$update_status}', ";
        $update_query .= "post_image = '{$update_image}', ";
        $update_query .= "post_content = '{$update_comments}', ";
        $update_query .= "post_date = now(), ";
        $update_query .= "post_tags = '{$update_tags}' ";
        $update_query .= "WHERE post_id = '{$edit_post_id}' ";
    
        $update_post_result = mysqli_query($conn, $update_query);
    
    if(!$update_post_result) {
        
        die("ERROR UPDATING POSTS" . mysqli_error($conn));
        
    } else {
        
        header("LOCATION: posts.php?edit_post=$edit_post_id&source=edit_post&case=updated&post_id=$edit_post_id");

    }
    
}

?>