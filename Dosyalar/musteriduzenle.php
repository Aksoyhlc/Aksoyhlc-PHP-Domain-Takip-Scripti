<?php 
include 'header.php';
$musterisor=$db->prepare("SELECT * FROM musteri WHERE musteri_id={$_POST['musteri_id']}");
$musterisor->execute();
$mustericek=$musterisor->fetch(PDO::FETCH_ASSOC);
?>
<!-- Begin Page Content -->
<div class="container">
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h5 class="m-0 font-weight-bold text-primary">Müşteri Düzenle</h5>
    </div>
    <div class="card-body">
      <form action="islemler/islem.php" method="POST" enctype="multipart/form-data">
        <div class="form-row">
          <div class="form-group col-md-6">
            <label>Müşteri Adı</label>
            <input type="text" class="form-control" name="musteri_adi" placeholder="Müşteri Adı" value="<?php echo $mustericek['musteri_adi'] ?>">
          </div>
        <!-- <div class="form-group col-md-6">
            <label>Müşteri Yetkilisi</label>
            <input type="text" class="form-control" name="musteri_yetkili" placeholder="Müşteri Yetkilisi" value="<?php/* echo $mustericek['musteri_yetkili'] */?>">
          </div> -->
          <div class="form-group col-md-6">
            <label>Müşteri Telefon</label>
            <input type="text" class="form-control" name="musteri_telefon" placeholder="Müşteri Telefon" value="<?php echo $mustericek['musteri_telefon'] ?>">
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label>Müşteri Mail</label>
            <input type="email" class="form-control" name="musteri_mail" placeholder="Müşteri Mail" value="<?php echo $mustericek['musteri_mail'] ?>">
          </div>
          <div class="form-group col-md-6">
            <label>Müşteri Not</label>
            <textarea id="editor" name="musteri_not"><?php echo $mustericek['musteri_not'] ?></textarea>
          </div>
        </div>   
        <input type="hidden" name="musteri_id" value="<?php echo $_POST['musteri_id'] ?>">     
        <button type="submit" name="musteriguncelle" class="btn btn-primary">Kaydet</button>
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
