
/*IsıveNem*/
#include "DHT.h"
#define DHTPIN 2
#define DHTTYPE DHT11
//#define DHTTYPE DHT22
//#define DHTTYPE DHT21
DHT isivenem(DHTPIN, DHTTYPE);

/*toprakveNem*/
const int prob = A0;
long olcum_sonucu;

/*YağmurSensörü*/
int yagmursensor=3;


/*SuSeviyesiSensörü*/
const int suseviyesisensoru=A1;
long suseviyesi_sonuc;

/*IşıkSensörü*/
const int isiksensoru=A2;
float isiksensoru_sonuc;


/*MiniDalgıçSuMotoru*/
/*const int minipower=13;
int motordurum = 0;
String control = "false";*/

void setup() {
pinMode(yagmursensor,INPUT);
/*pinMode(minipower,OUTPUT);*/
isivenem.begin();
Serial.begin(9600);

}

void loop() {

/*IsıveNemSensörü*/
delay(5000);
float h = isivenem.readHumidity();
float t = isivenem.readTemperature();
Serial.print("{\"nem\": ");
Serial.print(h);
Serial.print(",");
Serial.print("\"sicaklik\": ");
Serial.print(t);
Serial.print(",");
/*ToprakNemSensörü*/
  olcum_sonucu = analogRead(prob);
  long toprak_yuzde = ((1023-olcum_sonucu)*100)/1023;
  Serial.print("\"topraknem\": ");
  Serial.print(toprak_yuzde);
  Serial.print(",");

/*YağmurSensörü*/
bool yagmurdurum= digitalRead(yagmursensor);
  Serial.print("\"havaDurumu\": ");
if(yagmurdurum == false)
 {
  Serial.print("1");
 }
 else 
 {
  Serial.print("0");
 }
 Serial.print(",");

 /*SuSeviyesiSensörü*/
 suseviyesi_sonuc = analogRead(suseviyesisensoru);
 suseviyesi_sonuc = (suseviyesi_sonuc*100)/1023;
 Serial.print("\"suSeviye\": ");
 Serial.print(suseviyesi_sonuc);
Serial.print(",");
 
 /*IşıkSensörü*/
 isiksensoru_sonuc = 1023 - analogRead(isiksensoru);
 isiksensoru_sonuc = (isiksensoru_sonuc*100)/1023;
 Serial.print("\"isik\": ");
 Serial.print(isiksensoru_sonuc);
 Serial.print("}\n");
 
 /*MotorKontrol*/
 /*if(Serial.available())
 {
  control = Serial.readStringUntil('\n');
 }
 if(yagmurdurum==true && control.equals("true"))
 {
  digitalWrite(minipower,HIGH);
 }
 else
 {
 digitalWrite(minipower,LOW); 
 }*/
}
