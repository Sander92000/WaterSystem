//Eventlisteners
document.getElementById('humidity').addEventListener('change', displayValueHumidity);
document.getElementById('light').addEventListener('change', displayValueLight);

// Fucntions
function displayValueHumidity(){
    let humidity = document.getElementById('humidity').value;
    document.getElementById('value-humidity').innerHTML = humidity + "%";
}

function displayValueLight(){
    let humidity = document.getElementById('light').value;
    document.getElementById('value-light').innerHTML = humidity + "%";
}