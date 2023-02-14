GetWebPage("Fetch_product_data.php", function (text) { data = JSON.parse(text) });
loadMarkers(data);

//---------------
//---CODE BODY---
//---------------
//Creates a marker for each product pulled from the API
//also applies event based functions to each marker +
//attributes.

function onShiftDrag(e){
    shapes.clearLayers();
    var rectangle;
    var bounds = [[e.boxZoomBounds._northEast.lat, e.boxZoomBounds._northEast.lng],
    [e.boxZoomBounds._southWest.lat, e.boxZoomBounds._southWest.lng]];

    var rectangle = L.rectangle(bounds).addTo(shapes);

    let arr = [];
    //can be put into its own function
    markers.getLayers().forEach(element=>{
        if (rectangle.contains(element._latlng)) {
            
            arr.push(element.options.title);
        }
    });

    GetWebPage("SideBar_ProductDetails.php", function (text) {
        LoadSidebar(text);
    }, "identifier=" + arr);

    return;
}

function onMouseOver_marker(e){
    shapes.clearLayers();
    var bounds = e.sourceTarget.options.footprint.Coordinates[0];
    bounds.forEach(arr => {
        arr.reverse();
    });

    var polygon = L.polygon(bounds).addTo(shapes);
}

function onClick_Marker(e) {
    shapes.clearLayers();

    let arr = [e.sourceTarget.options.title];
    GetWebPage("SideBar_ProductDetails.php", function (text) {
        LoadSidebar(text);
    }, "identifier=" + arr);

    return;

    var gj = e.sourceTarget.options.GeoJSON;
    var body = "ID: " + gj.Identifier + "<br>NAME: " + gj.Name + "<br><br>COORDINATES: " + gj.Centre;
    document.getElementById('panel1').innerHTML = body;
}

map.on('boxzoomend', onShiftDrag);