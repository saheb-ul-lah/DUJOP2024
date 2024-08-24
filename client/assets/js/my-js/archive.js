document.addEventListener('DOMContentLoaded', function () {
    const volumeButtonsContainer = document.getElementById('volume-buttons');

    // Fetch volumes dynamically
    fetch('fetch_volumes.php')
        .then(response => response.json())
        .then(volumes => {
            console.log(`Here are the volumes:`, volumes);
            volumes.forEach(volume => {
                if (volume.status === "active") {
                    const button = document.createElement('div');
                    button.classList.add('image-wrapper');

                    // Add the image
                    button.innerHTML = `
                        <img src="https://dibru.ac.in/wp-content/uploads/2024/04/Cover-Page_CTPR_Dec-2023_page-0001-1063x1536.jpg" class="volume-image" alt="${volume.journal_name}">
                        <div class="volume-name">${volume.journal_name}</div>
                    `;

                    // Add click event
                    button.addEventListener('click', () => {
                        window.location.href = `pdfviewer.html?pdf=${encodeURIComponent(volume.pdf)}`;
                    });

                    volumeButtonsContainer.appendChild(button);
                }
            });
        })
        .catch(error => console.error('Error fetching volumes:', error));
});
