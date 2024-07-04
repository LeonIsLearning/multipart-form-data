<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['req'])) {
        $req = $_POST['req'];
    } else {
        $req = '未提供';
    }

    // 檢查並處理上傳的文件
    if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['file']['tmp_name'];
        $fileName = $_FILES['file']['name'];
        $fileSize = $_FILES['file']['size'];
        $fileType = $_FILES['file']['type'];

        // 將文件移動到目標目錄 (例如 "uploads" 目錄)
        $uploadFileDir = './uploads/';
        $dest_path = $uploadFileDir . $fileName;

        if (move_uploaded_file($fileTmpPath, $dest_path)) {
            $fileMessage = '文件成功上傳：' . $fileName;
        } else {
            $fileMessage = '文件上傳失敗';
        }
    } else {
        $fileMessage = '未上傳文件或上傳失敗';
    }

    // 回應文字參數和文件上傳結果
    $response = [
        'req' => $req,
        'file' => $fileMessage
    ];

    header('Content-Type: application/json');
    // Unicode 字符轉義：
    // json_encode 會將所有非 ASCII 的 Unicode 字符轉換為其 Unicode 序列形式(例如，中文字符 "文件" 會被轉換成 "\u6587\u4ef6")。
    // 這是為了保證 JSON 數據的兼容性，因為有些系統或網絡傳輸只支持 ASCII 字符。
    // JSON_UNESCAPED_UNICODE => PHP 會保持原始的 Unicode 字符，不進行轉義
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
} else {
    http_response_code(405);
    echo '只允許 POST 請求';
}
