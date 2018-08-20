// Libraries
#include "plant.h"
#include <SoftwareSerial.h>
#include <WiFi.h>
#include <WiFiClient.h>
#include <WiFiServer.h>
#include <WiFiUdp.h>

#define DEBUG true

//Pin declaration
SoftwareSerial ESP8266 (10, 11);

//Object declaration
int numPlants = 5;
Plant plants[5];

//Wifi variables
String WifiName = "Freebox-78A19C";
String WifiPassword = "Protected";
int status = WL_IDLE_STATUS;


void setup() {
  Serial.begin(9600);
  
  // Initialize wifi connection
  ESP8266.begin(9600);
  initWifi();

  
  // Initiate plants
  //Plante 1
  plants[0].name = "Lavende";
  plants[0].pin = A0;
  plants[0].waterLimitHigh = 60;
  plants[0].waterLimitLow = 20;
  plants[0].needsWater = false;
  plants[0].humidity = 0;

  //Plante 2
  plants[1].name = "Basilique Sauvage";
  plants[1].pin = A1;
  plants[1].waterLimitHigh = 10;
  plants[1].waterLimitLow = 50;
  plants[1].needsWater = false;
  plants[1].humidity = 0;

  //Plante 3
  plants[2].name = "Morning Blue";
  plants[2].pin = A2;
  plants[2].waterLimitHigh = 0;
  plants[2].waterLimitLow = 20;
  plants[2].needsWater = false;
  plants[2].humidity = 0;

  //Plante 4
  plants[3].name = "Menthe";
  plants[3].pin = A3;
  plants[3].waterLimitHigh = 0;
  plants[3].waterLimitLow = 20;
  plants[3].needsWater = false;
  plants[3].humidity = 0;

  //Plante 5
  plants[4].name = "Lila";
  plants[4].pin = A4;
  plants[4].waterLimitHigh = 0;
  plants[4].waterLimitLow = 20;
  plants[4].needsWater = false;
  plants[4].humidity = 0;
}

void loop() {

  //1. read the reading of the sensor
  for (int i=0; i<numPlants; i++){
    plants[i].humidity = readSensor(plants[i].pin);
  }

  // 2. Verifier si les plantes ont besoin d'eau
  for (int i=0; i<numPlants; i++){
    plants[i].needsWater = doesPlantNeedWater(plants[i].humidity, plants[i].waterLimitLow);
    if(plants[i].needsWater == true){
      Serial.println(plants[i].name);
      Serial.println("Water this plant");
      delay(2000);
    }
    else{
      Serial.println(plants[i].name);
      Serial.println("plant does not need water.");
      delay(2000);
    }
  }
  Serial.println("**************************************");

  int connectionId = ESP8266.read()-48;
  
  String webpage = "<h1>Hello World</h1>";

  String cipSend = "AT+CIPSEND=";
  cipSend += connectionId;
  cipSend += ",";
  cipSend += webpage.length();
  cipSend +="\r\n";

  sendData(cipSend, 1000, DEBUG);
  sendData(webpage, 1000, DEBUG);
  
  delay(1000*5);
}

int readSensor(int pin){
  /*
   * This function will read the value of the Hygrosensor
   * the sensor returns a value between 400 (max wet) and 1023 (max dry)
   * the sensor value is mapped between 100 and 0 in order to get a percentage
   * the value is finally retruned
   */
  int value = analogRead(pin);
  value = constrain(value, 400, 1023);
  value = map(value, 400, 1023, 100, 0);
  return value;
}

bool doesPlantNeedWater(int waterLevel, int limitLow){
  /*
   * This function will compare the huidity level read on the sensor and the lower limit 
   * of the plant.
   * If the humidity level is lower than the limit, it will return a 'true' value else is will return 'false' 
   */
  if(waterLevel > limitLow){
    return false;
  }
  else{
    return true;
  }
}

void initWifi(){
  Serial.println("**********************************************************");  
  Serial.println("******************* START INITIALIZATION *****************");
  Serial.println("**********************************************************");  
  sendToESP8266("AT+RST");
  receivesFromESP8266(1000*2);
  Serial.println("**********************************************************");
  sendToESP8266("AT+CWMODE=3");
  receivesFromESP8266(1000*5);
  Serial.println("**********************************************************");
  sendToESP8266("AT+CWJAP=\""+ WifiName + "\",\"" + WifiPassword +"\"");
  receivesFromESP8266(1000*10);
  Serial.println("**********************************************************");
  sendToESP8266("AT+CIFSR");
  receivesFromESP8266(1000*1);
  Serial.println("**********************************************************");
  sendToESP8266("AT+CIPMUX=1");   
  receivesFromESP8266(1000*1);
  Serial.println("**********************************************************");
  sendToESP8266("AT+CIPSERVER=1,80");
  receivesFromESP8266(1000*1);
  Serial.println("**********************************************************");
  Serial.println("***************** END INITIALIZATION *********************");
  Serial.println("**********************************************************");
  Serial.println("");
}

void sendToESP8266(String instruction){
  ESP8266.println(instruction);
}

void receivesFromESP8266(const int timeout){
  String response = "";
  long int time = millis();
  while((time + timeout ) > millis()){
    while(ESP8266.available()){
      char c = ESP8266.read();
      response+=c;
    }
  }
  Serial.print(response);
}

String sendData(String command, const int timeout, boolean debug){
  String response = "";
  ESP8266.print(command);
  long int time = millis();
  while((time+timeout)>millis()){
    while(ESP8266.available()){
      char c = ESP8266.read();
      response += c; 
    }
  }

  if(debug){
    Serial.print(response);
  }
  return response;
}
