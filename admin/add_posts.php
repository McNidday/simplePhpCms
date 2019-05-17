<?php 

    if (isset($_POST['create_post'])){
        
        $post_category_id = $_POST['post_category_id'];
        $query_for_category = "SELECT cat_title FROM categories WHERE cat_id = {$post_category_id}";
        $query_for_category_result = mysqli_query($conn, $query_for_category);
        $the_category = mysqli_fetch_assoc($query_for_category_result);
        
        
        $cat = mysqli_real_escape_string ($conn, $the_category['cat_title']);
        $post_title =$_POST['post_title'];

        $post_author = $_POST['post_author'];
        $post_status = $_POST['post_status'];
        
        $post_image = $_FILES['post_image']['name'];
        $post_image_temp = $_FILES['post_image']['tmp_name'];
        
        $post_content = mysqli_real_escape_string($conn, $_POST['post_content']);
        $post_tags = $_POST['post_tags'];
        $post_date = date('d-m-y');
        $post_comment_count = 0;
        $post_view_count = 0;
        
        move_uploaded_file($post_image_temp, "../images/$post_image");
        
        $query = "INSERT INTO posts(post_id, post_title, post_category, post_category_id, post_author, post_status, post_image, post_content, post_tags, post_date, post_comment_count, post_view_count) ";
        
        $query .= "VALUES(NULL, '{$post_title}', '{$cat}', {$post_category_id}, '{$post_author}', '{$post_status}', '{$post_image}', '{$post_content}', '{$post_tags}', now(), {$post_comment_count}, {$post_view_count}) ";
        
        $query_result = mysqli_query($conn, $query);
        
        
            /*CONFIRM QUERY POR FAVOR*/
            
            confirm_query($query_result, " POSTS");
            
        
        
    }


?>


   

   <form action="" method="post" enctype="multipart/form-data">
    
    <div class="form-group">
        <label for="post_title">Post Title</label>
        <input type="text" name="post_title" class="form-control" id="title">
    </div>
    
     <div class="form-group">
        <label class="input-group-text" for="post_category">Post Category</label><br>
                <select name="post_category_id" id="post_category_id">

                <?php 

                $choose_category_query = "SELECT * FROM categories";

                $choose_category_query_result = mysqli_query($conn, $choose_category_query);

                while ($row_choose = mysqli_fetch_assoc($choose_category_query_result) ) {
                    
                    global $cat_title;
                    
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
        <label class="input-group-text" for="post_author">Post Author</label><br>
                <select name="post_author" id="post_author">

                <?php 

                $choose_users_query = "SELECT * FROM users";

                $choose_users_query_result = mysqli_query($conn, $choose_users_query);

                while ($row_choose = mysqli_fetch_assoc($choose_users_query_result) ) {
                    
                $user_title = $row_choose['user_name'];
                $user_id = $row_choose['user_id'];

                ?>

                <option value="<?php echo $user_title; ?>"><?php echo $user_title; ?></option>

                <?php   

                }

                ?>

                </select>
       </div>
    
       
       
     <!--<div class="form-group">
        <label for="post_author">Post Author</label>
        <input type="text" name="post_author" class="form-control" id="post_author">
    </div>-->

       
     <div class="form-group">
        <div class="input-group mb-3">
        
            <div class="input-group-prepend">
            <label class="input-group-text" for="post_status">Post Status</label>
            </div>
            
            <select class="custom-select" id="post_status" name="post_status">
               
                <option selected disabled>Choose...</option>
                <option value="Draft">Draft</option>
                <option value="Published">Published</option>
                <option value="Do not care">Do not care</option>
                
            </select>
  
        </div>
    </div>
    
    <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" name="post_image" id="post_image">
    </div>
    
    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" name="post_tags" class="form-control" id="post_tags">
    </div>
    
    <div class="form-group">
        <label for="body">Post Content</label>
        <textarea id="body" name="post_content" class="form-control"></textarea>
    </div>
         
         
         
        <script>
        ClassicEditor
            .create( document.querySelector( '#body' ) )
            .catch( error => {
                console.error( error );
            } );
        </script>

         
    <div class="form-group">
        
        <input class="btn btn-primary" type="submit" name="create_post" Value="Publish Post">
        
    </div>
    
</form>