<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Calculator</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            padding-top: 50px;
            background-color: #f4f4f9;
        }
        .container {
            width: 600px;
            background: #fff;
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .input-group {
            margin-bottom: 15px;
        }
        .input-group label {
            display: block;
            font-size: 1.2em;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .input-group input {
            width: 100%;
            padding: 10px;
            font-size: 1em;
            border: 1px solid #333;
            box-sizing: border-box; 
            border-radius: 4px;
        }
        
        /* Grid Layout for Buttons */
        .grid-buttons {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr; /* 3 columns */
            gap: 15px;
            margin-top: 30px;
        }

        .card-btn {
            background: white;
            border: 2px solid #000;
            padding: 15px;
            text-align: left;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            flex-direction: column;
            justify-content: center;
            min-height: 90px;
        }

        .card-btn:hover {
            background-color: #f0f0f0;
            border-color: #555;
        }

        .card-btn:active {
            transform: scale(0.98);
        }

        .btn-title {
            font-size: 1.1em;
            font-weight: bold;
            margin-bottom: 5px;
            color: #000;
        }

        .btn-desc {
            font-size: 0.85em;
            color: #555;
        }

        /* Style for the result text when it replaces the description */
        .btn-result {
            font-size: 1.2em;
            color: #d32f2f; /* Red color for result */
            font-weight: bold;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="input-group">
            <label for="input1">Input 1:</label>
            <input type="number" id="input1" step="any" placeholder="Enter number...">
        </div>

        <div class="input-group">
            <label for="input2">Input 2:</label>
            <input type="number" id="input2" step="any" placeholder="Enter number...">
        </div>

        <div class="grid-buttons">
            
            <button class="card-btn" onclick="calculate('area', this)">
                <span class="btn-title">Calc Area</span>
                <span class="btn-desc">input 1 &times; input 2</span>
            </button>

            <button class="card-btn" onclick="calculate('perimeter', this)">
                <span class="btn-title">Calc Perimeter</span>
                <span class="btn-desc">(input 1 + input 2) &times; 2</span>
            </button>

            <button class="card-btn" onclick="calculate('average', this)">
                <span class="btn-title">Calc Average</span>
                <span class="btn-desc">(input 1 + input 2) / 2</span>
            </button>

            <button class="card-btn" onclick="calculate('bmi', this)">
                <span class="btn-title">Calc BMI</span>
                <span class="btn-desc">Height(m) | Weight(kg)</span>
            </button>

            <button class="card-btn" onclick="calculate('minutes', this)">
                <span class="btn-title">Calc Total Minute</span>
                <span class="btn-desc">Hour | Minute</span>
            </button>

            <button class="card-btn" onclick="calculate('max', this)">
                <span class="btn-title">Find Max Value</span>
                <span class="btn-desc">Compare Input 1 & 2</span>
            </button>

        </div>
    </div>

    <script>
        function calculate(operation, btnElement) {
            // 1. Get input values
            const val1 = document.getElementById('input1').value;
            const val2 = document.getElementById('input2').value;

            // Validate inputs
            if (val1 === '' || val2 === '') {
                alert("Please enter values for both Input 1 and Input 2.");
                return;
            }

            // 2. Prepare data for PHP
            const formData = new FormData();
            formData.append('input1', val1);
            formData.append('input2', val2);
            formData.append('operation', operation);

            // Locate the description span to update
            const descSpan = btnElement.querySelector('.btn-desc, .btn-result');
            
            // Show loading state
            descSpan.innerText = "Calculating...";
            descSpan.className = "btn-desc"; // Reset class temporarily

            // 3. Send AJAX request to calculate.php
            fetch('template/calculate.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                // 4. Update the button with the result
                descSpan.innerText = data;
                descSpan.className = "btn-result"; // Apply result style
            })
            .catch(error => {
                console.error('Error:', error);
                descSpan.innerText = "Error";
            });
        }
    </script>

</body>
</html>