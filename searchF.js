// Function to load the content of a page
function loadPageContent(pageUrl) {
    return fetch(pageUrl)
        .then(response => response.text())
        .then(data => data);
}

// Function to toggle the visibility of the search bar
function toggleSearch() {
    const searchForm = document.getElementById('search-form');
    
    // Toggle the display of the search bar
    if (searchForm.style.display === "none" || searchForm.style.display === "") {
        searchForm.style.display = "flex"; // Make it visible
        searchForm.style.opacity = 1;
    } else {
        searchForm.style.display = "none"; // Hide the search bar
    }
}

// Perform the search when the user submits the query
function performSearch() {
    const query = document.getElementById('search-query').value.toLowerCase().trim();
    // Updated to Apache-compatible paths, including correct extensions
    const pages = [
        '/quick-pc1/news/news.php', 
        '/quick-pc1/guides/guides.php', 
        '/quick-pc1/guide-3.php' ,
        '/quick-pc1/reviews/reviews.php'
    ]; 
    let resultsFound = false;

    // If the query is empty, don't perform a search
    if (query === "") {
        alert("Please enter a search term.");
        return;
    }

    // Hide the search bar after search is performed
    const searchForm = document.getElementById('search-form');
    searchForm.style.display = "none";  // Hide the search bar after search is performed

    Promise.all(pages.map(page => loadPageContent(page)))
        .then(pagesContent => {
            pagesContent.forEach((pageContent, index) => {
                // Check if the content of the page includes the search query (case-insensitive)
                if (pageContent.toLowerCase().includes(query)) {
                    resultsFound = true;
                    // Redirect the user to the page that contains the result
                    window.location.href = pages[index]; // Redirect to the matched page
                }
            });

            // If no results are found, alert the user
            if (!resultsFound) {
                alert('No results found for your search.');
            }
        })
        .catch(error => {
            console.error('Error loading pages:', error);
            alert('There was an error with the search. Please try again later.');
        });
}
