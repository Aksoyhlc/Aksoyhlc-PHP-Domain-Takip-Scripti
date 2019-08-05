<?php include 'header.php'; ?>
<link rel="stylesheet" media="all" type="text/css" href="vendor/upload/css/fileinput.min.css">
<link rel="stylesheet" type="text/css" media="all" href="vendor/upload/themes/explorer-fas/theme.min.css">
<script src="vendor/upload/js/fileinput.js" type="text/javascript" charset="utf-8"></script>
<script src="vendor/upload/themes/fas/theme.min.js" type="text/javascript" charset="utf-8"></script>
<script src="vendor/upload/themes/explorer-fas/theme.minn.js" type="text/javascript" charset="utf-8"></script>
<!-- Begin Page Content -->
<style type="text/css" media="screen">
	.kv-file-remove {
		display: none;
	}
</style>
<div class="container">
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h5 class="m-0 font-weight-bold text-primary">Site Ayarları</h5>   
		</div>
		<div class="card-body">
			<form action="islemler/islem.php" method="POST" enctype="multipart/form-data"  data-parsley-validate>		
				<div class="form-row mb-3">
					<div class="file-loading">
						<input class="form-control" id="sitelogosu" name="site_logo" type="file">
					</div>
				</div>
				<div class="form-row">
					<div class="form-group col-md-6">
						<label>Site Başlığı</label>
						<input type="text" required class="form-control" name="site_baslik" value="<?php echo $ayarcek['site_baslik'] ?>" placeholder="Site Başlığı">
					</div>
				</div>
				<div class="form-row">
					<div class="form-group col-md-6">
						<label>Site Açıklaması</label>
						<input type="text" required class="form-control" name="site_aciklama" value="<?php echo $ayarcek['site_aciklama'] ?>" placeholder="Site Açıklaması (En Fazla 250 Karakter)">
					</div>
				</div>
				<div class="form-row">
					<div class="form-group col-md-6">
						<label>Site Sahibi</label>
						<input type="text" required class="form-control" name="site_sahibi" value="<?php echo $ayarcek['site_sahibi'] ?>" placeholder="Site Sahibi">
					</div>
				</div>
				<div class="form-row">
					<div class="form-group col-md-6">
						<label>Site Mail Adresi <small>(Domain bitiş tarihi yaklaşınca mail gönderilecek adres)</small></label>
						<input type="text" required class="form-control" name="site_mail" value="<?php echo $ayarcek['site_mail'] ?>" placeholder="Site Mail Adresi">
					</div>
				</div>
				<div class="form-row">
					<div class="form-group col-md-6">
						<label>SMS Kullancı Adı</label>
						<input type="text" class="form-control" name="sms_kullanici_adi" placeholder="İletimerkezi Kayıt Numaranız" value="<?php echo $ayarcek['sms_kullanici_adi'] ?>" placeholder="Site Sahibi">
					</div>
				</div>
				<div class="form-row">
					<div class="form-group col-md-6">
						<label>SMS Şifre</label>
						<input type="text" class="form-control" name="sms_sifre" placeholder="Şifreniz" value="<?php echo $ayarcek['sms_sifre'] ?>">
					</div>
				</div>
				<div class="form-row">
					<div class="form-group col-md-6">
						<label>Host Adresi</label>
						<input type="text" required class="form-control" placeholder="Host Adresinizi Girin" name="host_adresi" value="<?php echo $ayarcek['host_adresi'] ?>">
					</div>
					<div class="form-group col-md-6">
						<label>Port Numarası</label>
						<input type="number" required class="form-control" name="port_numarasi" value="<?php echo $ayarcek['port_numarasi'] ?>">
					</div>
				</div>
				<div class="form-row">
					<div class="form-group col-md-6">
						<label>Mail Adresi</label>
						<input type="mail" required class="form-control" placeholder="Mail Adresinizi Girin" name="mail_adresi" value="<?php echo $ayarcek['mail_adresi'] ?>">
					</div>
					<div class="form-group col-md-6">
						<label>Mail Şifresi</label>
						<input type="password" class="form-control" placeholder="Mail Şifresi" name="mail_sifre" value="<?php echo $ayarcek['mail_sifre'] ?>">
					</div>
				</div>
				<button type="submit" name="genelayarkaydet" class="btn btn-primary">Kaydet</button>
			</form>						
		</div>
	</div>
</div>
<script>
	$(document).ready(function () {
		$("#sitelogosu").fileinput({
			'theme': 'explorer-fas',
			'showUpload': false,
			minFileSize: 5,
			allowedFileExtensions: ["jpg", "png", "jpeg","mp4","zip"],
			initialPreview: [
			"<img src='<?php echo $ayarcek['site_logo'] ?>' style='height:90px' class='file-preview-image' alt='Logo' title='Logo'>"
			],
		});
	});
</script>
<script type="text/javascript">
	function ayarlarikaydet() {
		$.ajax({
        type: 'POST',   //post olarak belirledik
        url: 'islemler/mail.php',  //formdaki verilerin gidecegi adres
        data: $('form#mailformu').serialize(), //#form id li formumuzu bilesenlerine ayirdik
        success: function(gelen) { //islem basarili oldugunda yapilacak
        	$('#sonuc').html(gelen);
        }
    });
	}
</script>﻿
<?php include 'footer.php' ?>

<?php if (@$_GET['durum']=="no")  {?>  
	<script>
		Swal.fire({
			type: 'error',
			title: 'İşlem Başarısız',
			text: 'Lütfen Tekrar Deneyin',
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
			showConfirmButton: true,
			confirmButtonText: 'Kapat'
		})
	</script>
	<?php } ?>