function isEmptyOrSpaces(str) {
    return str === null || str.match(/^ *$/) !== null;
}

//retrieves and reload map data
function ReloadMap() {
    var missionID = document.getElementById("MissionSearch").value;
    console.log(missionID);
    //retrieves data and import it on marker
    GetWebPage("Fetch_product_data.php", function (text) { data = JSON.parse(text) }, (isEmptyOrSpaces(missionID) != null? "missionid=" + missionID : ""));
    markers.clearLayers();
    shapes.clearLayers();
    loadMarkers(data);
}

// calculates the area of the  lat longs position of the array.
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