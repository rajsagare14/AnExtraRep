document.getElementById("userForm").addEventListener("submit", function(event) {
    event.preventDefault(); // Prevent form submission
  
    var form = event.target;
    var formData = new FormData(form);
  
    // Send form data to PHP script
    fetch("insert_user.php", {
      method: "POST",
      body: formData
    })
    .then(function(response) {
      return response.text();
    })
    .then(function(data) {
      alert(data); // Display response from the server
      form.reset(); // Reset the form
    })
    .catch(function(error) {
      console.error(error);
    });
  });
  document.getElementById("fetchButton").addEventListener("click", function() {
    var fetchEmail = document.getElementById("fetchEmail").value;
  
    // Send email to PHP script to fetch health report
    fetch("fetch_health_report.php?email=" + fetchEmail)
      .then(function(response) {
        if (response.ok) {
          return response.blob();
        } else {
          throw new Error("Failed to fetch health report");
        }
      })
      .then(function(data) {
        // Create a download link for the fetched health report
        var downloadLink = document.createElement("a");
        downloadLink.href = URL.createObjectURL(data);
        downloadLink.download = "health_report.pdf";
        downloadLink.click();
      })
      .catch(function(error) {
        console.error(error);
      });
  });  