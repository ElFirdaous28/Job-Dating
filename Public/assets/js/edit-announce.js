setTimeout(()=>{
     // Get modal and buttons
     const modal = document.getElementById('modal');
     const openModalBtn = document.querySelectorAll('#openModalBtn');
     const closeModalBtn = document.getElementById('closeModalBtn');
 openModalBtn.forEach(model => {

     // Open the modal when the button is clicked
     model.addEventListener('click', () => {
        let editId = parseInt(model.getAttribute("data-an"));
        document.getElementById("anId").value = editId;
        // put data in form
        fetch(`/admin/announces/get/${editId}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                console.log(data);
                document.querySelector(".edit-title").value = data.announce.title;
                document.querySelector(".edit-desc").value = data.announce.description;
                document.querySelector(".edit-cat").value = data.announce.job_category;
                document.querySelector(".edit-comp").value = data.announce.company_id;
            } else {
                alert("❌ Error fetching announce data: " + data.message);
            }
        })
        .catch(error => console.error('Error fetching announce:', error));
        modal.classList.remove('hidden');
        // update the announcemenet
        // update announce
    const form = document.getElementById("annonce-edit");
    console.log(form);
       form.addEventListener("submit", function(e) {
           e.preventDefault(); // Prevent page reload
   
           // Create FormData object and append all form fields
           const formData = new FormData(form);
   
           fetch(`/admin/announcements/edit`, {
               method: 'POST',
               body: formData // Send FormData
           })
           .then(response => response.json()) // Expect JSON response
           .then(data => {
               console.log('Server Response:', data);
               if (data.success) {
                   alert("✅ Announcement updated successfully!");
                   form.reset();
               } else {
                   alert("❌ " + data.message);
               }
           })
           .catch(error => console.error('Error:', error));
       });
      });
  
      // Close the modal when the close button is clicked
      closeModalBtn.addEventListener('click', () => {
        modal.classList.add('hidden');
      });
  
      // Optional: Close the modal when clicking outside the modal content
      window.addEventListener('click', (e) => {
        if (e.target === modal) {
          modal.classList.add('hidden');
        }
      });
 })
    

},1000);