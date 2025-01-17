document.getElementById('budgetForm').addEventListener('submit', function (event) {
    event.preventDefault();

    const totalBudget = parseFloat(document.getElementById('totalBudget').value);
    const rent = parseFloat(document.getElementById('rent').value) || 0;
    const groceries = parseFloat(document.getElementById('groceries').value) || 0;
    const utilities = parseFloat(document.getElementById('utilities').value) || 0;
    const entertainment = parseFloat(document.getElementById('entertainment').value) || 0;
    const savings = parseFloat(document.getElementById('savings').value) || 0;

    const totalAllocated = rent + groceries + utilities + entertainment + savings;

    if (totalAllocated > totalBudget) {
        alert('Error: Allocated amount exceeds total budget!');
    } else {
        alert('Budget allocated successfully!');
        // Submit form or save to backend here
        this.submit(); // Uncomment if using a backend
    }
});
