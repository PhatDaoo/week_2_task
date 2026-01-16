<?php
// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Retrieve and sanitize inputs
    $input1 = isset($_POST['input1']) ? (float)$_POST['input1'] : 0;
    $input2 = isset($_POST['input2']) ? (float)$_POST['input2'] : 0;
    $operation = isset($_POST['operation']) ? $_POST['operation'] : '';

    $result = "";

    // Perform calculation based on operation type
    switch ($operation) {
        case 'area':
            // Area = Width * Length
            $result = $input1 * $input2;
            break;

        case 'perimeter':
            // Perimeter = (Width + Length) * 2
            $result = ($input1 + $input2) * 2;
            break;

        case 'average':
            // Average = (Value1 + Value2) / 2
            $result = ($input1 + $input2) / 2;
            break;

        case 'bmi':
            // BMI = Weight (kg) / (Height (m) * Height (m))
            // Assumption: Input 1 is Height (m), Input 2 is Weight (kg)
            if ($input1 > 0) {
                $bmi = $input2 / ($input1 * $input1);
                $result = round($bmi, 2); // Round to 2 decimal places
            } else {
                $result = "Invalid Height";
            }
            break;

        case 'minutes':
            // Total Minutes = (Hours * 60) + Minutes
            // Assumption: Input 1 is Hour, Input 2 is Minute
            $result = ($input1 * 60) + $input2;
            break;

        case 'max':
            // Find the maximum value
            $result = ($input1 > $input2) ? $input1 : $input2;
            break;

        default:
            $result = "Unknown Op";
            break;
    }

    // Return the result as plain text
    echo $result;
}
?>