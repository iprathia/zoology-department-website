const sidebar = document.getElementById("sidebar");
const toggleBtn = document.getElementById("sidebarToggle");

if (toggleBtn) {
  toggleBtn.addEventListener("click", () => {
    sidebar.classList.toggle("active");
  });
}
