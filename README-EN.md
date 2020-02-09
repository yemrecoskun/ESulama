# E Irrigation
 ## Tools used in our project:
 ### Card
 - Arduino UNO
 - Raspberry PI Zero Wh
 ### Sensors
 - Water level sensor
 - Rain Sensor
 - Light Sensor
 - Soil and moisture sensor
 - Heat and humidity sensor
 ## Languages and programs
 - Python
 - Arduino Editor
 - Firebase
  PHP,HTML,CSS,JS
 ## Working principle of our project:
 ## Let us examine the following conditions, 
- if the water capacity in the water tank is below 30% (water level sensor), 
- whether the weather is rainy or not (rain sensor)),
- if the ambient light sufficiency is below 5% (light sensor),
  
  if it provides conditions such as the water engine becomes workable.

 ## The system can then do automatic/manual irrigation with the water engine.
 ### Automatic irrigation system 
 - Soil moisture status
 - ambient temperature status 
 
controlled active irrigation can be done by giving value to the user from the system. 

### Manual irrigation system 
it can do irrigation for 10 seconds without affecting any value.

## The sensor data of our project is read as follows;
1st. Sensors are read from the Arduino Uno card. 
2nd ed. We transfer this sensor data from the Arduino Uno card to the Raspberry card in Serial.
3. Raspberry adds this data to our Firestore database.

In our project, we operate the water engine with raspberry.

We decided to use Web-based for the tracking status of our application because it provides the advantage of usability across all platforms, we will follow our application in our Web-based application.

# Web
* Live data graph shows live data of sensors on the screen. 
* Automatic irrigation can be done Active/Passive.
* Manual irrigation can be applied.
