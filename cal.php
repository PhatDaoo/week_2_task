<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu
    $input1 = isset($_POST['input1']) ? (float)$_POST['input1'] : 0;
    $input2 = isset($_POST['input2']) ? (float)$_POST['input2'] : 0;
    $op = isset($_POST['operation']) ? $_POST['operation'] : '';

    $result = "";

    switch ($op) {
        case 'area': // Diện tích
            $result = $input1 * $input2;
            break;
        case 'perimeter': // Chu vi
            $result = ($input1 + $input2) * 2;
            break;
        case 'average': // Trung bình cộng
            $result = ($input1 + $input2) / 2;
            break;
        case 'bmi': // BMI (Giả sử Input 1: mét, Input 2: kg)
            if ($input1 != 0) {
                $bmi = $input2 / ($input1 * $input1);
                $result = round($bmi, 2);
            } else {
                $result = "Lỗi chiều cao";
            }
            break;
        case 'minutes': // Tổng phút (Giờ * 60 + Phút)
            $result = ($input1 * 60) + $input2;
            break;
        case 'max': // Tìm Max
            $result = ($input1 > $input2) ? $input1 : $input2;
            break;
        default:
            $result = "Error";
    }

    // Trả về kết quả để bên HTML nhận
    echo $result;
}
?>