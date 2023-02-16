GetWebPage("Fetch_product_data.php", function (text) { data = JSON.parse(text) });
loadMarkers(data);
//---------------
//---CODE BODY---
//---------------
//Creates a marker for each product pulled from the API
//also applies event based functions to each marker +
//attributes.
map.on('boxzoomend', onShiftDrag);
//Allows us to know what markers the user is looking at
map.on('zoomend', getVisibleMarkers);
map.on('dragend',getVisibleMarkers);

function onShiftDrag(e){
    shapes.clearLayers();
    var rectangle;
    var bounds = [[e.boxZoomBounds._northEast.lat, e.boxZoomBounds._northEast.lng],
    [e.boxZoomBounds._southWest.lat, e.boxZoomBounds._southWest.lng]];

    var rectangle = L.rectangle(bounds,{
        fillColor: 'red',
        color: 'red'
        }).addTo(shapes);
    let arr = [];
    //can be put into its own function
    markers.getLayers().forEach(element => {
        if (rectangle.contains(element._latlng)) {
            arr.push(element.options.title);
        }
    });

    GetWebPage("SideBar_ProductDetails.php", function (text) {
        LoadSidebar(text);
    }, "identifier=" + arr);
    return;
}

function getVisibleMarkers(e){
    var arr = [];

    markers.getLayers().forEach(element => {
        if(map.getBounds().contains(element._latlng)){
            arr.push(Math.round(calculateArea(element.options.footprint.Coordinates[0])));
        }
    });
    console.log(arr);// for testing
    loadPieChart(arr);
}

function calculateArea(latLngs) {

    var pointsCount = latLngs.length,
        area = 0.0,
        d2r = Math.PI / 180,
        p1, p2;

    if (pointsCount > 2) {
        for (var i = 0; i < pointsCount; i++) {
            p1 = latLngs[i];
            p2 = latLngs[(i + 1) % pointsCount];
            area += ((p2[0] - p1[0]) * d2r) *
                (2 + Math.sin(p1[1] * d2r) + Math.sin(p2[1] * d2r));
        }
        area = area * 6378137.0 * 6378137.0 / 2.0;
    }

    return Math.abs(area);
}

function onMouseOver_marker(e){
    //add support for polylines
    var bounds = e.sourceTarget.options.footprint.Coordinates[0];
    bounds.forEach(arr => {
        arr.reverse();
    });

    L.polygon(bounds,{
        fillColor: 'red',
        color: 'red'
    }).addTo(footprints);
}

function offMouseOver_marker(e){
    footprints.clearLayers();
}

function onClick_Marker(e) {
    shapes.clearLayers();

    let arr = [e.sourceTarget.options.title];
    GetWebPage("SideBar_ProductDetails.php", function (text) {
        LoadSidebar(text);
    }, "identifier=" + arr);
}