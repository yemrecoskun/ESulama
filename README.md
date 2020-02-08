# ESulama
<i><b>Projemizini çalışma prensibi ise su seviyesi sensörü ile su deposundaki su yeterliliği(%30’un altında ise), 
hava durumunun yağmurlu olup olmaması ve ortam ışığının yeterliliği(%5’in altında ise)  ile bize otomatik/manuel sulama
yapabilmektedir. Otomatik sulama sisteminde Toprağın nem durumu ve ortam sıcaklığı durumunu sistemden kullanıcı tarafından değer
verilerek aktif sulama yapabilmektedir. Manuel sulama sisteminde hiçbir değer etkilemeden veya kontrolsüz sulama yapabilirmektedir.
Projemizin sensör verileri şu şekilde okutuyor; sensörler Arduino UNO kartından okutulmaktadır. Arduino UNO kartından bu sensör 
verilerini Serial olarak Raspberry kartına aktarıyoruz. Raspberry bu verileri Firestore Veritabanımıza eklemektedir.
Hocamız tarafından istenilen uygulamamızın takip durumu için Mobil/Web Tabanlı takip edilebilen uygulamamızın Web Tabanlı kullanarak 
yapmaya karar verdik sebebi tüm platformlarda kullanılabilirlik avantajını sağladığı için uygulamamızı Web Tabanlı Uygulamamızda
takip edeceğiz.</b></i>
