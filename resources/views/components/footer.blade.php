
<!-- Toast Container -->
<div id="toastContainer" class="fixed top-10 right-0 mb-4 mr-4"></div>

<!-- Footer -->
<footer class="bg-gray-800 text-white py-4 mt-auto">
    <div class="container flex flex-col sm:items-center justify-center items-center mx-auto text-center">
        <p>&copy; 2024 TECHQUORUM. All rights reserved.</p>
        <div class="">
            <a href="#" class="text-gray-400 hover:text-white mx-2">Privacy Policy</a>
            <a href="#" class="text-gray-400 hover:text-white mx-2">Terms of Service</a>
        </div>
    </div>
</footer>
</div>

<script>
    // Function to toggle sidebar visibility on smaller screens
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const toggleIcon = document.getElementById('toggleSidebarIcon');
        sidebar.classList.toggle('-translate-x-full');
        // toggleIcon.classList.toggle('fa-arrow-left');
        // toggleIcon.classList.toggle('fa-arrow-right');
    }

    // Function to toggle the profile dropdown menu visibility
    function toggleDropdown() {
        const dropdownMenu = document.getElementById('dropdownMenu');
        dropdownMenu.classList.toggle('hidden');
    }

    // Function to toggle the notification dropdown visibility
    function toggleNotifications() {
        const notificationDropdown = document.getElementById('notificationDropdown');
        notificationDropdown.classList.toggle('hidden');
    }

    // Close dropdowns when clicking outside
    window.addEventListener('click', function (e) {
        const dropdownButton = document.getElementById('dropdownButton');
        const dropdownMenu = document.getElementById('dropdownMenu');
        const notificationButton = document.getElementById('notificationButton');
        const notificationDropdown = document.getElementById('notificationDropdown');
       

        if (!dropdownButton.contains(e.target) && !dropdownMenu.contains(e.target)) {
            dropdownMenu.classList.add('hidden');
        }

        if (!notificationButton.contains(e.target) && !notificationDropdown.contains(e.target)) {
            notificationDropdown.classList.add('hidden');
        }
    });
</script>



<script>
    document.addEventListener('DOMContentLoaded', function () {
        const showMoreButtons = document.querySelectorAll('.show-more');

        showMoreButtons.forEach(button => {
            button.addEventListener('click', function () {
                const fullDescription = this.getAttribute('data-full-description');
                const descriptionParagraph = this.previousElementSibling;
                const isShowingMore = this.textContent === 'Show Less';

                if (isShowingMore) {
                    // Show truncated text
                    descriptionParagraph.textContent = fullDescription.length > 90 ?
                        fullDescription.slice(0, 90) + '...' : fullDescription;
                    this.textContent = 'Show More';
                } else {
                    // Show full text
                    descriptionParagraph.textContent = fullDescription;
                    this.textContent = 'Show Less';
                }
            });
        });
    });
</script>

</body>

</html>
