<?php
require_once('scripts/Section03.php');
$section03 = new Section03($conn);

$msg = '';
$errMsg = '';
$id = null;

if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

/* create or update section */
if (isset($_POST['create']) || isset($_POST['update'])) {
    $title = $_POST['title'];
    if (isset($_POST['create']) || isset($_POST['update'])) {
        $image = isset($_FILES['image']) ? $_FILES['image']['name'] : '';
        $description = $_POST['description'];
        $position = isset($_POST['position']) ? $_POST['position'] : 0;

        if (isset($_POST['create'])) {
            $result = $section03->create($title, $image, $description, $position);
        } elseif (isset($_POST['update'])) {
            $result = $section03->updateById($id, $title, $image, $description, $position);
        }
    }

    if ($result['success']) {
        echo '<script>';
        if (isset($_POST['create'])) {
            echo 'alert("Ajouté avec succès!");';
            echo 'window.location.href = "http://localhost/badwaproject/admin/dashboard.php?page=section03";';
        } elseif (isset($_POST['update'])) {
            echo 'alert("Modifié avec succès!");';
            echo 'window.location.href = "http://localhost/badwaproject/admin/dashboard.php?page=section03";';
        }
        echo '</script>';
        exit();
    }

    if (isset($result['uploadImage'])) {
        $imageErr = $result['uploadImage'];
    }

    if (isset($result['errMsg'])) {
        $imageErr = $result['errMsg']['image'];
        $descriptionErr = $result['errMsg']['description'];
    }
}

/* edit section */
if ($id) {
    $getSection = $section03->getById($id);
    $title = $getSection['title'];
}
?>

<div class="row">
    <div class="col-sm-6">
        <h3 class="mb-4 text-uppercase text-success font-weight-bold">Section N°03</h3>
        <?php echo $msg; ?>
    </div>
    <div class="col-sm-6 text-end">
        <a href="dashboard.php?page=section03" class="btn btn-success">Images</a>
    </div>
</div>

<form method="post" enctype="multipart/form-data">
    <div class="mb-3 mt-3">
        <label>Titre</label>
        <input type="text" class="form-control" name="title" value="<?= $title ?? ''; ?>">
        <p class="text-danger"><?= $titleErr ?? ''; ?></p>

        <label>Image</label>
        <input type="file" class="form-control" name="image">
        <?php
        if (isset($getSection['image'])) {
        ?>
            <img src="../admin/public/images/section03/<?= $getSection['image']; ?>" width="100px">
        <?php
        }
        ?>
        <p class="text-danger"><?= $imageErr ?? ''; ?></p>

        <label>Description</label>
        <textarea class="form-control" name="description"><?= $getSection['description'] ?? ''; ?></textarea>
        <p class="text-danger"><?= $descriptionErr ?? ''; ?></p>

        <label>Position</label>
        <input type="number" class="form-control" name="position" value="<?= $getSection['position'] ?? ''; ?>">
    </div>

    <button type="submit" class="btn btn-success" name="<?= $id ? 'update' : 'create'; ?>" onclick="insertSectionData()">
        Sauvegarder
    </button>
</form>
