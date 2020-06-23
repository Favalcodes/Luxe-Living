
function initMap(){

    //Map options
    var options={
        zoom:8,
        center:{lat:37.8393,lng:-84.2700}
    };

    //New Map
    var map=new google.maps.Map(document.getElementById('map'), options);

    // Add marker
    var marker= new google.maps.Marker({
        position:{lat:37.9363,lng:-84.2800},
        map:map
    })


    var info= new google.maps.InfoWindow({
        content:'<p style="color:#55acee; font-weight:600;">Ivy luxuria apartment</p>'
    })

    marker.addListener('click',function(){
        info.open(map,marker);
    })
    

};

