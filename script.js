document.getElementById("openPopup").addEventListener("click", function() {
    document.getElementById("postPopup").style.display = "block";
});

document.getElementById("closePopup").addEventListener("click", function() {
    document.getElementById("postPopup").style.display = "none";
});

document.getElementById("postForm").addEventListener("submit", function(event) {
    event.preventDefault();
    
    // Process the form data here, e.g., send it to a server or handle it as needed.
    
    // Close the popup after processing the form data
    document.getElementById("postPopup").style.display = "none";
});
