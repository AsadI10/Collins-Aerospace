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


function getVisibleMarkers(e){
    var arr = [];

    markers.getLayers().forEach(element => {
        if(map.getBounds().contains(element._latlng)){
            arr.push(Math.round(calculateArea(element.options.footprint.Coordinates[0])));
        }
    });

    loadPieChart(arr);
    loadSideBarGeneral(arr.length);
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
    markers.getLayers().forEach(element => {
        if (rectangle.contains(element._latlng)) {
            arr.push(element.options.title);
            loadSideBarProduct(element);
        }
    });

    //this should not be repeated, its lazy af rn but i cant style multiple panels lmao so itll have to do.
    //loadSideBarGeneral(arr.length);
    /*
    GetWebPage("SideBar_ProductDetails.php", function (text) {
        LoadSidebar(text);
    }, "identifier=" + arr);
    return;
    */

}

function onMouseOver_marker(e) {
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
    /*
    GetWebPage("SideBar_ProductDetails.php", function (text) {
        LoadSidebar(text);
    }, "identifier=" + arr);
    */
}