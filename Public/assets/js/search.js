// search.js
function search_data(search_value) {
    let announcementsUrl = '/searchAnnouncements?query=' + encodeURIComponent(search_value);
    let companiesUrl = '/searchCompanies?query=' + encodeURIComponent(search_value);

    // Recherche des annonces
    $.ajax({
        url: announcementsUrl,
        method: 'GET',
        dataType: 'json',
        success: function(response) {
            let resultDiv = $("#result");
            resultDiv.empty(); // Vide la section avant de rajouter les résultats

            if (response.success) {
                response.announcements.forEach(function(announcement) {
                    let announcementHTML = `
                        <div class="announcement-item">${announcement.title}</div>
                    `;
                    resultDiv.append(announcementHTML);
                });
            }

            resultDiv.removeClass('hidden'); // Affiche les résultats
        },
        error: function(error) {
            console.error("Erreur lors de la recherche des annonces :", error);
        }
    });

    // Recherche des entreprises
    $.ajax({
        url: companiesUrl,
        method: 'GET',
        dataType: 'json',
        success: function(response) {
            let resultDiv = $("#result");
            resultDiv.empty(); // Vide la section avant de rajouter les résultats

            if (response.success) {
                response.companies.forEach(function(company) {
                    let companyHTML = `
                        <div class="company-item">${company.company_name}</div>
                    `;
                    resultDiv.append(companyHTML);
                });
            }

            resultDiv.removeClass('hidden'); // Affiche les résultats
        },
        error: function(error) {
            console.error("Erreur lors de la recherche des entreprises :", error);
        }
    });
}
