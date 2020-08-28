<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<?php 
date_default_timezone_set('Europe/Istanbul');
require 'baglan.php';

$ayarsor=$db->prepare("SELECT * FROM ayarlar");
$ayarsor->execute();
$ayarcek=$ayarsor->fetch(PDO::FETCH_ASSOC);

function sendRequest($site_name,$send_xml,$header_type) {

        //die('SITENAME:'.$site_name.'SEND XML:'.$send_xml.'HEADER TYPE '.var_export($header_type,true));
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,$site_name);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS,$send_xml);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	curl_setopt($ch, CURLOPT_HTTPHEADER,$header_type);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch, CURLOPT_TIMEOUT, 120);

	$result = curl_exec($ch);

	return $result;
};

$onaykodu=rand(100000, 999999);
$username   = $ayarcek['sms_kullanici_adi'];
$password   = $ayarcek['sms_sifre'];
$orgin_name = 'AKSOYHLC';



$host_adresi=$ayarcek['host_adresi'];
$port_numarasi=$ayarcek['port_numarasi'];
$mail_adresiniz=$ayarcek['mail_adresi'];
$mail_sifreniz=$ayarcek['mail_sifre'];

$http="http://";


/*
	Bu Script Aksoyhlc Tarafından Hazırlanmıştır "Ökkeş AKsoy | Aksoyhlc" 
	Ticari amaçla KULLANILAMAZ
	Satışı YAPILAMAZ
	Paylaşırken KAYNAK BELİRTMENİZ GEREKİYOR
	*/
$mailbasligi="Hatırlatma Maili";
$isim=$ayarcek['site_baslik'];

function mailgonder($veri)
{

	global $ayarcek;

	$host_adresi=$ayarcek['host_adresi'];
	$port_numarasi=$ayarcek['port_numarasi'];
	$mail_adresiniz=$ayarcek['mail_adresi'];
	$mail_sifreniz=$ayarcek['mail_sifre'];

	$_POST=$veri;

	$mailbasligi=$_POST['mail_baslik'];
	$isim=$_POST['mail_isim']; 
	$mailadresi=$_POST['mail_adres'];
	$mailicerigi=$_POST['mail_detay'];


	require_once 'phpmail/Exception.php';
	require_once 'phpmail/PHPMailer.php';
	require_once 'phpmail/SMTP.php';

	$mail = new PHPMailer\PHPMailer\PHPMailer(); 
	$mail->IsSMTP();					
	$mail->SMTPAuth = true;
	$mail->SMTPSecure = 'ssl'; 
	$mail->Host = $host_adresi;
	$mail->Port = $port_numarasi; 
	$mail->IsHTML(true);
	$mail->Username = $mail_adresiniz;
	$mail->Password = $mail_sifreniz; 
	$mail->SetFrom($mail->Username, $isim);	
	$mail->Subject = $mailbasligi;
	$mail->Body = $mailicerigi;		
	$mail->CharSet = 'UTF-8';
	$mail->AddAddress($mailadresi);			

	if($mail->Send()) {
		return TRUE;
	} else {	
		echo "<hr>".'Gönderme Hatası: ' . $mail->ErrorInfo;			
		return FALSE;
	}

}

/*************************/


$domainsor=$db->prepare("SELECT * FROM domain");
$domainsor->execute();

/*
	Bu Script Aksoyhlc Tarafından Hazırlanmıştır "Ökkeş AKsoy | Aksoyhlc" 
	Ticari amaçla KULLANILAMAZ
	Satışı YAPILAMAZ
	Paylaşırken KAYNAK BELİRTMENİZ GEREKİYOR
	*/
while ($domaincek=$domainsor->fetch(PDO::FETCH_ASSOC)) {

	if (strstr($domaincek['domain_bitis'], "0000")==false) {

		$domain_id=$domaincek['domain_id'];
		$tarih1 = strtotime(date('d.m.Y'));
		$tarih2 = strtotime($domaincek['domain_bitis']);
		$fark = $tarih2 - $tarih1;
		echo $sonuc = floor($fark / (60 * 60 * 24));
		echo "<hr>";
		if ($sonuc == "-1" OR $sonuc == 1 OR $sonuc == 2 OR $sonuc == 3 OR $sonuc == 4 OR $sonuc == 5 OR $sonuc == 6 OR $sonuc == 7 OR $sonuc == 15 OR $sonuc == 30) {
			$domain=$domaincek['domain_adi'];
			$bitis_tarihi=$domaincek['domain_bitis'];
			$kalangun=$sonuc;
			include 'mailtema.php';

			$musterisor=$db->prepare("SELECT * FROM musteri WHERE musteri_id=:musteri_id");
			$musterisor->execute(array(
				'musteri_id' => $domaincek['domain_musteri']
			));
			$mustericek=$musterisor->fetch(PDO::FETCH_ASSOC);

			$musterimail=$mustericek['musteri_mail'];
			$musteritelefon=$mustericek['musteri_telefon'];

			$mailler = array('0' => $musterimail, '1' => $ayarcek['site_mail']);

			$liste=array(
				'mail_baslik' => "Hatırlatma Maili",
				'mail_isim' => $ayarcek['site_baslik'],
				'mail_adres' => $musterimail,
				'mail_detay' => $mailicerigi
			);

			mailgonder($liste);
			
			
/*
	Bu Script Aksoyhlc Tarafından Hazırlanmıştır "Ökkeş AKsoy | Aksoyhlc" 
	Ticari amaçla KULLANILAMAZ
	Satışı YAPILAMAZ
	Paylaşırken KAYNAK BELİRTMENİZ GEREKİYOR
	*/

			$liste2=array(
				'mail_baslik' => "Hatırlatma Maili",
				'mail_isim' => $ayarcek['site_baslik'],
				'mail_adres' => $ayarcek['site_mail'],
				'mail_detay' => $mailicerigi
			);

			mailgonder($liste2);


			/*Domain bitme tarihi yaklaşınca müşterinize SMS gitmesini istemiyorsanız aşağıdaki satırları silin*/
			if ($sonuc == 15 OR $sonuc == 7 OR $sonuc == 1) {
				/*Eğer SMS'in müşterinize değilde size gönderilmesini istiyorsanız aşağıdaki satırda bulunan $musteritelefon yazan yeri kendi telefon numaranız ile değiştirin*/
				$numara = $musteritelefon;
				$numaralar="";
				$numaralar="<number>{$numara}</number>";
				$mesaj = $domaincek['domain_adi']." domain kullanım süresi ".$kalangun." gün içerisinde dolacaktır yenilemeyi unutmayın";


				$xml = <<<EOS
<request>
<authentication>
<username>{$username}</username>
<password>{$password}</password>
</authentication>

<order>
<sender>{$orgin_name}</sender>
<sendDateTime></sendDateTime>
<message>
<text>{$mesaj}</text>
<receipents>
{$numaralar}
</receipents>
</message>
</order>
</request>
EOS;

				$result = sendRequest('http://api.iletimerkezi.com/v1/send-sms',$xml,array('Content-Type: text/xml'));
				print_r($result);

			}
			
/*
	Bu Script Aksoyhlc Tarafından Hazırlanmıştır "Ökkeş AKsoy | Aksoyhlc" 
	Ticari amaçla KULLANILAMAZ
	Satışı YAPILAMAZ
	Paylaşırken KAYNAK BELİRTMENİZ GEREKİYOR
	*/
			/*Domain bitme tarihi yaklaşınca müşterinize SMS gitmesini istemiyorsanız yukarıdaki satırları silin*/

		}
	}
}


?>
