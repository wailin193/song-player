</div>
        </div>
    </div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
    var delayTime = 3000;
    
    setTimeout(function() {
        var alerts = document.querySelectorAll('.alert');
        alerts.forEach(function(alert) {
            alert.style.display = 'none';
        });
    }, delayTime);
    });
    function setDarkMode(isDarkMode) {
        document.body.classList.toggle('dark-mode', isDarkMode);
        document.getElementById('sidebar').classList.toggle('dark-mode', isDarkMode);
        document.querySelector('.list-group').classList.toggle('dark-mode', isDarkMode);
        document.getElementById('darkModeSwitch').checked = isDarkMode;
        document.getElementById('darkModeIcon').classList.toggle('fa-sun', !isDarkMode);
        document.getElementById('darkModeIcon').classList.toggle('fa-moon', isDarkMode);
    }

    function darkmode() {
        isDarkMode = !isDarkMode;
        localStorage.setItem('darkMode', isDarkMode);
        setDarkMode(isDarkMode);
    }

    function toggle() {
        var sidebar = document.getElementById('sidebar');
        var content = document.getElementById('content');
        sidebar.classList.toggle('onoff');
        content.classList.toggle('shifted');
    }

    function search(event) {
        event.preventDefault();
        const query = document.getElementById('searchInput').value;
        alert('Search query: ' + query);
        // You can replace the alert with actual search functionality, like redirecting to a search results page
        // window.location.href = `search.html?q=${query}`;
    }

    var isDarkMode = JSON.parse(localStorage.getItem('darkMode')) || false;
    setDarkMode(isDarkMode);
</script>
<script src="../js/all.min.js"></script>
<script src="../js/bootstrap.bundle.min.js"></script>
</body>
</html>