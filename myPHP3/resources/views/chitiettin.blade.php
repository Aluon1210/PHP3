<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Chi tiết tin</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        background: #f4f6f9;
        margin: 0;
        padding: 0;
    }

    .container {
        width: 70%;
        margin: 40px auto;
        background: #fff;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    h1 {
        color: #2c3e50;
        margin-bottom: 10px;
    }

    h3 {
        color: #7f8c8d;
        font-weight: normal;
        margin-bottom: 20px;
    }

    #noidung {
        line-height: 1.8;
        color: #333;
    }

    .date {
        font-size: 14px;
        color: #999;
        margin-bottom: 15px;
    }

    hr {
        margin: 20px 0;
    }

    .back {
        display: inline-block;
        margin-top: 20px;
        text-decoration: none;
        color: #3498db;
    }

    .back:hover {
        text-decoration: underline;
    }
    </style>
</head>

<body>

    <div class="container">
        <h1>{{ $tin->tieuDe }}</h1>

        <h3>{{ $tin->tomTat }}</h3>

        <hr>

        <div id="noidung">
            {!! $tin->noiDung !!}
        </div>

        <a href="/" class="back">← Quay lại trang chủ</a>
    </div>

</body>

</html>