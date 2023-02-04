//ALL MAP DATA AND ASSOCIATED FUNCTIONS.
fetch('Fetch_product_data.php')
.then(function(response){
     return response.json();
}).then(function(data){

//---------------
//---CODE BODY---
//---------------

var userpoints = [];
var map = L.map('map').setView([53.45043, -2.25975], 13);
var markers = new L.LayerGroup().addTo(map);

document.getElementsByClassName( 'leaflet-control-attribution' )[0].style.display = 'none';

L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
maxZoom: 18,
attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(map);

//Creates a marker for each product pulled from the API
//also applies event based functions to each marker +
//attributes.
for(let i = 0; i < 121; i++){
     var tmp = JSON.parse(data[i]);
     var id = tmp.product.id;
     var centre = tmp.product.result.centre;
     var latlang = centre.split(',');
     L.marker([latlang[0],latlang[1]],{
          title: id,
          GeoJSON: tmp
     }).addTo(markers).bindPopup(id).on('click',onClick_Marker);
}

//when a marker is clicked all of its metadata is returned
function onClick_Marker(e){
     var gj = e.sourceTarget.options.GeoJSON;
     console.log(gj);
     var body = "ID: " + gj.product.result.identifier + "\n NAME: " + gj.product.result.title + "\n\n COORDINATES: " + gj.product.result.centre;
     document.getElementById('panel1').innerHTML= body;
}

});
