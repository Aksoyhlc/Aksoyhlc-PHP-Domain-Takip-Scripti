<?php 
include 'header.php';

?>
<!-- Begin Page Content -->
<div class="container">
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h5 class="m-0 font-weight-bold text-primary">Müşteri Ekle</h5>
    </div>
    <div class="card-body">
      <form action="islemler/islem.php" method="POST" enctype="multipart/form-data">
        <div class="form-row">
          <div class="form-group col-md-6">
            <label>Müşteri Adı</label>
            <input type="text" class="form-control" name="musteri_adi" placeholder="Müşteri Adı">
          </div>
          <!-- <div class="form-group col-md-6">
            <label>Müşteri Yetkilisi</label>
            <input type="text" class="form-control" name="musteri_yetkili" placeholder="Müşteri Yetkilisi">
          </div> -->
          <div class="form-group col-md-6">
            <label>Müşteri Telefon</label>
            <input type="text" class="form-control" name="musteri_telefon" placeholder="Müşteri Telefon">
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label>Müşteri Mail</label>
            <input type="email" class="form-control" name="musteri_mail" placeholder="Müşteri Mail">
          </div>
          <div class="form-group col-md-6">
            <label>Müşteri Not</label>
            <textarea id="editor" name="musteri_not"></textarea>
          </div>
        </div>        
        <button type="submit" name="musteriekle" class="btn btn-primary">Kaydet</button>
      </form>
    </div>
  </div>
</div>
<!-- End of Main Content -->
<?php include 'footer.php' ?>
<script src="ckeditor/ckeditor.js"></script>
<script>
 CKEDITOR.replace('editor');
</script>
