<?php
require_once('../../../database.php');
require_once('../SectionManager.php');

 /* delete category */
 if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $section = new SectionManager($conn);
    $delete = $section->deleteById($id);
    echo $delete;
  }

?>