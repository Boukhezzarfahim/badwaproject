<link href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css" rel="stylesheet">


<?php
  require_once('scripts/AdminAccess.php');
  
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <title>Badwa admins</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/x-icon" href="..\admin\public\images\icon-nav\azul.ico" sizes="32x32 azul.ico">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="public/css/dashboard.css">
  <link rel="stylesheet" href="public/css/common.css">
  <link rel="stylesheet" href="public/css/navbar.css">
  <link rel="stylesheet" href="public/css/sidebar.css">
  
  


</head>
<body>
<style>
 

  </style>



<div class="container-fluid">
 <div class="row">
    <div class="col-sm-3 sidebar-col">
   
     <!-----left sidebar---->
     <?php 
       require_once('views/common/left-sidebar.php');
     ?>
     <!-----left sidebar ---->
   </div>
   <div class="col-sm-9 dashboard-col">
    <!--navbar -->
    <?php 
    require_once('views/common/navbar.php');
    ?>
    <!-- navbar -->
     <!-----dashboard---->
     <div class="dashboard-content">
     <?php
      require_once('../database.php');
      

      if(isset($_GET['page'])) {
        $page = $_GET['page'];
        switch($page) {

          /* Admin Profile*/
          case 'admin-profile-list':
            require_once 'views/admin-profile/table.php';
          break;
          case 'section-list':
            require_once 'views/admin-profile/section.php';
          break;
          case 'section-form':
            require_once 'views/admin-profile/SectionTable.php';
          break;
          
          case 'section02':
            require_once 'views/admin-profile/section/table.php';
            break;

          case 'section-form02':
            require_once 'views/admin-profile/section/form.php';
            break;
      
          case 'section-head-form':
            require_once 'views/admin-profile/sectionheadtable.php';
          break;
          case 'section-head02':
            require_once 'views/admin-profile/sectionheadtable.php';
          break;
          
          case 'section-head-list':
            require_once 'views/admin-profile/sectionheadmanager.php';
          break;

          case 'admin-profile-form':
            require_once 'views/admin-profile/form.php';
          break;
        
          /* Logged In Admin */
          case 'profile':
            require_once 'views/admin-profile/profile.php';
          break;
        

          default:
             echo "<h1 class='text-center mt-4'>404 No Page found</h1>";
        } 

      } else {
            require_once('views/dashboard/intro.php');
            require_once('views/dashboard/support.php');
      }
    ?>
     </div>
     <!-----dashboard ---->
   </div>

 </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="public/js/sidebar-list.js"></script>


</body>
</html>