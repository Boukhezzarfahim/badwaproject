
<?php
require_once('scripts/SectionManager.php');
$sectionManager = new SectionManager($conn);


$msg = '';
$errMsg = '';
$id = null;

if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

/* create or update section */
if (isset($_POST['create']) || isset($_POST['update'])) {
    if (isset($_POST['create']) || isset($_POST['update'])) {
        $image = isset($_FILES['image']) ? $_FILES['image']['name'] : '';
        $texte = $_POST['texte'];
    
        if (isset($_POST['create'])) {
            $result = $sectionManager->create($image, $texte);
        } elseif (isset($_POST['update'])) {
            $result = $sectionManager->updateById($id, $image, $texte);
        }
    }

    if ($result['success']) {
        echo '<script>';
        if (isset($_POST['create'])) {
            echo 'alert("Ajouté avec succès!");';
            echo 'window.location.href = "http://localhost/badwaproject/admin/dashboard.php?page=section-list";';
        } elseif (isset($_POST['update'])) {
            echo 'alert("Modifié avec succès!");';
            echo 'window.location.href = "http://localhost/badwaproject/admin/dashboard.php?page=section-form";';
        }
        echo '</script>';
        exit();
    }
    
    

    if (isset($result['uploadProfileImage'])) {
        $profileImageErr = $result['uploadProfileImage'];
    }

    if (isset($result['errMsg'])) {
        $imageErr = $result['errMsg']['image'];
        $texteErr = $result['errMsg']['texte'];
    }
}

/* edit section */
if ($id) {
    $getSection = $sectionManager->getById($id);
}
?>
<div class="row">
<div class="col-sm-6">
    <h3 class="mb-4 text-uppercase text-success font-weight-bold">Section N°01</h3>
    <?php echo $msg; ?>
</div>
    <div class="col-sm-6 text-end">
        <a href="dashboard.php?page=section-form" class="btn btn-success">Images</a>
    </div>
</div>

<form method="post" enctype="multipart/form-data">
    <div class="mb-3 mt-3">
        <label>Image</label>
        <input type="file" class="form-control" name="image">
        <?php
        if (isset($getSection['image'])) {
        ?>
            <img src="../admin/public/images/section01/<?= $getSection['image']; ?>" width="100px">
        <?php
        }
        ?>
        <p class="text-danger"><?= $imageErr ?? ''; ?></p>

        <label>Texte</label>
        <textarea class="form-control" name="texte"><?= $getSection['texte'] ?? ''; ?></textarea>
        <p class="text-danger"><?= $texteErr ?? ''; ?></p>
    </div>

    <button type="submit" class="btn btn-success" name="<?= $id ? 'update' : 'create'; ?>" onclick="insertSectionData()">
   
     Sauvegarder
</button>


</form>
