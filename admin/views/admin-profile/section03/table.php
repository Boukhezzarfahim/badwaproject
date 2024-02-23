<?php
require_once('scripts/Section03.php');  // Assurez-vous que le chemin est correct

$section03 = new Section03($conn);  // Utilisez la classe Section03
$sections03 = $section03->get();

$msg = '';
$errMsg = '';
$id = null;

if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

?>
<div class="row">
    <div class="col-sm-6">
        <h3 class="mb-4 text-uppercase text-success font-weight-bold">Section N°03</h3>
    </div>
    <div class="col-sm-6 text-end">
        <a href="dashboard.php?page=section-form03" class="btn btn-success">
            <i class="fa fa-plus"></i> Ajouter une image
        </a>
    </div>
</div>

<div class="table-responsive-sm">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Title</th>
                <th>Description</th>
                <th>Position</th>
                <th colspan="2" class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (!empty($sections03)) {
                $sn = 1;
                foreach ($sections03 as $data) {
                    ?>
                    <tr>
                        <td><?= $sn; ?></td>
                        <td><img src="public/images/section03/<?= $data['image']; ?>" width="100px"></td>
                        <td><?= $data['title']; ?></td>
                        <td><?= $data['description']; ?></td>
                        <td><?= $data['position']; ?></td>
                        <td class="text-center">
                            <a href="dashboard.php?page=section-form03&id=<?= $data['id']; ?>" class="text-success">
                                <i class="fa fa-edit"></i> <!-- Update Icon Only -->
                            </a>
                        </td>
                        <td class="text-center">
                            <a href="javascript:void(0)" onclick="confirmSectionDelete03(<?= $data['id']; ?>)" class="text-danger">
                                <i class="fa fa-trash-o"></i> <!-- Delete Icon Only -->
                            </a>
                        </td>
                    </tr>
                    <?php
                    $sn++;
                }
            } else {
                ?>
                <tr>
                    <td colspan="6">Pas de sections</td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</div>
<script src="public/js/ajax/delete-section03.js"></script>
