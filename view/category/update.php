<?php
include_once("../../config/database.php");

session_start();

if ($_SESSION['username'] == "") {
  header('location:../../index.php');
}

$queryId = $_GET['id'];

include_once("../inc/header.php");

if (isset($_POST['update'])) {
  $kat_name = htmlspecialchars($_POST['kategori']);

  $sql = "UPDATE tb_category SET nm_cat='$kat_name' WHERE id='$queryId'";
  $result = $pdo->query($sql);

  if ($result) {
    echo "<script> alert('Data Berhasil Di Perbaharui') </script>";
  } else {
    echo "<script> alert('Data Tidak Dapat Diperbaharui')</script>";
  }
}


?>

<?php
include_once("../inc/admin_sidebar.php");
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <?php
  $sql = "SELECT * FROM tb_category WHERE id='$queryId'";
  $stmt = $pdo->query($sql);
  while ($rows = $stmt->fetch()) {
    $cat = $rows["nm_cat"];
  }
  ?>
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Category Update</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Blank Page</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->

    <div class="col">
      <div class="col-md-6 mx-auto">
        <div class="card">
          <div class="card-header bg-primary">
            <h3 class="card-title">Edit Kategori Kategori</h3>
          </div>
          <form action="" method="POST">
            <div class="card-body">
              <label for="kat_name">Nama Kategori</label>
              <input name="kategori" type="text" class="form-control" id="kat_name" value="<?= $cat ?>">
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
              <button type="submit" name="update" class="btn btn-primary">Update</button>
              <a href="index.php" class="btn btn-info">Back</a>
            </div>
          </form>
          <!-- /.card-footer-->
        </div>
      </div>
    </div>
    <!-- /.card -->

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

</div>
<!-- ./wrapper -->

<?php
include_once("../inc/footer.php");
?>