# EczaneOtomasyonu
Giriş Sayfası bir internet arayüzüne giriş yapmak ile aynı mantık, tüm personeller ayni kullanıcı adı ve şifre ile giriş yapabilir.
![image](https://github.com/YusufUzeyir/EczaneOtomasyonu/assets/92249669/fce1f23f-6367-4113-91b5-cc2358f854a4)

Giriş yap butonuna basıldığında sade bir anasayfa tasarımı karşılıyor.
![image](https://github.com/YusufUzeyir/EczaneOtomasyonu/assets/92249669/355e1ecb-335f-44c4-96d1-5eecafaa3647)

Üç çizgiye basıldığında bu şekilde bir navigation-bar kısmı karşılıyor.
![image](https://github.com/YusufUzeyir/EczaneOtomasyonu/assets/92249669/b6a44626-a6bc-499b-bc67-ec836287f503)

Herhangi bir kategoriyi seçtikten sonra sizleri seçilen kategorinin tablosu karşılıyor. Sütunlardaki veriler doğrudan mysql veritabnından çekiliyor.
![image](https://github.com/YusufUzeyir/EczaneOtomasyonu/assets/92249669/58d57c4a-5b0b-4a1b-a1f7-392f257da0a8)

Hasta tablosu /  Tüm tablolarda silme,güncelleme,ekleme işlemlerini yapabilmek için gerekli butonlar bulunuyor.
![image](https://github.com/YusufUzeyir/EczaneOtomasyonu/assets/92249669/3d30eec2-f3a4-47a6-943e-80610c2a7beb)

Hasta tablosu / Tablolarda arama yapıp filtreleme de yapılabiliyor.
![image](https://github.com/YusufUzeyir/EczaneOtomasyonu/assets/92249669/9e01ec8b-a9ca-4280-8dd0-4675bd5c86f1)

Reçeteler tablosu / Reçetede hangi ilacın yazıldığını veri tabanında referans vererek reçeteler tablosunda ilaç ID kısmında tutuyoruz.
![image](https://github.com/YusufUzeyir/EczaneOtomasyonu/assets/92249669/057c0e6e-54b0-459c-a581-277c425cbfa0)



Uygulama Kullanımı / Giriş yapıldıktan sonra tablolar arasında dolaşma, referans verme , veri ekleme-silme-güncelleme, satış yapıldığında stoktan adedi düşme gibi tüm işlemleri yapılabiliyor.

Web Sitesini Açma / Projeyi çalıştırabilmek için bir sunucu üzerinden projeyi açmanız gerekli. Biz projeyi XAMPP üzerinden yaptığımız için XAMPP üzerinden nasıl çaıştıracağınızı kısaca anlatayım.
1) XAMPP uygulamasını indirdikten sonra Apache sunucusunu çalıştırın.
2) XAMPP uygulamasının dosya yolunu bulun ve htdocs klasörünü açın.
3) htdocs klasörünün içinde birlikte gelen tüm dosyaları silin ve klasörü temizleyin.
4) Proje dosyasını htdocs klasörünün içine atın ve projeyi çalıştırın.
5) Mysql bağlantısını da XAMPP üzerinden çalıştırın.
6) localhost/phpmyadmin/  sitesine gidin ve ecznae3.sql olarak verdiğim dosyayı içe aktarın.

NOT: (Projeyi çalıştırmak için ilk 4 adımı yapmanız yeterli. Tablo içindeki verileri de görmek isterseniz 5 ve 6. adımlarını da gerçekleştirmeniz gerekli. )
