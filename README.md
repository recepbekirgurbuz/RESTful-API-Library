# Uygulama Hakkında Bilgi
### Bu proje nedir ?
> Bir kütüphane api'sidir
### Apinin içinde ne tür işlemler yapabiliyoruz
#### Kullanıcı İşlemleri
- Tüm kullanıcıları ve bilgilerini listeleme
- Yeni kullanıcı eklemek
- Id bilgisinden yalnız bir kullanıcının bilgilerini ekranda gösterir
- Id bilgisinden belirlediğimiz bir kullanıcının bilgilerini güncelleme
- Id bilgisinden belirlediğimiz bir kullanıcıyı silmek
#### Kitap İşlemleri
- Tüm kitapları ve bilgilerini listelemek
- Yeni kitap eklemek
- Id bilgisinden yalnız bir kitabın bilgilerini listeleme
- Id bilgisinden belirlediğimiz bir kitabın bilgilerini güncelleme
- Id bilgisinden belirlediğimiz bir kitabı silmek
#### Ödünç alınan kitaplar ve alan kişiler hakkında yapılan işlemler
- Yeni ödünç kitap alışı eklemek
- Tüm ödünç kitap alışları listelemek 
- Id bilgisinden ödünç alınan kitap, kimin aldığı, son teslim tarihi ve kitaba kaç puan verdiğini ekrana gösterir
- Id bilgisinden yapılan ödünç alma işlemini güncellemek
- Id bilgisinden ödünç alma işlemini silmek

# Kurulum
### komut istemcisinden klasörün olduğu dizine gidin
### database oluşturmak
- php artisan migrate
### database'i veriler ile doldurmak 
- php artisan db:seed
### server'ı başlatmak
- php artisan serve

