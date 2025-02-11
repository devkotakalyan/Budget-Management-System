document.addEventListener("DOMContentLoaded", function () {
    document.querySelector("form").addEventListener("submit", function (e) {
        let fullname = document.getElementById("fullname").value.trim();
        let email = document.getElementById("email").value.trim();
        let password = document.getElementById("password").value.trim();
        let confirmPassword = document.getElementById("confirm-password").value.trim();
        let profileImage = document.getElementById("profile_image").value;

        e.preventDefault();

        // Name validation
        if (fullname === "") {
            alert("Full Name is required.");
            e.preventDefault();
            return;
        }

        // Email validation
        let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(email)) {
            inv_arg("Enter a valid email address.");
            return;
        }

        // Password validation
        if (password.length < 8) {
            inv_arg("Password must be at least 8 characters long.");
            return;
        }

        // Confirm Password validation
        if (password !== confirmPassword) {
            inv_arg("Passwords do not match.");
            return;
        }

        // Profile Image validation (Optional)
        let allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
        if (profileImage && !allowedExtensions.test(profileImage)) {
            inv_arg("Only image files (JPG, JPEG, PNG, GIF) are allowed.");
            return;
        }

        e.target.submit();

        function inv_arg(message) {
            let alert = document.getElementsByClassName('alert')[0];
            let msg = document.getElementById('error');
            
            alert.style.display = 'block';
            msg.innerHTML = message;
        }
    });
});
