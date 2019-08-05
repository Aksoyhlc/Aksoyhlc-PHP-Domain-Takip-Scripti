<?php 
$host="localhost"; //Host adınızı girin varsayılan olarak Localhosttur eğer bilginiz yoksa bu şekilde bırakın
$veritabani_ismi="domaintakip"; //Veritabanı İsminiz
$kullanici_adi="root"; //Veritabanı kullanıcı adınız
$sifre="123456789"; //Kullanıcı şifreniz

try {
	$db=new PDO("mysql:host=$host;dbname=$veritabani_ismi;charset=utf8",$kullanici_adi,$sifre);
	//echo "veritabanı bağlantısı başarılı";
}

catch (PDOExpception $e) {
	echo $e->getMessage();
}
/*
	Bu Script Aksoyhlc Tarafından Hazırlanmıştır "Ökkeş AKsoy | Aksoyhlc" 
	Ticari amaçla KULLANILAMAZ
	Satışı YAPILAMAZ
	Paylaşırken KAYNAK BELİRTMENİZ GEREKİYOR
	*/
?>
