document.addEventListener('DOMContentLoaded', function () {
    document.addEventListener('submit', function (e) {
        e.preventDefault();

        let B_name = document.getElementById("Budgetname").value.trim();
        let total_amt = document.getElementById("totalBudget").value.trim();
        let rnd = document.getElementById("R&D").value.trim();
        let machinery = document.getElementById("Machinery").value.trim();
        let utilities = document.getElementById("utilities").value.trim();
        let marketing = document.getElementById("Marketing").value.trim();
        let rem = document.getElementById("rem_amt");

        // Convert budget values to numbers
        let totalBudget = Number(total_amt);
        let rndBudget = Number(rnd);
        let machineryBudget = Number(machinery);
        let utilitiesBudget = Number(utilities);
        let marketingBudget = Number(marketing);

        if (B_name === "") {
            inv_alloc("Enter a valid Name");
            return;
        }

        if (total_amt === "" || isNaN(totalBudget) || totalBudget <= 0) {
            inv_alloc("Enter a valid Budget Amount");
            return;
        }

        // Validate allocation inputs (ensure they are numbers and not negative)
        if (isNaN(rndBudget) || rndBudget < 0 || 
            isNaN(machineryBudget) || machineryBudget < 0 || 
            isNaN(utilitiesBudget) || utilitiesBudget < 0 || 
            isNaN(marketingBudget) || marketingBudget < 0) {
            inv_alloc("All budget allocations must be valid non-negative numbers.");
            return;
        }

        // Ensure the sum of allocations does not exceed total budget
        let totalAllocated = rndBudget + machineryBudget + utilitiesBudget + marketingBudget;
        if (totalAllocated > totalBudget) {
            inv_alloc(`Total allocated amount (${totalAllocated}) exceeds the total budget (${totalBudget}).`);
            rem.value = total_amt - totalAllocated
            return;
        }

        if(totalAllocated < total_amt){
            rem.value = total_amt - totalAllocated
        }else{
            rem.value = 0;
        }

        e.target.submit(); // Submit the form if all validations pass
    });
});

// Function to display error messages
function inv_alloc(message) {
    let alert = document.getElementsByClassName('alert')[0];
    let msg = document.getElementById('error');

    alert.style.display = 'block';
    msg.innerHTML = message;
}
