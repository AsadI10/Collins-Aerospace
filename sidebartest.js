const toggleButton = document.querySelector('.sidebar-toggle');
const sidebar = document.querySelector('.sidebar');

toggleButton.addEventListener('click', function() {
  sidebar.classList.toggle('sidebar-open');
});
