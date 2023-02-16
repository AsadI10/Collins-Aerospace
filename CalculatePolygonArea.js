function CalculateTriArea(x, y, z) {
    console.log(x, y, z);
    return 1;
}

function CalculatePolygonArea(coordinateArr) {
    var currentArea = 0;
    // Itterate while there are tris to calculate
    while (coordinateArr.length >= 3) {
        coordinateArr.push(coordinateArr[0], coordinateArr[2]);
        currentArea += CalculateTriArea(coordinateArr.shift(), coordinateArr.shift(), coordinateArr.shift());
    }
}