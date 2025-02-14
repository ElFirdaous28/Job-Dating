document.addEventListener("DOMContentLoaded", function() {
    const form = document.querySelector("#addCompany");

    form.addEventListener("submit", function(e) {
        e.preventDefault(); // Prevent page reload

        // Create FormData object and append all form fields
        const formData = new FormData(form);

        fetch(`/admin/companies/add_company`, { // Use POST instead of GET
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
                loadCompanies('/getCompany');
            } else {
                alert("❌ " + Object.values(data.message).join("\n"));
            }
        })
        .catch(error => console.error('Error:', error));
    });
});