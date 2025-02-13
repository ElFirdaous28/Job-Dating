{% extends 'templates/studentTemplate.html' %}

{% block title %}User home{% endblock %}

{% block content %}
<div class="flex flex-col">
      <!-- barre de recherche -->
    <div class="container mx-auto mt-8 px-4">
        <h2 class="text-2xl font-semibold text-gray-700 mb-4">Rechercher des entreprises</h2>

        <div class="relative w-full max-w-lg">
            <input type="text" id="search_text"
                class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="Rechercher une entreprise ou une annonce...">

                <div id="result" class="absolute w-full mt-2 bg-white border border-gray-200 rounded-lg shadow-lg z-10 hidden">

                </div>

        </div>
    </div>
    <!-- ---------------------------------------------------------- -->


    <div class="container mx-auto">
        <div id="announcement-div" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- announcement will appear here -->
        </div>
    </div>
</div>

<script src="/assets/js/announcement.js"></script>

{% endblock %}