<?php include 'header.php';
$kullanicisor=$db->prepare("SELECT * FROM kullanicilar where kul_mail=:kul_mail");
$kullanicisor->execute(array(
  'kul_mail' => $_SESSION['kul_mail']
));
$kullanicicek=$kullanicisor->fetch(PDO::FETCH_ASSOC);
?>

<div class="container">
  <form action="islemler/islem.php" method="POST" enctype="multipart/form-data">
    <div class="form-row justify-content-center">      
      <div class="form-group col-md-6">
        <label>E-Posta</label>
        <input type="email" required class="form-control" value="<?php echo $kullanicicek['kul_mail'] ?>" name="kul_mail" placeholder="E-Mail">
      </div>
    </div>
    <div class="form-row justify-content-center mb-3">
      <div class="col-md-6 text-center">
        <label>Yeni Şifre <small>(Boş Bırakırsanız Şifre Değişmez)</small></label>
        <input class="form-control" type="text" name="kul_sifre">
      </div>
    </div>   
    <div class="row justify-content-center">
     <button type="submit" name="profilguncelle" class="btn btn-primary">Kaydet</button> 
   </form>
 </div>
</div>
<hr>

<?php include 'footer.php' ?>


<?php if (@$_GET['durum']=="no")  {?>  
  <script>
    Swal.fire({
      type: 'error',
      title: 'İşlem Başarısız',
      text: 'Hata Detayı: '+"<?php echo $_SESSION['hata'] ?>",
      showConfirmButton: true,
      confirmButtonText: 'Kapat'
    })
  </script>
<?php } ?>

<?php if (@$_GET['durum']=="ok")  {?>  
  <script>
    Swal.fire({
      type: 'success',
      title: 'İşlem Başarılı',
      text: 'İşleminiz Başarıyla Gerçekleştirildi',
      showConfirmButton: false,
      timer: 2000
    })
  </script>
<?php } ?>
<?php if (@$_GET['durum']=="eskisifrehata")  {?>  
  <script>
    Swal.fire({
      type: 'error',
      title: 'İşlem Başarısız',
      text: 'Eski Şifreniz Hatalı Lütfen Eski Şifrenizi Doğru Girin',
      showConfirmButton: true,
      confirmButtonText: 'Kapat'
    })
  </script>
<?php } ?>
<?php if (@$_GET['durum']=="sifreleruyusmuyor")  {?>  
  <script>
    Swal.fire({
      type: 'error',
      title: 'İşlem Başarısız',
      text: 'Girdiğiniz Şifreler Aynı Değil Lütfen Girdiğiniz Şifreleri Kontrol Edin',
      showConfirmButton: true,
      confirmButtonText: 'Kapat'
    })
  </script>
<?php } ?>
<?php if (@$_GET['durum']=="sifredegisti")  {?>  
  <script>
    Swal.fire({
      type: 'success',
      title: 'İşlem Başarılı',
      text: 'İşleminiz Başarıyla Gerçekleştirildi',
      showConfirmButton: false,
      timer: 2000
    })
  </script>
  <?php } ?>