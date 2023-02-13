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

        console.log(data);

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
            }).addTo(markers).bindPopup(id).on('click', onClick_Marker);
        }

        map.on('contextmenu', oncontextmenu);
        map.on('click', onMapClick);

        function onMapClick(e) {
            userpoints.push(e.latlng);
            L.marker(e.latlng).addTo(map);
        }

        function oncontextmenu(e) {
            var polygon;
            var body;
            polygon = L.polygon(userpoints).addTo(map);
            markers.getLayers().forEach(element => {
                if (polygon.contains(element._latlng)) {
                    body = body + "<br>" + element.options.title;
                }
            });
            //displays all the products within the polygon onto the panel
            document.getElementById('panel1').innerHTML = body;
            userpoints = [];
        }


        //when a marker is clicked all of its metadata is returned
        function onClick_Marker(e) {
            var gj = e.sourceTarget.options.GeoJSON;
            var body = "ID: " + gj.product.result.identifier + "<br>NAME: " + gj.product.result.title + "<br><br>COORDINATES: " + gj.product.result.centre;
            document.getElementById('panel1').innerHTML = body;
        }

    });