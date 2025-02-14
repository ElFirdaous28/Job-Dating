function loadAnnouncements(url, searchValue = "", filterValue = "") {
    $.ajax({
        url: url,
        method: "GET",
        data: {
            search: searchValue,
            filter: filterValue
        },
        dataType: "json",
        success: function (response) {
            console.log("API Response:", response);

            if (!response || typeof response !== "object") {
                console.error("Invalid response format:", response);
                return;
            }

            let announcements = response.announcements;
            let userRole = response.role;

            if (!Array.isArray(announcements)) {
                console.error("Expected an array but got:", announcements);
                return;
            }

            let announcementDiv = $("#announcement-div");
            announcementDiv.html("");

            if (!Array.isArray(announcements) || announcements.length === 0) {
                announcementDiv.html(`
                    <div class="text-center text-gray-500 dark:text-gray-400 mt-4">
                        No announcements to show.
                    </div>
                `);
                return;
            }

            // Get current page URL
            const currentPath = window.location.pathname;

            announcements.forEach(announcement => {
                let companyName = announcement.company ? announcement.company.company_name : "Entreprise inconnue";
                let buttons = "";

                if (userRole === "admin") {
                    if (currentPath === "/admin/announcements/trashed") {
                        buttons = `
                            <div class="flex justify-between mt-4 space-x-2">
                                <button class="restore-btn px-4 py-2 bg-green-500 text-white rounded-lg" data-id="${announcement.id}">Restore</button>
                                <button class="delete-permantly-btn px-4 py-2 bg-red-500 text-white rounded-lg" data-id="${announcement.id}">Delete permanently</button>
                            </div>`;
                    } else {
                        buttons = ` 
                            <div class="flex mt-4 space-x-2">
                                <button class="edit-btn px-4 py-2 bg-yellow-500 text-white rounded-lg" data-id="${announcement.id}" id="openModalBtn" data-an="${announcement.id}">Edit</button>
                                <button class="delete-btn px-4 py-2 bg-red-500 text-white rounded-lg" data-id="${announcement.id}">Delete</button>
                            </div>`;
                    }
                }

                let announcementHTML = `
                    <div class="bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow-lg transition-transform duration-300 hover:scale-105" id="announcement-${announcement.id}">
                        <div class="relative h-48 overflow-hidden">
                            <div class="absolute top-4 left-4 z-10">
                                <span class="px-4 py-2 bg-blue-500 text-white rounded-full text-sm font-medium">
                                    ${announcement.job_category || announcement.title}
                                </span>
                            </div>
                            <img src="${announcement.image_path}" alt="${announcement.title}" class="w-full h-full object-cover" />
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-bold mb-4 text-gray-900 dark:text-white">
                                ${announcement.title}
                            </h3>
                            <div class="flex items-center text-sm text-gray-500 dark:text-gray-400">
                                <div class="flex items-center mr-4">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    <span>${companyName}</span>
                                </div>
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <span>${new Date(announcement.published_at).toLocaleDateString()}</span>
                                </div>
                            </div>
                            ${buttons}
                        </div>
                    </div>
                `;

                announcementDiv.append(announcementHTML);
            });
        },
        error: function (error) {
            console.error("Error loading announcements:", error);
        }
    });
}

// Initialize when document is ready
$(document).ready(function () {
    const currentPath = window.location.pathname;
    
    // Initial load based on current path
    if (currentPath === "/admin/announcements/trashed") {
        loadAnnouncements('/getDeletedAnnouncements');
    } else if (currentPath === "/admin/announcements") {
        loadAnnouncements('/getSearchedAnnouncements');
    } else {
        loadAnnouncements("/getAnnouncements");
    }

    // Search functionality
    let searchValue = $("#search_text");
    searchValue.on("keyup", function () {
        const searchUrl = currentPath === "/admin/announcements/trashed" 
            ? "/getSearchedTrashAnnouncements" 
            : "/getSearchedAnnouncements";
        loadAnnouncements(searchUrl, searchValue.val());
    });

    // Filter functionality
    let filterValue = $("#filter-company");
    filterValue.change(function () {
        loadAnnouncements("/getFilteredAnnouncements", "", filterValue.val());
    });
});

// Delete announcement handler
$(document).on("click", ".delete-btn", function () {
    let announcementId = $(this).data("id");
    if (confirm("Are you sure you want to delete this announcement?")) {
        deleteAnnouncement(announcementId);
    }
});

function deleteAnnouncement(id) {
    $.ajax({
        url: `/deleteAnnouncement/${id}`,
        method: "DELETE",
        success: function () {
            $(`#announcement-${id}`).remove();
        },
        error: function (error) {
            console.error("Error deleting announcement:", error);
        }
    });
}

// Delete announcement permantly handler
$(document).on("click", ".delete-permantly-btn", function () {
    let announcementId = $(this).data("id");
    if (confirm("Are you sure you want to delete this announcement permantly?")) {
        deleteAnnouncementPermantly(announcementId);
    }
});

function deleteAnnouncementPermantly(id) {    
    $.ajax({
        url: `/permanentlyDeleteAnnouncement/${id}`,
        method: "DELETE",
        success: function () {
            $(`#announcement-${id}`).remove();
        },
        error: function (error) {
            console.error("Error deleting announcement:", error);
        }
    });
}

// Restore announcement handler
$(document).on("click", ".restore-btn", function () {
    let announcementId = $(this).data("id");
    if (confirm("Are you sure you want to restore this announcement?")) {
        restoreAnnouncement(announcementId);
    }
});

function restoreAnnouncement(id) {
    $.ajax({
        url: `/restoreAnnouncement/${id}`,
        method: "POST",
        success: function () {
            $(`#announcement-${id}`).remove();
        },
        error: function (error) {
            console.error("Error restoring announcement:", error);
        }
    });
}