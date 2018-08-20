//Global Variables
let menuIsDisplayed = false;

// Eventlisteners
document.getElementById('menu-btn').addEventListener('click', displayMenu);
//document.getElementById('page').addEventListener('click', displayMenu);

// Functions
function displayMenu(){
    if(menuIsDisplayed == false){
        document.getElementById('page').style.width = "80%";
        document.getElementById('menu').style.width = "20%";
        menuIsDisplayed = true;
        console.log(menuIsDisplayed);
    } else {
        document.getElementById('page').style.width = "100%";
        document.getElementById('menu').style.width = "0%";
        menuIsDisplayed = false;
        console.log(menuIsDisplayed);
    }
}