document.addEventListener('DOMContentLoaded', function() {
    // Handle success/error message display
    const statusMessage = document.getElementById('statusMessage');
    const statusText = document.getElementById('statusText');
    const closeBtn = document.querySelector('.close-btn');
    if (statusMessage && statusText && closeBtn) {
        closeBtn.addEventListener('click', function() {
            statusMessage.style.display = 'none';
        });

        setTimeout(() => {
            if (statusMessage.style.display === 'block') {
                statusMessage.style.display = 'none';
            }
        }, 5000);
    }

    // Add sorting or filtering functionality if needed
    // Example: Sort by votes (implement with table sort logic)
});