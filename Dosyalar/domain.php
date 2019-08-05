<?php 
include 'header.php';
$domainsor=$db->prepare("SELECT * FROM domain WHERE domain_id={$_POST['domain_id']}");
$domainsor->execute();
$domaincek=$domainsor->fetch(PDO::FETCH_ASSOC);
?>
<!-- Begin Page Content -->
<div class="container">
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h5 class="m-0 font-weight-bold text-primary">Domain</h5>
    </div>
    <div class="card-body">
      <form action="islemler/islem.php" method="POST" enctype="multipart/form-data">
        <div class="form-row">
          <div class="form-group col-md-4">
            <label>Domain Adı</label>
            <input disabled="" type="text" class="form-control" name="domain_adi" placeholder="Domain Adı" value="<?php echo $domaincek['domain_adi'] ?>">
          </div>
          <div class="form-group col-md-4">
            <label>Müşteri</label>
            <select disabled="" class="form-control" name="domain_musteri">
             <?php 
             $musteri=$db->prepare("SELECT * FROM musteri");
             $musteri->execute();
             while ($mustericek=$musteri->fetch(PDO::FETCH_ASSOC)) {?>
              <option <?php if ($mustericek['musteri_id']==$domaincek['domain_musteri']){echo "selected";} ?> value="<?php echo $mustericek['musteri_id']; ?>"><?php echo $mustericek['musteri_adi']; ?></option>
            <?php } ?>
          </select>
        </div>
        <div class="form-group col-md-4">
          <label>Domain Başlangıç</label>
          <input disabled="" type="date" class="form-control" name="domain_baslangic" placeholder="Domain Başlangıç" value="<?php echo $domaincek['domain_baslangic'] ?>">
        </div>
      </div>
      <div class="form-row">
       <div class="form-group col-md-4">
        <label>Domain Kayıt Firması <small>(Örn:Godaddy)</small></label>
        <input disabled="" type="text" class="form-control" name="domain_kayit_firmasi" placeholder="Domain Kayıt Firması" value="<?php echo $domaincek['domain_kayit_firmasi'] ?>">
      </div> 
      <div class="form-group col-md-4">
        <label>Domain Bitiş</label>
        <input disabled="" type="date" class="form-control" name="domain_bitis" placeholder="Domain Bitiş" value="<?php echo $domaincek['domain_bitis'] ?>">
      </div>
      <div class="form-group col-md-4">
        <label>Fiyat</label>
        <input disabled="" type="text" class="form-control" name="domain_fiyat" placeholder="Domain Başlangıç" value="<?php echo $domaincek['domain_fiyat'] ?>">
      </div>                           
    </div>    

    <button type="submit" name="domainguncelle" class="btn btn-primary">Kaydet</button>
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
