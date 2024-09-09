document.querySelectorAll('.nav-link').forEach(link => {
    link.addEventListener('click', function() {
        
        document.querySelectorAll('.section').forEach(section => section.style.display = 'none');
        
        document.getElementById(this.getAttribute('data-section')).style.display = 'block';
    });
});


document.getElementById('searchInput').addEventListener('input', function() {
    var input = this.value.toLowerCase();
    var productContainers = document.querySelectorAll('.productContainer');

    productContainers.forEach(function(container) {
        var productName = container.querySelector('.productName').innerText.toLowerCase();
        if (productName.includes(input)) {
            container.style.display = 'block';
        } else {
            container.style.display = 'none';
        }
    });
});


const body = document.querySelector("body"),
      modeToggle = body.querySelector(".mode-toggle"),
      sidebar = body.querySelector("nav"),
      sidebarToggle = body.querySelector(".sidebar-toggle");

let getMode = localStorage.getItem("mode");
if (getMode && getMode === "dark") {
    body.classList.toggle("dark");
}

let getStatus = localStorage.getItem("status");
if (getStatus && getStatus === "close") {
    sidebar.classList.toggle("close");
}

modeToggle.addEventListener("click", () => {
    body.classList.toggle("dark");
    if (body.classList.contains("dark")) {
        localStorage.setItem("mode", "dark");
    } else {
        localStorage.setItem("mode", "light");
    }
});

sidebarToggle.addEventListener("click", () => {
    sidebar.classList.toggle("close");
    if (sidebar.classList.contains("close")) {
        localStorage.setItem("status", "close");
    } else {
        localStorage.setItem("status", "open");
    }
});