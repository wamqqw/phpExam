

function getWeatherData(country, name) {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
      if (this.readyState === 4 && this.status === 200) {
        var cities = JSON.parse(this.responseText);
        console.log(cities);
        displayWeatherData(cities);
      }
    };
    xhr.open("GET", "catalog.php?country=" + country + "&name=" + name, true);
    xhr.send();
}
function displayWeatherData(cities) {
    var weatherContainer = document.getElementById("weatherContainer");
    weatherContainer.innerHTML = "";
    cities.forEach(function(city) {
        var cityCard = document.createElement("div");
        cityCard.classList.add("city-card");

        var cityName = document.createElement("h2");
        cityName.textContent = city.name;
        cityCard.appendChild(cityName);

        var countryName = document.createElement("p");
        countryName.textContent = "Country: " + city.country;
        cityCard.appendChild(countryName);

        var minTemp = document.createElement("p");
        minTemp.textContent = "Min Temperature: " + city.min_temp + "°C";
        cityCard.appendChild(minTemp);

        var maxTemp = document.createElement("p");
        maxTemp.textContent = "Max Temperature: " + city.max_temp + "°C";
        cityCard.appendChild(maxTemp);

        var days = document.createElement("p");
        days.textContent = "Days: " + city.days;
        cityCard.appendChild(days);

        var feelsLike = document.createElement("p");
        feelsLike.textContent = "Feels Like: " + city.feels_like;
        cityCard.appendChild(feelsLike);

        var wind = document.createElement("p");
        wind.textContent = "Wind: " + city.wind;
        cityCard.appendChild(wind);
        
        var addButton = document.createElement('button');
        addButton.textContent = 'Add';
        addButton.classList.add('add-btn');
        addButton.addEventListener('click', function() {
            console.log('City ' + city.name + ' added to favorites');
        });

        cityCard.appendChild(addButton);

        weatherContainer.appendChild(cityCard);
    });
}
getWeatherData("Kazakhstan", ""); 
  