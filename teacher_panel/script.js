
const sideMenu = document.querySelector("aside");
const profileBtn = document.querySelector("#profile-btn");
const themeToggler = document.querySelector(".theme-toggler");

// Handle Mobile Profile Sidebar Toggle
if (profileBtn) {
    profileBtn.onclick = function () {
        sideMenu.classList.toggle('active');
    }
}

// Handle Header Scroll Effect
window.onscroll = () => {
    if (sideMenu) sideMenu.classList.remove('active');
    if (window.scrollY > 0) {
        document.querySelector('header').classList.add('active');
    } else {
        document.querySelector('header').classList.remove('active');
    }
}

// Handle Theme Toggling with Persistence
if (themeToggler) {
    themeToggler.onclick = function () {
        document.body.classList.toggle('dark'); // Teacher panel uses 'dark' class
        themeToggler.querySelector('span:nth-child(1)').classList.toggle('active');
        themeToggler.querySelector('span:nth-child(2)').classList.toggle('active');

        const isDark = document.body.classList.contains('dark');
        const theme = isDark ? 'dark' : 'light';

        // Update Theme in Database
        fetch('../assets/themeSet.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'theme=' + encodeURIComponent(theme),
        })
        .catch(error => console.error('Error updating theme:', error));
    }
}

// Search Function (Main Header)
function searchFunction() {
    const searchInput = document.getElementById("topMostSearchBar");
    if (!searchInput) return;

    const searchValue = searchInput.value.toLowerCase().trim();

    fetch("searchFunction.php", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'searchValue=' + encodeURIComponent(searchValue),
    })
    .then(response => response.text())
    .then(data => {
        const result = data.trim();
        if (result === "NOTFOUND") {
            searchInput.classList.add("redColorText");
        } else {
            window.location.href = result;
        }
    })
    .catch(error => console.error('Error in search:', error));
}

// Handle Enter Key in Search
const searchInput = document.getElementById("topMostSearchBar");
if (searchInput) {
    searchInput.addEventListener("keydown", (event) => {
        if (event.key === 'Enter') {
            searchFunction();
        }
        searchInput.classList.remove("redColorText");
    });
}

const searchBtn = document.getElementById("topMostSearchBarBtn");
if (searchBtn) {
    searchBtn.addEventListener('click', () => {
        searchFunction();
    });
}
