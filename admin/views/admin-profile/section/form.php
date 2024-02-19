<?php
require_once('scripts/Section02.php');
$adminProfile = new Section($conn);

$msg = '';
$errMsg = '';
$id = null;

if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

/* update admin profile  */
if (isset($_POST['update'])) {
    $firstName = $_POST['firstName'];
    $update = $adminProfile->updateById($id, $firstName);
    if ($update['success']) {
        $msg = "Admin Profile is updated successfully";
        // Toast Notification for Update Success
        echo '<script>';
        echo 'alert("Modifié avec succès!");';
        echo 'window.location.href = "http://localhost/badwaproject/admin/dashboard.php?page=section02";';
        echo '</script>';
        exit();
    }

    if ($update['uploadProfileImage']) {
        $profileImageErr = $update['uploadProfileImage'];
    }

    if ($update['errMsg']) {
        $firstNameErr = $update['errMsg']['firstName'];
    }
}

/* edit admin profile */
if ($id) {
    $getAdminProfile = $adminProfile->getById($id);
}
?>

<div class="row">
    <div class="col-sm-6">
     <h3 class="mb-4">Modifier</h3>
     <?php echo $msg; ?>
    </div>
    <div class="col-sm-6 text-end">
        <a href="dashboard.php?page=section02" class="btn btn-success">Images</a>
    </div>
</div>


<form method="post" enctype="multipart/form-data">
    <div class="mb-3 mt-3">
    <label>titre</label>
      <input type="text" class="form-control" name="firstName" value="<?= $getAdminProfile['firstName'] ?? ''; ?>">
       <p class="text-danger"><?= $firstNameErr ?? ''; ?></p>
       <label > Image</label>
        <input type="file" class="form-control" name="profileImage" >
        <?php 
         if(isset($getAdminProfile['profileImage'])){

        ?>
            <img src="public/images/section02/<?=$getAdminProfile['profileImage']; ?>" width="100px">
        <?php
        }
        ?>
        
        <p class="text-danger"><?=  $profileImageErr ?? ''; ?></p>

    </div>

    <button type="submit" class="btn btn-success" name="<?= $id ? 'update' : 'create'; ?>">Sauvgarder</button>
  </form>