document.addEventListener("DOMContentLoaded", function() {
    const form = document.querySelector("#annonce-add");

    form.addEventListener("submit", function(e) {
        e.preventDefault(); // Prevent page reload

        // Get form data and convert it to query parameters
        const formData = new FormData(form);
        const queryString = new URLSearchParams(formData).toString();
        // console.log(formData);
        // console.log(queryString);
        // Send AJAX GET request
        fetch(`/admin/announcements/add?${queryString}`, { // Data is sent in URL
            method: 'GET'
        })
        .then(response => response.json()) // Expect JSON response
        .then(data => {
            console.log('Server Response:', data);
            alert("Announcement saved successfully!");
            form.reset();
        })
        .catch(error => console.error('Error:', error));
    });
});
