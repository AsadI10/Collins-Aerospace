//ALL MAP DATA AND ASSOCIATED FUNCTIONS.
// This is a debug thing and doesn't do anything important. aiggghhhttttt
/*
fetch('Fetch_product_data.php')
    .then(function (response) {
        console.log(response.text());
});
*/
fetch('Fetch_product_data.php')
    .then(function (response) {
        // TODO: Error checking to check if response is json or not
        return response.json();
    }).then(function (data) {
        //---------------
        //---CODE BODY---
        //---------------
        //Creates a marker for each product pulled from the API
        //also applies event based functions to each marker +
        //attributes.
        
        for (let i = 0; i < data.length; i++) {
            var tmp = data[i];
            var id = tmp["Identifier"];
            var centre = tmp["Centre"];
            var latlang = centre.split(',');
            L.marker([latlang[0], latlang[1]], {
                title: id,
                GeoJSON: tmp,
            }).addTo(markers).bindPopup(id)
            .on('click', onClick_Marker)
            .on('mouseover',onMouseOver_marker);
        }

        //forget about these event functions
        //map.on('contextmenu', onContextMenu);
        //map.on('click', onMapClick);

        map.on('boxzoomend', onShiftDrag);

        function onShiftDrag(e){
            shapes.clearLayers();

            var body = "";
            var rectangle;
            var bounds = [[e.boxZoomBounds._northEast.lat, e.boxZoomBounds._northEast.lng],
            [e.boxZoomBounds._southWest.lat, e.boxZoomBounds._southWest.lng]];

            var rectangle = L.rectangle(bounds).addTo(shapes);

            //can be put into its own function
            markers.getLayers().forEach(element=>{
                if(rectangle.contains(element._latlng)){
                    body += element.options.title + "<br>";
                }
            });
            document.getElementById('panel1').innerHTML = body;
        }

        function onMouseOver_marker(e){

        }

        function onClick_Marker(e) {
            shapes.clearLayers();

            var gj = e.sourceTarget.options.GeoJSON;
            var body = "ID: " + gj.Identifier + "<br>NAME: " + gj.Name + "<br><br>COORDINATES: " + gj.Centre;
            document.getElementById('panel1').innerHTML = body;
        }

    });