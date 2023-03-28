function loadSideBarGeneral(productContent){
    //console.log(productContent);
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
    return;

    //create new HTML elements
    var title = document.createElement("h1");
    var redirect = document.createElement("a");
    //set HTML fields for title
    title.id = "phpheader";
    title.innerHTML = data.Identifier;

    redirect.innerHTML = "Details";
    redirect.setAttribute('href', 'Product_view.php/?identifier=' + data.Identifier);
    redirect.target = "_blank";
    //set HTML fields for the div
    div.id = "divsidepanal";
    div.innerHTML = "Product : " + product.options.index + " / 121"
    + " <BR> Product Name: " + data.Name
    + " <BR> Date Created: " + data.DateCreated
    + " <BR> Date Modified: " + data.DateModified
    + " <BR> Creator: " + data.Creator
    + "<BR>";
    //Add the div to the panel
    document.getElementById('panel-info').appendChild(title);
    document.getElementById('panel-info').appendChild(redirect);
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