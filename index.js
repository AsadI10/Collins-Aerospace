function isEmptyOrSpaces(str) {
    return str === null || str.match(/^ *$/) !== null;
}

/*
function filterMarkerLayers(){
	var missionID = document.getElementById("MissionSearch").value;
	if(missionID == null){
		toggleAllMarkersOn();
		return;
	}

	markers.getLayers().forEach(element => {
		if(element.options.GeoJSON.missionid != missionID){
			toggleMarker(element);
		}
	});
}
*/

function ReloadMap() {
    var missionID = document.getElementById("MissionSearch").value;
    console.log(missionID);
    GetWebPage("Fetch_product_data.php", function (text) { data = JSON.parse(text) }, (isEmptyOrSpaces(missionID) != null? "missionid=" + missionID : ""));
    markers.clearLayers();
    shapes.clearLayers();
    loadMarkers(data);
}
/*

function toggleMarker(marker){

	if(map.hasLayer(marker)){
		map.removeLayer(marker)
	}
	else {
		map.addLayer(marker)
	}
}

function toggleAllMarkersOn(){
	markers.getLayers().forEach(element => {
		if(!map.hasLayer(marker)){
			map.addLayer(marker);
		}
	});
}
*/

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

// ALGORITHM TAKEN FROM https://gist.github.com/adammiller/826148
// JAVASCRIPT IMPLMENETATION OF THE Ramer–Douglas–Peucker algorithm
// READ MORE HERE https://en.wikipedia.org/wiki/Ramer%E2%80%93Douglas%E2%80%
// LICENCE http://unlicense.org/ !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

var simplifyPath = function( points, tolerance ) {
    
	// helper classes 
	var Vector = function( x, y ) {
		this.x = x;
		this.y = y;
		
	};
	var Line = function( p1, p2 ) {
		this.p1 = p1;
		this.p2 = p2;
		
		this.distanceToPoint = function( point ) {
			// slope
			var m = ( this.p2.y - this.p1.y ) / ( this.p2.x - this.p1.x ),
				// y offset
				b = this.p1.y - ( m * this.p1.x ),
				d = [];
			// distance to the linear equation
			d.push( Math.abs( point.y - ( m * point.x ) - b ) / Math.sqrt( Math.pow( m, 2 ) + 1 ) );
			// distance to p1
			d.push( Math.sqrt( Math.pow( ( point.x - this.p1.x ), 2 ) + Math.pow( ( point.y - this.p1.y ), 2 ) ) );
			// distance to p2
			d.push( Math.sqrt( Math.pow( ( point.x - this.p2.x ), 2 ) + Math.pow( ( point.y - this.p2.y ), 2 ) ) );
			// return the smallest distance
			return d.sort( function( a, b ) {
				return ( a - b ); //causes an array to be sorted numerically and ascending
			} )[0];
		};
	};
	
	var douglasPeucker = function( points, tolerance ) {
		if ( points.length <= 2 ) {
			return [points[0]];
		}
		var returnPoints = [],
			// make line from start to end 
			line = new Line( points[0], points[points.length - 1] ),
			// find the largest distance from intermediate poitns to this line
			maxDistance = 0,
			maxDistanceIndex = 0,
			p;
		for( var i = 1; i <= points.length - 2; i++ ) {
			var distance = line.distanceToPoint( points[ i ] );
			if( distance > maxDistance ) {
				maxDistance = distance;
				maxDistanceIndex = i;
			}
		}
		// check if the max distance is greater than our tollerance allows 
		if ( maxDistance >= tolerance ) {
			p = points[maxDistanceIndex];
			line.distanceToPoint( p, true );
			// include this point in the output 
			returnPoints = returnPoints.concat( douglasPeucker( points.slice( 0, maxDistanceIndex + 1 ), tolerance ) );
			// returnPoints.push( points[maxDistanceIndex] );
			returnPoints = returnPoints.concat( douglasPeucker( points.slice( maxDistanceIndex, points.length ), tolerance ) );
		} else {
			// ditching this point
			p = points[maxDistanceIndex];
			line.distanceToPoint( p, true );
			returnPoints = [points[0]];
		}
		return returnPoints;
	};
	var arr = douglasPeucker( points, tolerance );
	// always have to push the very last point on so it doesn't get left off
	arr.push( points[points.length - 1 ] );
	return arr;
};