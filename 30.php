<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Tax Calculation Result</title>
<style>
    .div1{
            position: absolute;
            top:0%;
            left: 30%;
            right: 30%;
            bottom: 10%;
            background-color: whitesmoke;
            border: 2px solid black;
            font-size: 50px;

        }
        h2{
            text-align: center;
            padding: 10px;
            padding-top: 30px;

        }
        #result{
            text-align: center;
            font-weight: 300;
            font-style: normal;
            color: blue;
            font-size: 30px;
            padding-top: 45px;
        }

</style>
</head>
<body>
<div class="div1">
<h2>Tax Calculation Result</h2>
<p id="result"></p>
</div>
<script>
    // Retrieve form data from localStorage
    const age = localStorage.getItem('age');
    const income = localStorage.getItem('income');
    const deductions = localStorage.getItem('deductions');
    const extraincome = localStorage.getItem('extraincome');

    // Perform tax calculation
    let tax = 0;
    const incomeAfterDeductions = parseFloat(income) + parseFloat(extraincome) - parseFloat(deductions);
    if (incomeAfterDeductions > 8) {
        if (age < 40) {
            tax = 0.3 * (incomeAfterDeductions - 8);
        } else if (age >= 40 && age < 60) {
            tax = 0.4 * (incomeAfterDeductions - 8);
        } else if (age >= 60) {
            tax = 0.1 * (incomeAfterDeductions - 8);
        }
    }

    // Display result
    const resultElement = document.getElementById('result');
    resultElement.innerText = `Tax Payable: ${tax.toFixed(2)} Lakhs`;

    // Clear localStorage after retrieving data
    localStorage.clear();
</script>

</body>
</html>
