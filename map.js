//ALL MAP DATA AND ASSOCIATED FUNCTIONS.
var userpoints = [];
var markers = [];
var map = L.map('map').setView([53.45043, -2.25975], 13);

document.getElementsByClassName( 'leaflet-control-attribution' )[0].style.display = 'none';

L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
maxZoom: 18,
attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(map);

//map.on('contextmenu', oncontextmenu);
//map.on('click', onMapClick);
loadProducts();

function onMapClick(e) {
     userpoints.push(e.latlng);
     L.marker(e.latlng).addTo(map);
}

function oncontextmenu(e) {
     var polygon;
     polygon = L.polygon(points).addTo(map);
     userpoints = [];
}

//GONNA HAVE TO GET LARGE SPECIFICS IN JS ITSELF
function loadProducts(){
     fetch('Fetch_product_data.php')
     .then(function(response){
          return response.json();
     }).then(function(data){
          for(let i = 0; i < 121; i++){
               var tmp = JSON.parse(data[i]);
               var id = tmp.product.id;
               var centre = tmp.product.result.centre;
               var latlang = centre.split(',');
               markers[i] = L.marker([latlang[0],latlang[1]],{
                    title: id
               }).addTo(map);

               markers[i].bindPopup(id).openPopup();
          }
     });
}
