// const toggleButton = document.querySelector('.sidebar-toggle');
// const sidebar = document.querySelector('.sidebar');

// toggleButton.addEventListener('click', function() {
//   sidebar.classList.toggle('sidebar-open');
// });

function myFunction(){
  console.log("balls");
  var x = document.getElementsByClassName("sidebar-toggle");
  if (x.style.display === "none"){
    x.style.display = "block";
  }
  else {
    x.style.display = "none";
  }
}
<button onclick="myFunction()"></button>

