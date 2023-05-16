<?php
include_once("../../config/database.php");

session_start();

if ($_SESSION['username'] == "") {
  header('location:../../index.php');
}

if (isset($_POST['submit'])) {
  $kat_name = htmlspecialchars($_POST['kategori']);

  if (empty($kat_name)) {
    echo "<script> alert('Nama Kategori Tidak Boleh Kosong')</script>";
  } else {
    $insert = $pdo->prepare("INSERT INTO tb_category (nm_cat) value(:cat)");
    $insert->bindParam(':cat', $kat_name);

    if ($insert->execute()) {
      echo "<script> alert(Kategori Berhasil Ditambahkan) </script>";
    } else {
      echo "<script> alert('Data Tidak Berhasil Ditambah')</script>";
    }
  }
}

include_once("../inc/header.php");

?>

<?php
include_once("../inc/admin_sidebar.php");
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Category</h1>
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

    <div class="d-flex justify-content-between">
      <div class="col">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Category List</h3>

            <div class="card-tools">
              <div class="input-group input-group-sm" style="width: 150px;">
                <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                <div class="input-group-append">
                  <button type="submit" class="btn btn-default">
                    <i class="fas fa-search"></i>
                  </button>
                </div>
              </div>
            </div>
          </div>
          <div class="card-body p-0">
            <table class="table table-responsive-md table-hover text-nowrap">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Nama Kategori</th>
                  <th>Pilihan</th>
                </tr>
              </thead>
              <div class="card-body">
                <tbody>
                  <?php
                  $no = 1;
                  $sql = "SELECT * FROM tb_category";
                  $stmt = $pdo->query($sql);
                  while ($row = $stmt->fetch()) {
                    $id = $row["id"];
                    $cat = $row["nm_cat"];

                  ?>
                    <tr>
                      <td>
                        <?= $no++ ?>
                      </td>
                      <td>
                        <?= $cat ?>
                      </td>
                      <td>
                        <a class="btn btn-info btn-sm" href="update.php?id=<?= $id; ?>">Edit</a>
                        <a class="btn btn-danger btn-sm" href="delete.php?id=<?= $id; ?>">Delete</a>
                      </td>
                    </tr>
                  <?php } ?>
                </tbody>
            </table>
            <!-- <div class="d-flex justify-content-between"> -->
            <nav aria-label="Page navigation example">
              <ul class="pagination mt-3 mx-3">
                <li class="page-item disabled">
                  <a class="page-link" href="#" tabindex="-1">Previous</a>
                </li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                  <a class="page-link" href="#">Next</a>
                </li>
              </ul>
            </nav>
            <!-- </div> -->
          </div>
          <!-- /.card-body -->
          <div class="add-category">

          </div>
        </div>
      </div>


      <div class="col-sm-4">
        <div class="card">
          <div class="card-header bg-primary">
            <h3 class="card-title">Tambah Kategori</h3>
          </div>
          <form action="" method="POST">
            <div class="card-body">
              <label for="kat_name">Nama Kategori</label>
              <input name="kategori" type="text" class="form-control" id="kat_name">
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
              <button type="submit" name="submit" class="btn btn-primary">Tambah</button>
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