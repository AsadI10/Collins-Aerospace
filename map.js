ReloadMap();
//---------------
//---CODE BODY---
//---------------
//Creates a marker for each product pulled from the API
//also applies event based functions to each marker +
//attributes.
map.on('boxzoomend', onShiftDrag);
//Allows us to know what markers the user is looking at
map.on('zoomend', getVisibleMarkers);
map.on('dragend', getVisibleMarkers);


function getVisibleMarkers(e){
    var arr = [];

    markers.getLayers().forEach(element => {
        if(map.getBounds().contains(element._latlng)){
            arr.push(element.options.area);
        }
    });

    loadPieChart(arr);
    loadSideBarGeneral(arr);
}

// Map events

function onShiftDrag(e){
    clearProducts();
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
    const maxDisplay = 20
    var counter = 0;
    markers.getLayers().forEach(element => {
        if (rectangle.contains(element._latlng) && counter < maxDisplay) {
            arr.push(element.options.title);
            loadSideBarProduct(element);
            counter = counter + 1;
        }
    });
    if (counter == maxDisplay) {

    }
}

//https://stackoverflow.com/questions/53604117/calculate-area-of-a-polygon-using-longitude-and-latitude-using-javascript
//explanation on the last comment
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
    e.target.openPopup();
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
    e.target.closePopup();
    footprints.clearLayers();
}

function onClick_Marker(e) {
    clearProducts();
    shapes.clearLayers();

    loadSideBarProduct(this);
}