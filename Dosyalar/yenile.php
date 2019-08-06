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
      <h5 class="m-0 font-weight-bold text-primary">Domain Yenile</h5>
    </div>
    <div class="card-body">
      <form action="islemler/islem.php" method="POST">
        <div class="form-row">
          <div class="form-group col-md-4">
            <label>Domain Adı</label>
            <input disabled="" type="text" class="form-control" name="domain_adi" placeholder="Domain Adı" value="<?php echo $domaincek['domain_adi'] ?>">
          </div>
          <div class="form-group col-md-4">
            <label>Domain Başlangıç</label>
            <input disabled="" type="date" class="form-control" name="domain_baslangic" placeholder="Domain Başlangıç" value="<?php echo $domaincek['domain_baslangic'] ?>">
          </div>
          <div class="form-group col-md-4">
            <label>Domain Bitiş</label>
            <input type="date" class="form-control" name="domain_bitis" placeholder="Domain Bitiş" value="<?php echo $domaincek['domain_bitis'] ?>">
          </div>
          <!-- 
	Bu Script Aksoyhlc Tarafından Hazırlanmıştır "Ökkeş AKsoy | Aksoyhlc" 
	Ticari amaçla KULLANILAMAZ
	Satışı YAPILAMAZ
	Paylaşırken KAYNAK BELİRTMENİZ GEREKİYOR
	-->
        </div>
        <div class="form-row justify-content-center">
          <div class="form-group col-md-6">
            <label>Kaç Yıl Eklenecek</label>
            <input type="number" class="form-control" name="eklenen_yil" placeholder="Bitiş Tarihine Eklenecek Yıl Sayısı">
          </div>
        </div>
        <input type="hidden" name="domain_id" value="<?php echo $_POST['domain_id'] ?>">
        <button type="submit" name="domainsureekle" class="btn btn-primary">Kaydet</button>
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
