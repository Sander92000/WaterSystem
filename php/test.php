AT+CWMODE=1
AT+CWJAP="Freebox-78A19C","Protected"
AT+CIPMUX=1
AT+CIPSTART=1,"TCP","hextrial.com",80
AT+CIPSEND=1,82
GET /receive.php?api_key=ABC123&sensor1=23&sensor2=24&sensor3=25&sensor4=26&sensor4=27
AT+CIPCLOSE=1
