document.getElementById('contactForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent the default form submission

    // Create a FormData object from the form
    const formData = new FormData(this);

    // Use Fetch API to send the form data to the server
    fetch('send_email.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(result => {
        // Display success or error message based on response
        if (result.includes('Message sent successfully')) {
            alert('Thank you for your message. I will get back to you soon!');
            this.reset(); // Reset the form
        } else {
            alert('Failed to send the message. Please try again later.');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred. Please try again later.');
    });
});
