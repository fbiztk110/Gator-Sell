<?php
    $db = mysqli_connect('localhost', 'root', '', 'finalproject');
    
    $id = $_GET['id'];
    // debug_to_console($id);
    mysqli_query($db, "DELETE FROM post WHERE id ='$id'");
?>
<script type="text/javascript">
window.location="manage.php";
</script>