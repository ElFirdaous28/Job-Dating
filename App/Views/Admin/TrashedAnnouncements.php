{% extends 'templates/baseTemplate.html' %}

{% block title %}Admin Announcements{% endblock %}

{% block content %}

<!-- Modal toggle -->
<div class="felx flex-col">

    <div class="container mx-auto p-5">
        <div id="announcement-div" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- announcement will appear here -->
        </div>
    </div>

</div>

<script src="/assets/js/announcement.js"></script>

{% endblock %}