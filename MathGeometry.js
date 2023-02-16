//from https://stackoverflow.com/questions/27928/calculate-distance-between-two-latitude-longitude-points-haversine-formula
function getDistance(lat1, lon1, lat2, lon2) {
    var p = 0.017453292519943295;    // Math.PI / 180
    var c = Math.cos;
    var a = 0.5 - c((lat2 - lat1) * p)/2 + 
            c(lat1 * p) * c(lat2 * p) * 
            (1 - c((lon2 - lon1) * p))/2;
  
    return 12742 * Math.asin(Math.sqrt(a)); // 2 * R; R = 6371 km
}

function calculateTotalArea(latlng){
    //allows us to figure out how many iterations we make.
    let data = latlng.Coordinates[0];
    let size = latlng.Coordinates[0].length;

    for(let i = 0; i < size; i++){
        console.log(latlng.Coordinates[0][i]);
    }
}

function polygonArea(X, Y, numPoints) {
    let area = 0;         // Accumulates area in the loop
    let j = numPoints-1;  // The last vertex is the 'previous' one to the first
  
    for (i=0; i<numPoints; i++) {
      area = area +  (X[j]+X[i]) * (Y[j]-Y[i]);
      j = i;  //j is previous vertex to i
    }
    return area/2;
}

function calcTotalArea(latlng){
  let xpoints = [];
  let ypoints = [];
  let lat_dist = 6371009;
  var i;
  for (i = 0; i < latlng.Coordinates[0].length; i++) {
      let cartoPoint = Cesium.Cartographic.fromCartesian(latlng[0][i]);
      let lng = cartoPoint[1];
      let lat = cartoPoint[0];
      xpoints[i] = lng * lat_dist * Math.cos(lat);
      ypoints[i] = lat * lat_dist;
  };
  return polygonArea(xpoints, ypoints, xpoints.length);
}