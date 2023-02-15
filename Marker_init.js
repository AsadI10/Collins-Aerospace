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
        //not working for now
        //.bindPopup(createFootprintPopup(footp)).closePopup()
        // Set events
        .on('click', onClick_Marker)
        .on('mouseover',onMouseOver_marker)
        .on('mouseout',offMouseOver_marker);
    }
}

/* not working for now
function createFootprintPopup(footprint){
    let k = [];

    switch(footprint.Type){
        case "LineString":
            footprint.Coordinates.forEach(element => {
                k.push(element.reverse());
            })
            return L.polyline(k);
        case "Polygon":
            footprint.Coordinates[0].forEach(element => {
                k.push(element.reverse());
            })
            return L.polygon(k);
    }
}
*/