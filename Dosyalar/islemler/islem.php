<?php 

ob_start();
session_start();
include 'baglan.php';
include '../fonksiyonlar.php';
date_default_timezone_set('Europe/Istanbul');

//Site ayarlarını veritabanından çekme işlemi
$ayarsor=$db->prepare("SELECT * FROM ayarlar");
$ayarsor->execute();
$ayarcek=$ayarsor->fetch(PDO::FETCH_ASSOC);


/********************************************************************************/

/*Oturum Açma İşlemi Giriş*/
if (isset($_POST['oturumac'])) {
  $kul_mail=$_POST['kul_mail'];
  $kul_sifre=md5($_POST['kul_sifre']);
  $kullanicisor=$db->prepare("SELECT * FROM kullanicilar WHERE kul_mail=:mail and kul_sifre=:sifre");
  $kullanicisor->execute(array(
    'mail'=> $kul_mail,
    'sifre'=> $kul_sifre
  ));
  $sonuc=$kullanicisor->rowCount();
  if ($sonuc==1) {
    $kullanicicek=$kullanicisor->fetch(PDO::FETCH_ASSOC);
    $_SESSION['kul_mail']=$kul_mail;
    $_SESSION['kul_id']=$kullanicicek['kul_id'];
    header("location:../index.php");
    exit;
  } else {
    header("location:../login?durum=hata");
  }
  exit;
}

/*Oturum Açma İşlemi Çıkış*/

/*
	Bu Script Aksoyhlc Tarafından Hazırlanmıştır "Ökkeş AKsoy | Aksoyhlc" 
	Ticari amaçla KULLANILAMAZ
	Satışı YAPILAMAZ
	Paylaşırken KAYNAK BELİRTMENİZ GEREKİYOR
	*/

/*******************************************************************************/

