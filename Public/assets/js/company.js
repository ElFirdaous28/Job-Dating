
    
    $.ajax({
        url: "/getCompany",
        method: "GET",
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
                            <button class="px-4 py-2 bg-yellow-500 text-white rounded-lg">Edit</button>
                            <button class="px-4 py-2 bg-red-500 text-white rounded-lg">Delete</button>
                        </div>`;
                }
    
                let companyHTML = `
                    <div class="bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow-lg transition-transform duration-300 hover:scale-105">
                        <div class="relative h-48 overflow-hidden">
                            <div class="absolute top-4 left-4 z-10">
                                <span class="px-4 py-2 bg-blue-500 text-white rounded-full text-sm font-medium">
                                    ${company.title}
                                </span>
                            </div>
                            <img src="/api/placeholder/400/300" alt="${company.title}" class="w-full h-full object-cover" />
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-bold mb-4 text-gray-900 dark:text-white">
                                ${company.description}
                            </h3>
                            <div class="flex items-center text-sm text-gray-500 dark:text-gray-400">
                                <div class="flex items-center mr-4">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    <span>${company.author || "Anonyme"}</span>
                                </div>
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <span>${new Date(company.date).toLocaleDateString()}</span>
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
            console.error("Erreur lors du chargement des annonces :", error);
        }
    });

    // // ///////////////////////////////////////////////////////////////
    // function loadCompanies(url, searchValueCompany = "", filterValueCompany = "") {
    //     $.ajax({
    //         url: url,
    //         method: "GET",
    //         data: {
    //             search: searchValueCompany,
    //             filter: filterValueCompany
    //         },
    //         dataType: "json",
    //         success: function (response) {
    //             console.log("API Response:", response); // Débogage
    
    //             if (!response || typeof response !== "object") {
    //                 console.error("Format de réponse invalide :", response);
    //                 return;
    //             }
    
    //             let companies = response.companies;
    //             let userRole = response.role;
    
    //             if (!Array.isArray(companies)) {
    //                 console.error("On attend un tableau mais on a reçu :", companies);
    //                 return;
    //             }
    //             let companyDiv = $("#companies-div");
    //             companyDiv.html(""); // Efface avant d'ajouter du contenu
    
    //             companies.forEach(company => {
    //                 let buttons = "";
    //                 if (userRole === "admin") {
    //                     buttons = `
    //                         <div class="flex mt-4 space-x-2">
    //                             <button class="px-4 py-2 bg-yellow-500 text-white rounded-lg">Editer</button>
    //                             <button class="px-4 py-2 bg-red-500 text-white rounded-lg">Supprimer</button>
    //                         </div>`;
    //                 }
    
    //                 let companyHTML = `
    //                     <div class="bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow-lg transition-transform duration-300 hover:scale-105">
    //                         <div class="relative h-48 overflow-hidden">
    //                             <div class="absolute top-4 left-4 z-10">
    //                                 <span class="px-4 py-2 bg-blue-500 text-white rounded-full text-sm font-medium">
    //                                     ${company.title}
    //                                 </span>
    //                             </div>
    //                             <img src="/api/placeholder/400/300" alt="${company.title}" class="w-full h-full object-cover" />
    //                         </div>
    //                         <div class="p-6">
    //                             <h3 class="text-xl font-bold mb-4 text-gray-900 dark:text-white">
    //                                 ${company.description}
    //                             </h3>
    //                             <div class="flex items-center text-sm text-gray-500 dark:text-gray-400">
    //                                 <div class="flex items-center mr-4">
    //                                     <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
    //                                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
    //                                     </svg>
    //                                     <span>${company.author || "Anonyme"}</span>
    //                                 </div>
    //                                 <div class="flex items-center">
    //                                     <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
    //                                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
    //                                     </svg>
    //                                     <span>${new Date(company.date).toLocaleDateString()}</span>
    //                                 </div>
    //                             </div>
    //                             ${buttons} <!-- Boutons ajoutés dynamiquement -->
    //                         </div>
    //                     </div>
    //                 `;
    
    //                 companyDiv.append(companyHTML);
    //             });
    //         },
    //         error: function (error) {
    //             console.error("Erreur lors du chargement des entreprises :", error);
    //         }
    //     });
    // }
    
    // // Chargement des entreprises
    // loadCompanies("/getCompany");
    
    // // Recherche
    // $("#search_Company").on("keyup", function () {
    //     loadCompanies("/getSearchedAnnouncements", $(this).val());
    // });
    
    // // Filtre
    // $("#filter-company").change(function () {
    //     loadCompanies("/getFilteredAnnouncements", "", $(this).val());
    // });
    