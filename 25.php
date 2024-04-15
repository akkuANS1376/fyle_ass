<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Tax Calculator</title>
<style>
    .error-icon {
        display: none;
        color: red;
        margin-left: 5px;
        cursor: pointer;
    }
    .div1{
            position: absolute;
            top:0%;
            left: 30%;
            right: 30%;
            bottom: 10%;
            background-color: whitesmoke;
            border: 2px solid black;
        }
        .form-control{
            width: 50%;
        }
        .container.mt-3 {
            margin-left: 25%;
            padding-top: 10%;
        }

</style>
</head>
<body>


<form id="taxCalculatorForm">
<div class="div1">
        
<div class="container mt-3">  
    
    <div class="mb-3 mt-3"">
    <label for="income">Income (in Lakhs):</label><br>
    <input type="text" id="income" class="form-control"  onkeypress="return   restrictAlphabets(event)"   onfocus="showErrorMessage()">
    <span class="error-icon" id="incomeError" title="Please enter a valid income">*</span>
    </div>

    <br><br>
    
    
    <div class="mb-3">
    <label for="income">Extra (in Lakhs):</label><br>
    <input type="number" id="extra-income" class="form-control">
    <span class="error-icon" id="extraincomeError" title="Please enter a valid income">*</span>
    </div>
    
    <br><br>

    <div class="mb-3">   
    <label for="age">Age:</label><br>
    <input type="number" id="age" class="form-control">
    <span class="error-icon" id="ageError" title="Age is mandatory">*</span>
    </div>

    <br><br>

    
    
    
    <div class="mb-3"><br>
    <label for="deductions">Deductions (in Lakhs):</label><br>
    <input type="number" id="deductions" class="form-control">
    <span class="error-icon" id="deductionsError" title="Please enter a valid deductions">*</span>
    </div>
    <br><br>

    <button style="width: 250px;" type="button" onclick="calculateTax()">Submit</button>
</div>
</div>
</form>

<div id="resultModal" style="display: none;">
    <h2>Tax Calculation Result</h2>
    <p id="result"></p>
    <button onclick="closeModal()">Close</button>
</div>

<script>

function restrictAlphabets(e){
	          var x = e.which || e.keycode;
	            if((x >=48 && x <=57))
		            return true;
	            else
		        return false;	
	        }


    function showError(elementId, errorMessage) {
        const errorIcon = document.getElementById(`${elementId}Error`);
        errorIcon.style.display = 'inline';
        errorIcon.setAttribute('title', errorMessage);
    }

    function hideError(elementId) {
        const errorIcon = document.getElementById(`${elementId}Error`);
        errorIcon.style.display = 'none';
    }

    function calculateTax() {
        const age = document.getElementById('age').value;
        const income = parseFloat(document.getElementById('income').value);
        const deductions = parseFloat(document.getElementById('deductions').value);
        const extraincome = parseFloat(document.getElementById('extra-income').value);

        // Validate inputs
        let isError = false;
        if (!age) {
            showError('age', 'Age is mandatory');
            isError = true;
        } else {
            hideError('age');
        }
        if (isNaN(income) || income < 0) {
            showError('income', 'Please enter a valid income');
            isError = true;
        } else {
            hideError('income');
        }
        
        if (isNaN(deductions) || deductions < 0) {
            showError('deductions', 'Please enter a valid deductions');
            isError = true;
        } else {
            hideError('deductions');
        }

        if (isError) {
            return;
        }

        
        let tax = 0;
        const incomeAfterDeductions = income + extraincome - deductions;
        if (incomeAfterDeductions > 8) {
            if (age < 40) {
                tax = 0.3 * (incomeAfterDeductions - 8);
            } else if (age >= 40 && age < 60) {
                tax = 0.4 * (incomeAfterDeductions - 8);
            } else if (age >= 60) {
                tax = 0.1 * (incomeAfterDeductions - 8);
            }
        }

        
        localStorage.setItem('age', age);
        localStorage.setItem('income', income);
        localStorage.setItem('deductions', deductions);
        localStorage.setItem('extraincome', extraincome);

        
        window.location.href = "30.php";
    }

    function closeModal() {
        document.getElementById('resultModal').style.display = 'none';
    }
</script>

</body>
</html>
