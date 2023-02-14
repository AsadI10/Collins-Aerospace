GetWebPage("Fetch_product_data.php", function (text) { data = JSON.parse(text) });
loadMarkers(data);

//---------------
//---CODE BODY---
//---------------
//Creates a marker for each product pulled from the API
//also applies event based functions to each marker +
//attributes.

map.on('boxzoomend', onShiftDrag);

function onShiftDrag(e){
    shapes.clearLayers();

    var body = "";
    var rectangle;
    var bounds = [[e.boxZoomBounds._northEast.lat, e.boxZoomBounds._northEast.lng],
    [e.boxZoomBounds._southWest.lat, e.boxZoomBounds._southWest.lng]];

    var rectangle = L.rectangle(bounds).addTo(shapes);

    //can be put into its own function
    markers.getLayers().forEach(element=>{
        if(rectangle.contains(element._latlng)){
            body += element.options.title + "<br>";
        }
    });
    document.getElementById('panel1').innerHTML = body;
}

function onMouseOver_marker(e){

}

function onClick_Marker(e) {
    shapes.clearLayers();

    var gj = e.sourceTarget.options.GeoJSON;
    var body = "ID: " + gj.Identifier + "<br>NAME: " + gj.Name + "<br><br>COORDINATES: " + gj.Centre;
    document.getElementById('panel1').innerHTML = body;
}