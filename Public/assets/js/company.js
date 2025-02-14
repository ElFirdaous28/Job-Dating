

function loadCompanies(url,searchValue) {
    $.ajax({
        url: url,
        method: "GET",
        data: {
            search: searchValue,
        },
        dataType: "json",
        success: function (response) {
            console.log("API Response:", response); // Debugging

            if (!response || typeof response !== "object") {
                console.error("Invalid response format:", response);
                return;
            }

            let companies = response.companies;
            let userRole = response.role;

            if (!Array.isArray(companies)) {
                console.error("Expected an array but got:", companies);
                return;
            }

            let companyDiv = $("#companies-div");
            companyDiv.html(""); // Clear before adding new content

            companies.forEach(company => {
                let buttons = "";
                if (userRole === "admin") {
                    buttons = `
                        <div class="flex mt-4 space-x-2">
                            <button class="edit-btn px-4 py-2 bg-yellow-500 text-white rounded-lg" id="openModalBtn" data-id="${company.id}" >Edit</button>
                            <button class="delete-btn px-4 py-2 bg-red-500 text-white rounded-lg" data-id="${company.id}">Delete</button>
                        </div>`;
                }

                let companyHTML = `
                    <div class="bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow-lg transition-transform duration-300 hover:scale-105">
                        <div class="relative h-48 overflow-hidden">
                            <div class="absolute top-4 left-4 z-10">
                                <span class="px-4 py-2 bg-blue-500 text-white rounded-full text-sm font-medium">
                                    ${company.company_name}
                                </span>
                            </div>
                            <img src="${company.image_path}" alt="${company.company_name}" class="w-full h-full object-cover" />
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-bold mb-4 text-gray-900 dark:text-white">
                                ${company.description}
                            </h3>
                            <div class="flex items-center text-sm text-gray-500 dark:text-gray-400">
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <span>${new Date(company.created_at).toLocaleDateString()}</span>
                                </div>
                            </div>
                            ${buttons} <!-- Buttons added dynamically -->
                        </div>
                    </div>
                `;

                companyDiv.append(companyHTML);
            });
        },
        error: function (error) {
            console.error("Erreur lors du chargement des companies :", error);
        }
    });
}
loadCompanies("/getCompany");
// Delete company handler
$(document).on("click", ".delete-btn", function () {
    let companyId = $(this).data("id");
    if (confirm("Are you sure you want to delete this company?")) {
        deleteCompany(companyId);
    }
});

function deleteCompany(id) {
    $.ajax({
        url: `/deleteCompany/${id}`,
        method: "DELETE",
        success: function () {
            loadCompanies();
        },
        error: function (error) {
            console.error("Error deleting company:", error);
        }
    });
}

// Search functionality
let searchValue = $("#search_text");
searchValue.on("keyup", function () {
    
    loadCompanies('/getSearchedCompanies', searchValue.val());
});