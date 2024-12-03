<?php
include('db.php');
if (isset($_GET['delete'])) {
    $item_id = $_GET['delete'];
    $delete_sql = "DELETE FROM add_item WHERE id = $item_id";
    if ($con->query($delete_sql) === TRUE) {
    
        header("Location: itemlist.php?message=delete_success");
        exit();
    } else {
        echo "Error deleting record: " . $con->error;
    }
}
?>
      