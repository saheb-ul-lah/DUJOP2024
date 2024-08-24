document.addEventListener('DOMContentLoaded', function () {
    const volumeButtonsContainer = document.getElementById('volume-buttons');

    // Fetch volumes dynamically
    fetch('fetch_volumes.php')
        .then(response => response.json())
        .then(volumes => {
            console.log(`Here are the volumes:`, volumes);
            volumes.forEach(volume => {
                if (volume.status==="active"){
                    const button = document.createElement('button');
                    button.classList.add('neumorphic', 'volume-button');
                    button.innerHTML = `
                        <i class="fa-solid fa-book"></i>
                        <span>${volume.journal_name}</span>
                    `;
                    button.addEventListener('click', () => {
                        window.location.href = `pdfviewer.html?pdf=${encodeURIComponent(volume.pdf)}`;
                    });
                    volumeButtonsContainer.appendChild(button);
                }
            });
        })
        .catch(error => console.error('Error fetching volumes:', error));
});