#include <SimpleDHT.h>
#include "SoftwareSerial.h"

SoftwareSerial esp(11, 10); // RX, TX
SimpleDHT11 dht11;

// Wifi variables
String ssid ="Freebox-78A19C";
String password="Protected";

// http variables
String api_key = "ABC123";
String data;
String data_temp;
String server = "hextrial.com";
String uri = "/projects/watersystem/php/receive-data.php";
String uri_temp = "projects/watersystem/php/weather-data.php";

// Temperature variables
int pinDHT11 = 2; // Pin for air temperature
String air_temp;
String air_hum;

// Sensor variables
const int numPlants = 5;
const char* plantPins[numPlants] = {"A0","A1","A2","A3","A4"};
String plantNames[numPlants] = {"Glycine","Basilique","Morning Blue","Cucamelon","Lavende"};
int plantHumidityValues[numPlants];

void setup() {
  
  esp.begin(115200);
  Serial.begin(115200);
  Serial.println("-------------------------------------");
  Serial.println("*************************************");
  Serial.println("*********Start Initilize Wifi********");
  Serial.println("*************************************");
  Serial.println("-------------------------------------");
  resetWifi();
  delay(500);
  connectWifi(ssid, password);
  Serial.println("-------------------------------------");
  Serial.println("*************************************");
  Serial.println("**********End  Initilize Wifi********");
  Serial.println("*************************************");
  Serial.println("-------------------------------------");
}

void loop () {
  for (int i=0; i<numPlants; i++){
    int plant_id = i+1;
    data = "api_key=" + api_key + "&plant_id=" + plant_id + "&humidity=" + plantHumidityValues[i];
    httppost(server, uri, data);
    delay(5000);
  } 
  delay(3600000);
}

void resetWifi() {
  /*
   * Resets the wifi Module.
   * Will make it ready for new connections.
   * Once the module is successfully reset it will print it out in the Serial Monitor.
   */
  esp.println("AT+RST");
  delay(1000);
  if(esp.find("OK") ){
     Serial.println("Module Reset");
  } else {
    Serial.println("Could not reset module");
  }
}

void connectWifi(String ssid, String password) {
  /*
   * Connects the arduino to the chosen wifi network
   * Variables:
   * ssid = network name
   * pass = network password
   * This function will send a connect command and wait for 4 seconds for an answer.
   * Once a answer is received the function will tell if the module is connected in the Serial monitor.
  */
  
  String cmd = "AT+CWJAP=\"" +ssid+"\",\"" + password + "\"";
  esp.println(cmd);
  delay(5000);
  
  if(esp.find("OK")) {
    Serial.println("Connected!");
  } else {
  Serial.println("Cannot connect to wifi");
  delay(2000);
  Serial.println("Trying to establish connection"); 
  connectWifi(ssid, password);
  }
}

void httppost (String server, String uri, String data) {
  
  /*
   * This function sends the data via POST request to the server.
   * It will print in the Serial Monitor if the connection is established,
   * the data is being sent, the response of the server and if the data has been posted.
   */
  esp.println("AT+CIPSTART=\"TCP\",\"" + server + "\",80");//start a TCP connection.
  
  if( esp.find("OK")) {
    Serial.println("TCP connection ready...");
  }
  
  String postRequest =
  "POST " + uri + " HTTP/1.1\r\n" +
  "Host: " + server + "\r\n" +
  "Accept: *" + "/" + "*\r\n" +
  "Content-Length: " + data.length() + "\r\n" +
  "Content-Type: application/x-www-form-urlencoded\r\n" +
  "\r\n" + data;

  String sendCmd = "AT+CIPSEND=";
  esp.print(sendCmd);
  esp.println(postRequest.length() );

  if(esp.find(">")) { 
    Serial.println("Sending.."); 
    esp.print(postRequest);
    if(esp.find("SEND OK")) { 
      Serial.println("Packet sent");
      while (esp.available()) {
        String tmpResp = esp.readString();
        Serial.println(tmpResp);
      }

     // close the connection
     Serial.println("Closing connection");
     esp.println("AT+CIPCLOSE");
    }
  }
}

int readSensor(int plantPin, String plantName){
  /*
   * This function reads the value of the humidity sensor and will map it from 0 to 100.
   * It will print the value to the Serial Monitor
   */
  int value = analogRead(plantPin);
  value = constrain(value, 0, 1023);
  value = map(value, 1023, 250, 0, 100);
  Serial.println("Soil humidity " + plantName + ": " + value + "%");
  return value;
}

int readTemperature(int pin){


  //return temperature, humidity;
}

