<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Multipart Form Data Example</title>
</head>

<body>
    <h2>發送 multipart/form-data 請求到 PHP 伺服器</h2>
    <form id="myForm" enctype="multipart/form-data">
        <label for="req">輸入文字參數 (req):</label><br>
        <input type="text" id="req" name="req"><br><br>

        <label for="file">上傳文件:</label><br>
        <input type="file" id="file" name="file"><br><br>

        <button type="button" onclick="sendRequest()">發送請求</button>
    </form>
    <p id="response"></p>

    <script>
        function sendRequest() {
            var form = document.getElementById("myForm");
            var formData = new FormData(form); // 直接使用表單構建 FormData

            var xhr = new XMLHttpRequest();
            xhr.open("POST", "back.php", true);

            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        document.getElementById("response").innerHTML = "回應: " + xhr.responseText;
                    } else {
                        document.getElementById("response").innerHTML = "發生錯誤: " + xhr.status;
                    }
                }
            };

            xhr.send(formData);
        }
    </script>
</body>

</html>