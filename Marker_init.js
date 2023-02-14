//===================================
// Initilizes all markers on the map
//===================================

function loadMarkers(pulledData){
    for (let i = 0; i < pulledData.length; i++) {
        var tmp = pulledData[i];
        var id = tmp["Identifier"];
        var centre = tmp["Centre"];
        var latlang = centre.split(',');
        L.marker([latlang[0], latlang[1]], {
            icon: greenIcon,
            title: id,
            GeoJSON: tmp,
        }).addTo(markers).bindPopup(id)
            .on('click', onClick_Marker)
            .on('mouseover',onMouseOver_marker);
    }
}
