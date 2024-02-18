<?php
require_once('scripts/SectionManager.php');

$sectionManager = new SectionManager($conn);
$sections = $sectionManager->get();

$msg = '';
$errMsg = '';
$id = null;

if (isset($_GET['id'])) {
    $id = $_GET['id'];
}



?>
<div class="row">
    <div class="col-sm-6">
        <h3 class="mb-4 text-uppercase text-success font-weight-bold">Section N°01</h3>
    </div>
    <div class="col-sm-6 text-end">
    <a href="dashboard.php?page=section-list" class="btn btn-success">
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
                <th>Texte</th>
                <th colspan="2" class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (!empty($sections)) {
                $sn = 1;
                foreach ($sections as $data) {
            ?>
    <tr>
    <td><?= $sn; ?></td>
    <td><img src="public/images/section01/<?= $data['image']; ?>" width="100px"></td>
    <td><?= $data['texte']; ?></td>
    <td class="text-center">
        <a href="dashboard.php?page=section-list&id=<?= $data['id']; ?>" class="text-success">
      
                <i class="fa fa-edit"></i> <!-- Update Icon Only -->
         
        </a>
    </td>
    <td class="text-center">
        <a href="javascript:void(0)" onclick="confirmSectionDelete(<?=$data['id']; ?>)" class="text-danger">
           
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
                    <td colspan="3">Pas de sections</td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>
<script src="public/js/ajax/delete-section.js"></script>
