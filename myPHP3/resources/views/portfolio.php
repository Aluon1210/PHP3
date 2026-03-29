<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Thẻ sinh viên</title>
    <style>
    body {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'Segoe UI', Arial, sans-serif;
    }

    .student-card {
        background: #fff;
        border-radius: 18px;
        box-shadow: 0 8px 32px rgba(44, 62, 80, 0.15);
        width: 380px;
        overflow: hidden;
        transition: box-shadow 0.3s;
    }

    .student-card:hover {
        box-shadow: 0 12px 40px rgba(44, 62, 80, 0.25);
    }

    .header {
        background: linear-gradient(90deg, #2980b9 0%, #6dd5fa 100%);
        color: #fff;
        text-align: center;
        padding: 22px 0 16px 0;
        font-size: 26px;
        font-weight: 700;
        letter-spacing: 2px;
    }

    .profile {
        display: flex;
        align-items: center;
        padding: 24px 24px 10px 24px;
    }

    .avatar {
        width: 90px;
        height: 110px;
        background-image: url('C:/xampp/htdocs/PHP3/myPHP3/resources/views/abc.jpg');
        background-size: cover;
        background-position: center;
        border-radius: 10px;
        margin-right: 22px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 13px;
        color: #888;
        box-shadow: 0 2px 8px rgba(44, 62, 80, 0.08);
    }

    .details p {
        margin: 7px 0;
        font-size: 16px;
        color: #333;
    }

    .section-title {
        margin: 18px 0 7px 0;
        font-size: 15px;
        color: #2980b9;
        font-weight: 600;
    }

    ul {
        margin: 0 0 10px 22px;
        padding: 0;
    }

    li {
        font-size: 14px;
        color: #444;
        margin-bottom: 3px;
    }

    .footer {
        background: #f7fafd;
        text-align: center;
        padding: 12px 0;
        font-size: 13px;
        color: #7f8c8d;
        letter-spacing: 1px;
    }
    </style>
</head>

<body>
    <div class="student-card">
        <div class="header">
            THẺ SINH VIÊN
        </div>
        <div class="profile">
            <div class="avatar">
                Ảnh<br>SV
            </div>
            <div class="details">
                <p><b>Họ và tên:</b> <?php echo $info['first_name'] . " " . $info['last_name']; ?></p>
                <p><b>Tuổi:</b> <?php echo $info['age']; ?></p>
                <p><b>Nghề nghiệp:</b> <?php echo $info['job']; ?></p>
            </div>
        </div>
        <div style="padding: 0 24px 10px 24px;">
            <div class="section-title">Kỹ năng chuyên môn</div>
            <ul>
                <?php foreach ($info['skills'] as $skill) : ?>
                <li><?php echo $skill; ?></li>
                <?php endforeach; ?>
            </ul>
            <div class="section-title">Kỹ năng mềm</div>
            <ul>
                <?php foreach ($info['soft_skills'] as $soft_skill) : ?>
                <li><?php echo $soft_skill; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="footer">
            FPT Polytechnic
        </div>
    </div>
</body>

</html>