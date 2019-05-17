<?php 


function insert_categories (){
    
    global $conn;
    
    if (isset($_POST['addcat'])) {

    $cat_title = mysqli_real_escape_string ($conn, $_POST['cat_title']);

        if (empty($cat_title)) {

        echo "<div class='alert alert-info'>LIKE SERIOUSLY</div>" . $cat_title;

        } else {

        $query_verify = "SELECT cat_title FROM categories WHERE cat_title = '$cat_title'";

        $query_verify_result = mysqli_query($conn, $query_verify);

            if ( mysqli_num_rows ( $query_verify_result ) <= 0) {

            $query_cat = "INSERT INTO categories (cat_id, cat_title) VALUE (NULL, '{$cat_title}')";

            $query_cat_result = mysqli_query($conn, $query_cat);

                if ($query_cat_result){

                echo "<div class='alert alert-success'>CATEGORY ADDED TO DATABASE</div>";

                } else {

                die ("ERROR ADDING CATEGORY " . mysqli_error($conn));

                }


            } else {

            echo "<div class='alert alert-warning'>BRAAAH DAT EXISTS!!</div>";

        }

    }

    }


}

function update_categories (){
    
    global $conn;
    

    if(isset($_GET['update'])){
  
    $category_update = $_GET['update_cat'];

    $category_update_id = $_GET['update_category_id'];

    $update_query = "UPDATE categories SET cat_title = '{$category_update}' WHERE cat_id = {$category_update_id} ";

    $update_query_result = mysqli_query($conn, $update_query);

        if (!$update_query_result){

        die("FAILED UPDATING QUERY" . mysqli_error($conn));

        } else {

        echo "<div class='alert alert-success'>CATEGORY UPDATED SUCCESSFULY ... NOW SHAKE YOUR BOOTY</div>";

    }
}




}

function delete_categories (){
    
     global $conn;
    
    if (isset($_GET['delete'])){

    $the_delete_id = $_GET['delete'];

    $delete_query = "DELETE FROM categories WHERE cat_id = {$the_delete_id}";

    $delete_query_result = mysqli_query($conn, $delete_query);

    header("LOCATION: categories.php");

}


}

function display_category_data (){
    
    global $conn;
    
    $cat_egory = "SELECT * FROM categories";

    $result_cat_egory = mysqli_query($conn, $cat_egory);


        if ($result_cat_egory){

            while ($row_cat_egory = mysqli_fetch_assoc($result_cat_egory) ) {

            $cat_title = $row_cat_egory['cat_title'];
            $cat_id = $row_cat_egory['cat_id'];
            ?>

<tr>

    <td>
        <?php echo $cat_id; ?>
    </td>

    <td>
        <?php echo $cat_title; ?>
    </td>

    <td><a href="categories.php?edit=<?php echo $cat_id; ?>" type="button" class="btn btn-default btn-primary btn-md"><span class="glyphicon glyphicon-edit"></span></a></td>

    <td><a href="categories.php?delete=<?php echo $cat_id; ?>" type="button" class="btn btn-default btn-danger btn-md"><span class="glyphicon glyphicon-trash"></span></a></td>

</tr>

<?php }

    }

}

function edit_categories (){
    
    global $conn;
    
    if(isset($_GET['edit'])){

    $update_category_id = $_GET['edit'];

    $update_display_query = "SELECT cat_title FROM categories WHERE cat_id = {$update_category_id} ";

    $display_query_result = mysqli_query($conn, $update_display_query);

        if(!$display_query_result){

        die("DISPLAY SQLI NOT WORKING" . mysqli_error($conn));

        }

            while($row_display = mysqli_fetch_assoc($display_query_result)){

            $cat_display_id = $row_display['cat_title'];

            ?>

<input value="<?php echo $cat_display_id; ?>" type="text" name="update_cat" placeholder="Update Category" class="form-control">

</div>

<div class="form-group">

    <input type="hidden" name="update_category_id" value="<?php echo $update_category_id; ?>">

</div>

<div>

    <button class="btn btn-md btn-primary" name="update" type="submit">Update</button>


    <?php }

    }



}

function confirm_query ($result, $nameofthing){
    
    global $conn;
   
    if (!$result){
                
                die ("ERROR ADDING ".$nameofthing." ". mysqli_error($conn));
                
            } else {
                
                echo "<div class='alert alert-success'>SUCCESS ADDING $nameofthing</a></div>";
                
            }
    
}

function users_online (){
    

if (isset($_GET['onlineUsers'])){

global $conn;

if (!$conn){

session_start();

include "../connection.php";

    $session = session_id();
    $time = time();
    $time_out_inseconds = 60;
    $time_out = $time - $time_out_inseconds;


    $query = "SELECT * FROM users_online WHERE session = '$session'";
    $send_query = mysqli_query($conn, $query);
    $count_row = mysqli_num_rows($send_query);

if($count_row == NULL){

    mysqli_query ($conn, "INSERT INTO users_online (session, time) VALUES('$session', {$time})");

} else {

    mysqli_query ($conn, "UPDATE users_online SET time = '$time' WHERE session = '$session'");

    }

    $online_users = mysqli_query($conn, "SELECT * FROM users_online WHERE time > $time_out ");

    echo $count_users = mysqli_num_rows($online_users);

    }

}
    
    
}

/*users_online();*/
function is_Admin($username = ''){
    global $conn;
    
    $query = "SELECT user_role FROM users WHERE username = '{$username}'";
    
    $results = mysqli_query($conn, $query);
    
    $row = mysqli_fetch_array($results);
    
    if($row['user_role' === 'admin']){
        
        return true;
        
    } else {
        
        return false;
        
    }
}

?>