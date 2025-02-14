document.addEventListener("DOMContentLoaded", function() {
    const form = document.querySelector("#annonce-add");

    form.addEventListener("submit", function(e) {
        e.preventDefault(); // Prevent page reload

        // Create FormData object and append all form fields
        const formData = new FormData(form);

        fetch(`/admin/announcements/add`, {
            method: 'POST',
            body: formData // Send FormData
        })
        .then(response => response.json()) // Expect JSON response
        .then(data => {
            console.log('Server Response:', data);
            if (data.success) {
                alert("✅ Announcement saved successfully!");
                form.reset();

                const modalElement = document.getElementById('crud-modal');
                const modal = new Modal(modalElement);

                modal.hide();
                loadAnnouncements('/getAnnouncements');
            } else {
                alert("❌ " + data.message);
            }
        })
        .catch(error => console.error('Error:', error));
    });
});
