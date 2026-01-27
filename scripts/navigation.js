document.addEventListener('DOMContentLoaded', () => {
    // Initialize Lucide icons
    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }

    // Profile Dropdown Logic
    const profileBtn = document.getElementById('profileDropdownBtn');
    const dropdownContent = document.getElementById('myDropdown');

    if (profileBtn && dropdownContent) {
        profileBtn.addEventListener('click', (event) => {
            event.stopPropagation();
            dropdownContent.classList.toggle('show');
        });

        // Close dropdown when clicking outside
        window.addEventListener('click', (event) => {
            if (!profileBtn.contains(event.target)) {
                if (dropdownContent.classList.contains('show')) {
                    dropdownContent.classList.remove('show');
                }
            }
        });
    }
});