if (isset($_POST['genelayarkaydet'])) {
  oturumkontrol();
  $genelayarkaydet=$db->prepare("UPDATE ayarlar SET
    site_baslik=:baslik,
    site_aciklama=:aciklama,
    site_sahibi=:sahip,
    sms_kullanici_adi=:sms_kullanici_adi,
    sms_sifre=:sms_sifre, 
    site_mail=:site_mail,
    host_adresi=:host_adresi,
    port_numarasi=:port_numarasi,
    mail_adresi=:mail_adresi,
    mail_sifre=:mail_sifre WHERE id=1
    ");

  $ekleme=$genelayarkaydet->execute(array(
    'baslik' => guvenlik($_POST['site_baslik']),
    'aciklama' => guvenlik($_POST['site_aciklama']),
    'sahip' => guvenlik($_POST['site_sahibi']),
    'sms_kullanici_adi' => guvenlik($_POST['sms_kullanici_adi']),
    'sms_sifre' => guvenlik($_POST['sms_sifre']),
    'site_mail' => guvenlik($_POST['site_mail']),
    'host_adresi' => guvenlik($_POST['host_adresi']),
    'port_numarasi' => guvenlik($_POST['port_numarasi']),
    'mail_adresi' => guvenlik($_POST['mail_adresi']),
    'mail_sifre' => guvenlik($_POST['mail_sifre'])
  ));



  if ($_FILES['site_logo']['size'] > 0) {
    $yuklemeklasoru = '../img';
    @$gecici_isim = $_FILES['site_logo']["tmp_name"];
    @$dosya_ismi = $_FILES['site_logo']["name"];
    $benzersizsayi1=rand(100,10000);
    $benzersizsayi2=rand(100,10000);
    $isim=turkce($benzersizsayi1.$benzersizsayi2.$dosya_ismi);
    $resim_yolu=substr($yuklemeklasoru, 3)."/".$isim;
    @move_uploaded_file($gecici_isim, "$yuklemeklasoru/$isim");

    $dosyayukleme=$db->prepare("UPDATE ayarlar SET
      site_logo=:site_logo WHERE id=1 ");

    $yukleme=$dosyayukleme->execute(array(
      'site_logo' => $resim_yolu
    ));

  };



  if ($ekleme) {
    header("location:../ayarlar?durum=ok");
  } else {
    header("location:../ayarlar?durum=no");
    exit;
  }            
}

/*******************************************************************************/

if (isset($_POST['islemekle'])) {
  oturumkontrol();
  $islemekle=$db->prepare("INSERT INTO islem SET
    arac=:arac,
    yapilan_islem=:yapilan_islem,
    islem_tarihi=:islem_tarihi,
    aciklama=:aciklama
    ");

  $ekleme=$islemekle->execute(array(
    'arac' => guvenlik($_POST['arac']),
    'yapilan_islem' => guvenlik($_POST['yapilan_islem']),
    'islem_tarihi' => guvenlik($_POST['islem_tarihi']),
    'aciklama' => guvenlik($_POST['aciklama'])
  ));


  $islemsor=$db->prepare("SELECT islem_id FROM islem order by islem_id desc limit 0, 1");
  $islemsor->execute();
  $islemcek=$islemsor->fetch(PDO::FETCH_ASSOC);

  if (isset($_FILES['islem_dosya'])) {
    $sonuc=fileupload($_FILES['islem_dosya'],$islemcek['islem_id'],$db,"3221225472",$_POST['arac']);
  }

  if ($ekleme) {
    header("Location:../islemler?durum=ok");

  } else {
   // header("Location:../islemler?durum=no");
   print_r($islemekle->errorInfo());
   exit;
 }
 exit;
}

/*******************************************************************************/

if (isset($_POST['islemguncelle'])) {
  oturumkontrol();
  $islemguncelle=$db->prepare("UPDATE islem SET
    arac=:arac,
    yapilan_islem=:yapilan_islem,
    islem_tarihi=:islem_tarihi,
    aciklama=:aciklama WHERE islem_id=:islem_id
    ");

  $ekleme=$islemguncelle->execute(array(
    'arac' => guvenlik($_POST['arac']),
    'yapilan_islem' => guvenlik($_POST['yapilan_islem']),
    'islem_tarihi' => guvenlik($_POST['islem_tarihi']),
    'aciklama' => guvenlik($_POST['aciklama']),
    'islem_id' => $_POST['islem_id']
  ));
  if (isset($_FILES['islem_dosya'])) {
    $sonuc=fileupload($_FILES['islem_dosya'],$_POST['islem_id'],$db,"3221225472",$_POST['arac']);
  }

  if ($ekleme) {
    header("Location:../islemler?durum=ok");

  } else {
   // header("Location:../islemler?durum=no");
   print_r($islemguncelle->errorInfo());
   exit;
 }
 exit;
}


/*******************************************************************************/

if (isset($_POST['domainsureekle'])) {
  oturumkontrol();
  $eklenenyil=$_POST['eklenen_yil'];
//  $baslangic=date("Y-m-d");
  $yenitarih=strtotime("$eklenenyil years",strtotime($_POST['domain_bitis']));
  $domainbitistarihi=date("Y-m-d", $yenitarih);

  $domainsureekle=$db->prepare("UPDATE domain SET   
    domain_bitis=:domain_bitis WHERE domain_id=:domain_id
    ");

  $ekleme=$domainsureekle->execute(array( 
    'domain_bitis' => $domainbitistarihi,
    'domain_id' => guvenlik($_POST['domain_id']),

  ));

  if ($ekleme) {
    header("Location:../domainler?durum=ok");

  } else {
    header("Location:../domainler?durum=no");
  }
  exit;
}


/*******************************************************************************/

if (isset($_POST['musteriekle'])) {
  oturumkontrol();
  $musteriekle=$db->prepare("INSERT INTO musteri SET
    musteri_adi=:musteri_adi,
    musteri_telefon=:musteri_telefon,
    musteri_mail=:musteri_mail,
    musteri_not=:musteri_not
    ");

  $ekleme=$musteriekle->execute(array(
    'musteri_adi' => guvenlik($_POST['musteri_adi']),
    'musteri_telefon' => guvenlik($_POST['musteri_telefon']),
    'musteri_mail' => guvenlik($_POST['musteri_mail']),
    'musteri_not' => guvenlik($_POST['musteri_not'])
  ));

  if ($ekleme) {
    header("Location:../musteriler?durum=ok");

  } else {
    header("Location:../musteriler?durum=no");
  }
  exit;
}
/*
	Bu Script Aksoyhlc Tarafından Hazırlanmıştır "Ökkeş AKsoy | Aksoyhlc" 
	Ticari amaçla KULLANILAMAZ
	Satışı YAPILAMAZ
	Paylaşırken KAYNAK BELİRTMENİZ GEREKİYOR
	*/

/*******************************************************************************/

if (isset($_POST['musteriguncelle'])) {
  oturumkontrol();
  $musteriguncelle=$db->prepare("UPDATE musteri SET
    musteri_adi=:musteri_adi,
    musteri_telefon=:musteri_telefon,
    musteri_mail=:musteri_mail,
    musteri_not=:musteri_not WHERE musteri_id=:musteri_id
    ");

  $ekleme=$musteriguncelle->execute(array(
    'musteri_adi' => guvenlik($_POST['musteri_adi']),
    'musteri_telefon' => guvenlik($_POST['musteri_telefon']),
    'musteri_mail' => guvenlik($_POST['musteri_mail']),
    'musteri_not' => guvenlik($_POST['musteri_not']),
    'musteri_id' => guvenlik($_POST['musteri_id'])
  ));

  if ($ekleme) {
    header("Location:../musteriler?durum=ok");

  } else {
    header("Location:../musteriler?durum=no");
  }
  exit;
}

/********************************************************************************/


if (isset($_POST['musterisilme'])) {
  oturumkontrol();
  $sil=$db->prepare("DELETE from musteri where musteri_id=:id");
  $kontrol=$sil->execute(array(
    'id' => guvenlik($_POST['musteri_id'])
  ));

  if ($kontrol) {

    header("Location:../musteriler.php?durum=ok");
    exit;
  } else {
    header("Location:../musteriler.php?durum=no");
    exit;
  }
}
/*
	Bu Script Aksoyhlc Tarafından Hazırlanmıştır "Ökkeş AKsoy | Aksoyhlc" 
	Ticari amaçla KULLANILAMAZ
	Satışı YAPILAMAZ
	Paylaşırken KAYNAK BELİRTMENİZ GEREKİYOR
	*/

/*******************************************************************************/

if (isset($_POST['domainekle'])) {
  oturumkontrol();
  $domainekle=$db->prepare("INSERT INTO domain SET
    domain_adi=:domain_adi,
    domain_musteri=:domain_musteri,
    domain_baslangic=:domain_baslangic,
    domain_kayit_firmasi=:domain_kayit_firmasi,
    domain_fiyat=:domain_fiyat,
    domain_bitis=:domain_bitis
    ");

  $ekleme=$domainekle->execute(array(
    'domain_adi' => guvenlik($_POST['domain_adi']),
    'domain_musteri' => guvenlik($_POST['domain_musteri']),
    'domain_baslangic' => guvenlik($_POST['domain_baslangic']),
    'domain_kayit_firmasi' => guvenlik($_POST['domain_kayit_firmasi']),
    'domain_fiyat' => guvenlik($_POST['domain_fiyat']),
    'domain_bitis' => guvenlik($_POST['domain_bitis'])
  ));

  if ($ekleme) {
    header("Location:../domainler?durum=ok");

  } else {
    header("Location:../domainler?durum=no");
  }
  exit;
}


/*******************************************************************************/

if (isset($_POST['domainguncelle'])) {
  oturumkontrol();
  $domainguncelle=$db->prepare("UPDATE domain SET
    domain_adi=:domain_adi,
    domain_musteri=:domain_musteri,
    domain_baslangic=:domain_baslangic,
    domain_kayit_firmasi=:domain_kayit_firmasi,
    domain_fiyat=:domain_fiyat,
    domain_bitis=:domain_bitis WHERE domain_id=:domain_id
    ");

  $guncelle=$domainguncelle->execute(array(
    'domain_adi' => guvenlik($_POST['domain_adi']),
    'domain_musteri' => guvenlik($_POST['domain_musteri']),
    'domain_baslangic' => guvenlik($_POST['domain_baslangic']),
    'domain_kayit_firmasi' => guvenlik($_POST['domain_kayit_firmasi']),
    'domain_fiyat' => guvenlik($_POST['domain_fiyat']),
    'domain_bitis' => guvenlik($_POST['domain_bitis']),
    'domain_id' => guvenlik($_POST['domain_id'])
  ));

  if ($guncelle) {
    header("Location:../domainler.php?durum=ok");

  } else {
    header("Location:../domainler.php?durum=no");
  }
  exit;
}

/*******************************************************************************/

if (isset($_POST['profilguncelle'])) {
  oturumkontrol();
  $profilguncelle=$db->prepare("UPDATE kullanicilar SET
    kul_mail=:kul_mail WHERE kul_id=:kul_id
    ");

  $guncelle=$profilguncelle->execute(array(
    'kul_mail' => guvenlik($_POST['kul_mail']), 'kul_id' => guvenlik($_SESSION['kul_id'])
  ));

  $_SESSION['kul_mail']=$_POST['kul_mail'];

  if (strlen(@$_POST['kul_sifre'])>1) {
   $profilguncelle=$db->prepare("UPDATE kullanicilar SET
    kul_sifre=:kul_sifre WHERE kul_id=:kul_id
    ");

   $guncelle=$profilguncelle->execute(array(
    'kul_sifre' => md5($_POST['kul_sifre']), 'kul_id' => guvenlik($_SESSION['kul_id'])
  ));

 }

 if ($guncelle) {
  header("Location:../profil.php?durum=ok");

} else {
  header("Location:../profil.php?durum=no");
}
exit;
}


/********************************************************************************/
/*
	Bu Script Aksoyhlc Tarafından Hazırlanmıştır "Ökkeş AKsoy | Aksoyhlc" 
	Ticari amaçla KULLANILAMAZ
	Satışı YAPILAMAZ
	Paylaşırken KAYNAK BELİRTMENİZ GEREKİYOR
	*/

if (isset($_POST['domainsilme'])) {
  $sil=$db->prepare("DELETE from domain where domain_id=:id");
  $kontrol=$sil->execute(array(
    'id' => guvenlik($_POST['domain_id'])
  ));

  if ($kontrol) {

    header("Location:../domainler.php?durum=ok");
    exit;
  } else {
    header("Location:../domainler.php?durum=no");
    exit;
  }
}


?>