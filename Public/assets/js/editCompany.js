setTimeout(() => {
    const modal = document.getElementById('edit-company-modal');
    const openModalBtns = document.querySelectorAll('#openModalBtn');
    const closeModalBtn = document.getElementById('closeEditModalBtn');
    const form = document.getElementById("editCompanyForm");

    openModalBtns.forEach(button => {
        button.addEventListener('click', () => {
            let editId = parseInt(button.getAttribute("data-id"));
            document.getElementById("company_id").value = editId;

            fetch(`/admin/companies/get/${editId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById("edit_company_name").value = data.company.company_name;
                        document.getElementById("edit_email").value = data.company.email;
                        document.getElementById("edit_phone").value = data.company.phone;
                        document.getElementById("edit_website").value = data.company.website;
                        document.getElementById("edit_description").value = data.company.description;
                    } else {
                        alert("❌ Error fetching company data: " + data.message);
                    }
                })
                .catch(error => console.error('Error fetching company:', error));

            modal.classList.remove('hidden');
        });
    });


    form.addEventListener("submit", function (e) {
        e.preventDefault();

        const formData = new FormData(form);

        fetch(`/admin/companies/edit`, {
            method: 'POST',
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                console.log('Server Response:', data);
                if (data.success) {
                    alert("✅ " + data.message);
                    form.reset();

                    const modalElement = document.getElementById('edit-company-modal');
                    const modal = new Modal(modalElement);

                    modal.hide();
                    loadCompanies('/getCompany');
                } else {
                    alert("❌ " + data.message);
                }
            })
            .catch(error => console.error('Error:', error));
    });

    closeModalBtn.addEventListener('click', () => {
        modal.classList.add('hidden');
    });

    window.addEventListener('click', (e) => {
        if (e.target === modal) {
            modal.classList.add('hidden');
        }
    });

}, 1000);
