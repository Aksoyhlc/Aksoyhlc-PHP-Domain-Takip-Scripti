<?php 
include 'header.php';

?>
<!-- Begin Page Content -->
<div class="container">
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h5 class="m-0 font-weight-bold text-primary">Domain Ekle</h5>
    </div>
    <div class="card-body">
      <form action="islemler/islem.php" method="POST" enctype="multipart/form-data">
        <div class="form-row">
          <div class="form-group col-md-4">
            <label>Domain Adı</label>
            <input type="text" class="form-control" name="domain_adi" placeholder="Domain Adı">
          </div>
          <div class="form-group col-md-4">
            <label>Müşteri</label>
            <select id="musterilistesi" class="form-control" name="domain_musteri" onchange="musterisecme();">
             <?php 
             $musteri=$db->prepare("SELECT * FROM musteri");
             $musteri->execute();
             while ($mustericek=$musteri->fetch(PDO::FETCH_ASSOC)) {?>
              <option value="<?php echo $mustericek['musteri_id']; ?>"><?php echo $mustericek['musteri_adi']; ?></option>
            <?php } 
            if ($musteri->rowcount()==0) { ?>
              <option></option>
           <?php }
           ?>
           <option value="musteri_ekle">Müşteri Ekle</option>
         </select>
       </div>
       <div class="form-group col-md-4">
        <label>Domain Başlangıç</label>
        <input type="date" class="form-control" name="domain_baslangic" placeholder="Domain Başlangıç">
      </div>
    </div>
    <div class="form-row">
     <div class="form-group col-md-4">
      <label>Domain Kayıt Firması <small>(Örn:Godaddy)</small></label>
      <input type="text" class="form-control" name="domain_kayit_firmasi" placeholder="Domain Kayıt Firması">
    </div> 
    <div class="form-group col-md-4">
      <label>Domain Bitiş</label>
      <input type="date" class="form-control" name="domain_bitis" placeholder="Domain Bitiş">
    </div> 
    <div class="form-group col-md-4">
      <label>Fiyat</label>
      <input type="text" class="form-control" name="domain_fiyat" placeholder="Domain Fİyatı">
    </div>                           
  </div>    
  <button type="submit" name="domainekle" class="btn btn-primary">Kaydet</button>
</form>
</div>
</div>
</div>
<!-- End of Main Content -->
<?php include 'footer.php' ?>


<script type="text/javascript">
 function musterisecme() {
  var musterilistesi = document.getElementById("musterilistesi");
  var secilendeger = musterilistesi.options[musterilistesi.selectedIndex].value;
  if (secilendeger=="musteri_ekle") {
   Swal.fire({
    title: 'Emin Misiniz?',
    text: "Müşteri Ekleme Sayfasına Yönlendirilmek İstediğinize Emin Misiniz? Bu Sayfada Yaptığınız İşlemler Kaybolacaktır.",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Evet, Yönlendir',
    cancelButtonText: 'Hayır, Bekle'
  }).then((result) => {
    if (result.value) {
      window.location="musteriekle.php";
    }
  })
}}
</script>