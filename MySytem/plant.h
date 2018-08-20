#ifndef plant
#define plant

#if (ARDUINO >= 100)
  #include "Arduino.h"
#else
  #include "WProgram.h"
#endif

class Plant {
  public: 
    // Constructor
    Plant (bool displayMsg = false);
    String name;
    int pin;
    int waterLimitHigh;
    int waterLimitLow;
    bool needsWater;
    int humidity;
    
  private:
};
#endif

