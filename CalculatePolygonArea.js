//from https://stackoverflow.com/questions/27928/calculate-distance-between-two-latitude-longitude-points-haversine-formula
function getDistance(lat1, lon1, lat2, lon2) {
    var p = 0.017453292519943295;    // Math.PI / 180
    var c = Math.cos;
    var a = 0.5 - c((lat2 - lat1) * p) / 2 +
        c(lat1 * p) * c(lat2 * p) *
        (1 - c((lon2 - lon1) * p)) / 2;

    return 12742 * Math.asin(Math.sqrt(a)); // 2 * R; R = 6371 km
}

function degtorad(a) {
    return (a * Math.PI) / 180
}

function CalculateTriArea(x, y, z) {
    console.log(x);
    // Heron's formula
    var a = getDistance(x[0], x[1], y[0], y[1]);
    var b = getDistance(y[0], y[1], z[0], z[1]);
    var c = getDistance(x[0], x[1], z[0], z[1]);
    var s = (a + b + c) / 2;
    return Math.sqrt(s * (s - a) * (s - b) * (s - c));
}

function CalculatePolygonArea(coordinateArr, size) {
    var currentArea = 0;
    // Itterate while there are tris to calculate
    while (size >= 3) {
        coordinateArr.push(coordinateArr[0], coordinateArr[2]);
        var triArea = CalculateTriArea(coordinateArr.shift(), coordinateArr.shift(), coordinateArr.shift());
        console.log(coordinateArr);
        currentArea += triArea;
    }
    return currentArea;
}