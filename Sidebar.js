// Loads details to the section to the side of the pie chart.
function loadSideBarGeneral(productContent) {
    document.getElementById("generalData-Label").hidden = false;
    document.getElementById("generalData-Products").innerHTML = productContent.length + "  /  " + markers.getLayers().length
    + "<BR> Covered (km^2): <BR>" + productContent.reduce((a, b) => a + b, 0);
}

function loadSideBarProduct(product) {
    data = product.options.GeoJSON;
    var div = document.createElement("div");
    div.id = data.Identifier;

    GetWebPage("SideBar_ProductDetails.php", function (text) {
        div.innerHTML = text;
    }, "identifier=" + data.Identifier);

    document.getElementById('panel-info').appendChild(div);
}

function clearProducts(){
    var products = document.getElementById('panel-info');
    console.log(products);
    if(products.children.length > 0){
        while (products.hasChildNodes()) {
            products.removeChild(products.lastChild)
        }
    }
}