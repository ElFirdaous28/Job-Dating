document.addEventListener("DOMContentLoaded", function() {
    const form = document.querySelector("#annonce-add");

    form.addEventListener("submit", function(e) {
        e.preventDefault(); // Prevent page reload

        // Create FormData object and append all form fields
        const formData = new FormData(form);

        fetch(`/admin/announcements/add`, { // Use POST instead of GET
            method: 'POST',
            body: formData // Send FormData
        })
        .then(response => response.json()) // Expect JSON response
        .then(data => {
            console.log('Server Response:', data);
            if (data.success) {
                alert("✅ Announcement saved successfully!");
                form.reset();
            } else {
                alert("❌ " + data.message);
            }
        })
        .catch(error => console.error('Error:', error));
    });
});
