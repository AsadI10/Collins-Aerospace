//===================================
// Initilizes all markers on the map
//===================================

// Loads an array of ProductData and displays them as markers on the map
function loadMarkers(pulledData){
    for (let i = 0; i < pulledData.length; i++) {
        var tmp = pulledData[i];
        if(tmp["Footprint"].Coordinates !== null){
            var id = tmp["Identifier"];
            // Parse the coordinates of the centre
            var centre = tmp["Centre"];
            var footp = tmp["Footprint"];
            var latlang = centre.split(',');
            var calcArea = Math.round(calculateArea(footp.Coordinates[0])) / 1000000;

            L.marker([latlang[0], latlang[1]], {
                index: i + 1,
                icon: greenIcon,
                // Set tags
                title: id,
                GeoJSON: tmp,
                footprint: footp,
                // calculates the footprints area and stores it to the object once (val is const)
                area: calcArea
            // Add to the maps collection of markers
            }).addTo(markers)
            .bindPopup("Product: " + (i + 1) + " / " + pulledData.length + "<BR>Coverage: " + calcArea + "KM²")
            // Set events
            .on('click', onClick_Marker)
            .on('mouseover',onMouseOver_marker)
            .on('mouseout',offMouseOver_marker);
        }
        

        markers.on('clusterclick',onClick_Cluster);
    }
}