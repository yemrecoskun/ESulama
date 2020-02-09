# ESulama
 ## Projemizde kullanılan araç-gereçler:
 ### Kartlar
 - Arduino UNO
 - Raspberry PI Zero Wh
 ### Sensörler
 - Su seviyesi Sensörü
 - Yağmur Sensörü
 - Işık Sensörü
 - Toprak ve Nem Sensörü
 - Isı ve Nem Sensörü
 ### Diller ve Programlar
 - Python
 - Arduino Editör
 - Firebase
 - PHP,HTML,CSS,JS
 ## Projemizini çalışma prensibi:
 ## Aşağıdaki şartları inceleyelim, 
- su deposundaki su yeterliliği %30’un altında ise(su seviyesi sensörü), 
- hava durumunun yağmurlu olup olmaması (yağmur sensörü),
- ortam ışığının yeterliliği %5’in altında ise(ışık sensörü),
  
  gibi şartları sağlıyorsa su motorunun çalışlabiir hâle gelir.

 ## Sistem daha sonra su motoru ile otomatik/manuel sulama yapabilmektedir.
 ### Otomatik sulama sisteminde 
 - Toprağın nem durumu
 - ortam sıcaklığı durumunu 
 
sistemden kullanıcı tarafından değer verilerek kontrollü aktif sulama yapabilmektedir. 

### Manuel sulama sisteminde 
hiçbir değeri etkilemeden kontrolsüz 10 saniye boyunca sulama yapabilirmektedir.

## Projemizin sensör verileri şu şekilde okutuluyor;
1. Sensörler Arduino UNO kartından okutulmaktadır. 
2. Arduino UNO kartından bu sensör verilerini Serial olarak Raspberry kartına aktarıyoruz.
3. Raspberry bu verileri Firestore Veritabanımıza eklemektedir.

Projemizde su motorunu raspberry ile çalıştırıyoruz.

Uygulamamızın takip durumu için Web Tabanlı kullanarak yapmaya karar verdik sebebi tüm platformlarda kullanılabilirlik avantajını sağladığı için uygulamamızı Web Tabanlı Uygulamamızda takip edeceğiz.

## Web
* Canlı veri grafiği, sensörlerin canlı verileri ekranda gösterir. 
* Otomatik sulama aktif/pasif yapılabilir.
* Manuel sulama uygulanabilir.
