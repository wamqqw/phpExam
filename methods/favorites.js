function addToFavorites(cityId, orderNum) {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
            console.log(this.responseText);
        }
    };
    var data = new FormData();
    data.append('city_id', cityId);
    data.append('order_num', orderNum);

    xhr.open("POST", "add_to_favorites.php", true);
    xhr.send(data);
}
document.addEventListener('click', function(event) {
    if (event.target.classList.contains('add-to-favorites')) {
        var cityId = event.target.dataset.cityId;
        var orderNum = event.target.dataset.orderNum;
        addToFavorites(cityId, orderNum);
    }
});


var header = document.querySelector('.header');
        var images = [
            'https://wallpapercave.com/wp/wp3640547.jpg',
            'https://wallpaperaccess.com/full/1968762.jpg', 
            'https://wallpaperaccess.com/full/1968789.jpg'
        ];
var index = 0;
function changeImage() {
    header.style.backgroundImage = 'url(' + images[index] + ')';
    index = (index + 1) % images.length;
}
setInterval(changeImage, 3000);
