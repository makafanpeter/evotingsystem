<?php

 require('config.php');
if ($_POST['id']) {
    $id = $_POST['id'];
    $sql = mysql_query("select * from faculties where University_id ='$id' ");
    echo '<option selected="selected">--Select Faculty--</option>';
    while ($row = mysql_fetch_array($sql)) {
        echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
    }
}
mysql_close($con);
?>
