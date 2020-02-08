import serial
import time
import datetime
import json
import firebase_admin
import RPi.GPIO as GPIO
from firebase_admin import credentials
from firebase_admin import firestore

GPIO.setmode(GPIO.BOARD)
GPIO.setup(11,GPIO.OUT)

	

cred = credentials.ApplicationDefault()
firebase_admin.initialize_app(cred, {
    'projectId': 'e-sulama'
})

db = firestore.client()
ser = serial.Serial("/dev/ttyS0", 9600)

#pumpControl = db.collection("SensorData").document("pumpControl").get()
#print(pumpControl["control"])


while True:
	x = datetime.datetime.now()
	if x.hour+3 >= 24 :
		hour = x.hour-21
	else :
		hour = x.hour+3

	if x.day>0 and x.day<10 :
		if x.month>0 and x.month<10 :
			calendar = "0"+str(x.day)+"-0"+str(x.month)+"-"+str(x.year)
		else :
			calendar = "0"+str(x.day)+"-"+str(x.month)+"-"+str(x.year)
	else :
		if x.month>0 and x.month<10 :
			calendar = str(x.day)+"-0"+str(x.month)+"-"+str(x.year)
		else :
			calendar = str(x.day)+"-"+str(x.month)+"-"+str(x.year)
	if hour>0 and hour<10 :
		if x.minute>0 and x.minute<10 :
			if x.second>0 and x.second<10 :
				clock = "0"+str(hour)+":0"+str(x.minute)+":0"+str(x.second)
			else :
				clock = "0"+str(hour)+":0"+str(x.minute)+":"+str(x.second)
		else :
			if x.second>0 and x.second<10 :
				clock = "0"+str(hour)+":"+str(x.minute)+":0"+str(x.second)
			else :
				clock = "0"+str(hour)+":"+str(x.minute)+":"+str(x.second)
	else :
		if x.minute>0 and x.minute<10 :
			if x.second>0 and x.second<10 :
				clock = str(hour)+":0"+str(x.minute)+":0"+str(x.second)
			else :
				clock = str(hour)+":0"+str(x.minute)+":"+str(x.second)
		else :
			if x.second>0 and x.second<10 :
				clock = str(hour)+":"+str(x.minute)+":0"+str(x.second)
			else :
				clock = str(hour)+":"+str(x.minute)+":"+str(x.second)

	serstr = ser.readline()
	val = json.loads(serstr)
	db.collection("SensorData").document("nowData").set({
		u"Temperature": val["sicaklik"],
		u"Humidity": val["nem"],
		u"Light": val["isik"],
		u"WaterLevel": val["suSeviye"],
		u"EarthHumidty": val["topraknem"],
		u"Weather": val["havaDurumu"],
		u"Calendar" : calendar,
		u"Clock" : clock
	})


	if x.hour+3>0 and x.hour+3<10 :
		hour = "0"+str(x.hour+3)
	else :
		hour = str(x.hour+3)
	
	db.collection(calendar).document(str(hour)).set({
		u"Temperature": val["sicaklik"],
		u"Humidity": val["nem"],
		u"Light": val["isik"],
		u"WaterLevel": val["suSeviye"],
		u"EarthHumidty": val["topraknem"],
		u"Calendar" : calendar,
		u"Clock" : clock,
		u"Weather": val["havaDurumu"]
	})
	pumpdata = db.collection("SensorData").document("pump").get().to_dict()
	if val["suSeviye"] > 30 and val["isik"] > 10 and val["havaDurumu"] == 0 :
		if pumpdata["autoControl"] == 1 :
			if val["topraknem"]  < pumpdata["EarthHumidty"] and val["sicaklik"] < pumpdata["tempControl"]:
				print("motor devrede")
				GPIO.output(11,GPIO.HIGH)
				time.sleep(5)
				GPIO.output(11,GPIO.LOW)
				time.sleep(5)
			elif pumpdata["control"] == 1 :
				print("autocontrol devredışı")
				GPIO.output(11,GPIO.HIGH)
				time.sleep(10)
				GPIO.output(11,GPIO.LOW)
				db.collection("SensorData").document("pump").set({
					u"autoControl": 0,
					u"control": 0,
					u"EarthHumidty": val["topraknem"]
				})
			else :
				print("Motor Devredışı")
				GPIO.output(11,GPIO.LOW)
		elif pumpdata["control"] == 1:
			print("autocontrol devredışı")
			GPIO.output(11,GPIO.HIGH)
			time.sleep(10)
			GPIO.output(11,GPIO.LOW)
			db.collection("SensorData").document("pump").set({
				u"autoControl": 0,
				u"control": 0,
				u"EarthHumidty": val["topraknem"]
			})
	else : 
		print("SuSeviyesiYetersiz")
	print(ser.readline())
	time.sleep(1)
