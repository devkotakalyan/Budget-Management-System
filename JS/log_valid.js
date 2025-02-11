console.log("THIS IS TEST");

document.addEventListener('DOMContentLoaded', function () {
    document.addEventListener('submit', function (e) {
        e.preventDefault(); 

        let user = document.getElementById("username").value.trim();
        let pass = document.getElementById("password").value.trim();

        if (user === "" || pass === "") {
            inv_pass("Please fill in all fields");
            return;
        }


        e.target.submit();
    });

    function inv_pass(message) {
        let alert = document.getElementsByClassName('alert')[0];
        let msg = document.getElementById('error');
        
        alert.style.display = 'block';
        msg.innerHTML = message;
    }
});
