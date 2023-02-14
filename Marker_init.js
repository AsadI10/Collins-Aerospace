//===================================
// Initilizes all markers on the map
//===================================

// Loads an array of ProductData and displays them as markers on the map
function loadMarkers(pulledData){
    for (let i = 0; i < pulledData.length; i++) {
        var tmp = pulledData[i];
        var id = tmp["Identifier"];
        // Parse the coordinates of the centre
        var centre = tmp["Centre"];
        var footp = tmp["Footprint"];
        var latlang = centre.split(',');

        L.marker([latlang[0], latlang[1]], {
            icon: greenIcon,
            // Set tags
            title: id,
            GeoJSON: tmp,
            footprint: footp
        // Add to the maps collection of markers
        }).addTo(markers)
        .bindPopup(id)
        .bindPopup(createFootprintPopup(footp))
        // Set events
        .on('click', onClick_Marker)
        .on('mouseover',onMouseOver_marker);
    }
}

function createFootprintPopup(footprint){
    let shape = null;
    switch(footprint.Type){
        case "LineString":
            shape = L.polyline(footprint.Coordinates.forEach(element => {
                element.reverse();
            })).addTo(shapes);
            break;
        case "Polygon":
            shape = L.polygon(footprint.Coordinates.forEach(element => {
                element.reverse();
            })).addTo(shapes);
            break;
    }
    console.log(shape);
    return shape;
}
