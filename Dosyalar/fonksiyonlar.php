<?php 

date_default_timezone_set('Europe/Istanbul');

function turkce($isim) {
	$isim = trim($isim);
	$search = array('Ç','ç','Ğ','ğ','ı','İ','Ö','ö','Ş','ş','Ü','ü',' ');
	$replace = array('c','c','g','g','i','i','o','o','s','s','u','u','-');
	$isim_fin = str_replace($search,$replace,$isim);
	$yenisim = 	mb_strtolower($isim_fin, 'utf8');
	return $yenisim;
};


function guvenlik($gelen){
	//$giden = addslashes($gelen);
	$giden = htmlspecialchars($gelen);
	//$giden = htmlentities($giden);
	$giden = strip_tags($giden);
	return $giden;
};

function fileupload($gelenisim,$id,$db,$size,$plaka)
{
	include_once 'islemler/class-upload.php';
	$files = array();
	foreach ($gelenisim as $k => $l) {
		foreach ($l as $i => $v) {
			if (!array_key_exists($i, $files))
				$files[$i] = array();
			$files[$i][$k] = $v;
		}
	}

	foreach ($files as $file){

		$handle = new Upload($file);

		if ($handle->uploaded) {		
			$tarih=date('d-m-Y-H-i-s');
			$handle->file_max_size="$size";
			$handle->file_name_body_pre=$id."-".$plaka."-".$tarih."-";
			$type=$handle->file_src_name_ext;
			$tmp_dosyaismi=turkce($handle->file_src_name_body);
			$handle->file_new_name_body=$tmp_dosyaismi;
			$dosyaturu=$handle->file_src_name_ext;
			$handle->Process("../img");
			$dosyaismi=$handle->file_dst_name;
			
			if ($handle->processed) {			
				$dosyayukle=$db->prepare("INSERT INTO islem_dosya SET 
					islem_id=:islem_id,
					dosya_yolu=:dosya_yolu
					");

				$yukle=$dosyayukle->execute(array(
					'islem_id' => $id,
					'dosya_yolu' => $dosyaismi
				));	
				
			} else {
				$_SESSION['hata']=$handle->error;
				//setcookie("error", $handle->error, time() - 3600);
				return "hata";
			}

			$handle-> Clean();

		} else {
			$_SESSION['hata']=$handle->error;
			//setcookie("error", $handle->error, time() - 3600);
			return "hata";
		}

	}
}

function oturumkontrol()
{
	if (empty($_SESSION['kul_mail']) OR empty($_SESSION['kul_id'])) {	
		session_destroy();
		header("location:login.php");
		exit;
	}

}

function fnk(){
	echo '<footer class="sticky-footer bg-white">
	<div class="container my-auto">
	<div class="copyright text-center my-auto">
	<span>Copyright &copy; 2019 Bu script <a class="btn-link" href="https://www.aksoyhlc.net" rel="follow" title="Ökkeş Aksoy | Aksoyhlc">"Ökkeş Aksoy | Aksoyhlc"</a> tarafından hazırlanmıştır ve <a rel="license" href="http://creativecommons.org/licenses/by-nc-nd/4.0/deed.tr"> Creative Commons Lisansı</a> ile lisanslanmıştır. <a rel="license" href="http://creativecommons.org/licenses/by-nc-nd/4.0/deed.tr"><img alt="Creative Commons Lisansı" style="border-width:0" src="https://i.creativecommons.org/l/by-nc-nd/4.0/88x31.png"></a>
	</span>
	</div>
	</div>
	</footer>';
}
?>