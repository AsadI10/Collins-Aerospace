//===================================
// Initilizes all markers on the map
//===================================

function loadMarkers(pulledData){
    for (let i = 0; i < pulledData.length; i++) {
        var tmp = pulledData[i];
        var id = tmp["Identifier"];
        var centre = tmp["Centre"];
        var footp = tmp["Footprint"];
        var latlang = centre.split(',');

        L.marker([latlang[0], latlang[1]], {
            title: id,
            GeoJSON: tmp,
            footprint: footp
        }).addTo(markers).bindPopup(id)
            .on('click', onClick_Marker)
            .on('mouseover',onMouseOver_marker);
    }
}
