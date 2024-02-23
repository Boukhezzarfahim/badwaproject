<?php
require_once('../../../database.php');
require_once('../Section03.php');

 /* delete category */
 if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $section03 = new Section03($conn);
    $delete = $section03->deleteById($id);
    echo $delete;
  }

?>