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
        // Create marker at coordinates
        L.marker([latlang[0], latlang[1]], {
<<<<<<< HEAD
            icon: greenIcon,
=======
            // Set tags
>>>>>>> 71d2bc3c62dfb0c7fd6d1a049112a7053e6d28bf
            title: id,
            GeoJSON: tmp,
            footprint: footp
        // Add to the maps collection of markers
        }).addTo(markers).bindPopup(id)
            // Set events
            .on('click', onClick_Marker)
            .on('mouseover',onMouseOver_marker);
    }
}
