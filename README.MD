
**Aksoyhlc Ücretsiz PHP Domain Takip Scripti Kurulum İşlemi**
1. Yeni bir tane veritabanı oluşturun ve zip dosyası içerisinde ki SQL dosyasını içe aktarın.
2. İlk oturum için 
Mail adresi: aksoyhlc@gmail.com
Şifre: 123
bu hesapla oturum açtıktan sonra sol menüde ki profil bölümünden e-posta ve şifrenizi değiştirebilirsiniz.
3. Hatırlatıcı ile ilgili bilgiler:
Mail, domain bitiş tarihine 1-2-3-4-5-6-7-15-30 gün kala gönderilir.
SMS, 1-7-15 gün kala sadece müşterinize gönderilir. Eğer müşterinize değilde size gönderilmeisni istiyorsanız kontrol.php dosyasının 127. satırında ki açıklamayı okuyun.
4. SMS göndermek için www.iletimerkezi.com sitesinden SMS satın almanız gerekiyor. SMS satın aldıktan sonra ayarlar sayfasından iletimerkezi telefon numarası ve şifrenizi girmeniz gerekiyor daha sonra kontrol.php dosyasının 33. satırında ki origin name (SMS başlığı) kısmını (AKSOYHLC yazıyor) kendi origin nameniz ile değiştirin

5. Hatırlarıcı ayarları için bir tane cronjob oluşturmanız gerekiyor. 

Cronjob: 
===============
Zamanlanmış dosyaların sunucu üzerinde çalıştırılmasıdır. Web siteniz üzerinde belirli aralıklarla çalıştırmak istediğiniz dosyalar varsa sunucu üzerinde cron tanımlayıp istediğiniz gün, saat ve dakikalarda çalışmasını sağlayabilirsiniz.

Cpanel kullananlar eklemek için şu linke bakabilir https://blog.veridyen.com/cronjob-nedir-cpanelde-cronjob-ekleme/

Cpanel dışında ücretsiz harici cronjoblar da kullanabilirsiniz bunlardan iki tanesi şunlardır:

https://cron-job.org/en/
https://www.easycron.com/

Cronjobu 24 saatte bir çalışacak şekilde ayarlamanız gerekiyor.  
Çalıştırılacak dosya: islemler klasörünün içerisindeki kontrol.php dosyasıdır.

Herhangi bir sorunda; 
Skype: Aksoyhlc (önerilen)
Mail: aksoyhlc@gmail.com | 27aksoy27@gmail.com | admin@aksoyhlc.net
Link: https://www.aksoyhlc.net/iletisim

adreslerinden herhangi biri ile iletişime geçebilirsiniz.

-----Aksoyhlc Domain Takip Scripti Kurulum İşlemi-----
