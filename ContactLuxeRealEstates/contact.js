function initMap() {
    var options = {
      zoom: 15,
      center: { lat: 6.4478, lng: 3.4723 },
    };
  
    var lekki = { lat: 6.4478, lng: 3.4723 };
  
    var map = new google.maps.Map(document.querySelector("#map"), options);
  
    var marker = new google.maps.Marker({ position: lekki, map: map });
  }