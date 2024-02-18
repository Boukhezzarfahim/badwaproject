<?php

require_once('scripts/Section02.php');

$produit = new Section($conn);
$produitlist = $produit->get();

?>
<div class="row">
  <div class="col-sm-6">
    <h3 class="mb-4">SECTION N°02</h3>
  </div>
</div>

<div class="table-responsive">
  <table class="table table-hover">
    <thead>
      <tr>
        <th>S.N</th>
        <th>section photo</th>
        <th>disc</th>
        <th>modifier</th>
      </tr>
    </thead>
    <tbody>
      <?php
      if (!empty($produitlist)) {

        $sn = 1;
        foreach ($produitlist as $data) {
      ?>
          <tr>
            <td><?= $sn; ?></td>
            <td><img src="public/images/section02/<?= $data['profileImage']; ?>" width="100px"></td>
            <td><?=
                $data['firstName'];

                ?></td>
            <td class="text-center">
              <a href="dashboard.php?page=section-form02&id=<?= $data['id']; ?>" class="text-success">
                <i class="fa fa-edit"></i>
              </a>
            </td>
          </tr>
        <?php
          $sn++;
        }
      } else {
        ?>
        <tr>
          <td colspan="3">No category Found</td>

        </tr>
      <?php } ?>


    </tbody>
  </table>
</div>