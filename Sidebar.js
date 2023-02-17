function loadSideBarGeneral(productContent){
    document.getElementById("generalData-Label").hidden = false;
    document.getElementById("generalData-Products").innerHTML = productContent + "  /  121";
}

function loadSideBarProduct(product){
    data = product.options.GeoJSON;
    console.log(data);
    //create new HTML elements
    var div = document.createElement("div");
    var title = document.createElement("h1");
    var redirect = document.createElement("a");
    //set HTML fields for title
    title.id = "phpheader";
    title.innerHTML = data.Identifier;

    redirect.innerHTML = "Details";
    redirect.setAttribute('href', 'Product_view.php/?identifier=' + data.Identifier);
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
    document.getElementById('panel-info').appendChild(div);
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
    /*
    var div = document.getElementById("divsidepanal");
    var title = document.getElementById("phpheader");

    console.log(div);
    if(div != null){
        div.remove();
        title.remove();
    }
    */
}
