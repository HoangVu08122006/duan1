<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý nhà cung cấp</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f9f9f9;
        text-align: center;
    }

    h1 {
        color: #333;
        margin-bottom: 30px;
    }

    .ncc-container {
        display: flex;
        justify-content: center;
        gap: 30px;
        flex-wrap: wrap;
    }

    .ncc-box {
        text-decoration: none;
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 10px;
        width: 180px;
        padding: 20px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        text-align: center;
        color: #333;
        transition: transform 0.3s ease, background-color 0.3s ease;
    }

    .ncc-box:hover {
        transform: translateY(-5px);
        background-color: #eef;
    }

    .ncc-icon {
        font-size: 40px;
        margin-bottom: 10px;
    }

    .ncc-label {
        font-size: 16px;
        font-weight: bold;
    }

    @media (max-width: 600px) {
        .ncc-container {
            flex-direction: column;
            align-items: center;
        }
    }
</style>

</head>

<body>
    <h1>Quản lý nhà cung cấp</h1>
    <div class="ncc-container">
        <a class="ncc-box" href="index.php?act=khachSan">
            <div class="ncc-icon">🏨</div>
            <div class="ncc-label">Khách Sạn</div>
        </a>
        <a class="ncc-box" href="index.php?act=nhaHang">
            <div class="ncc-icon">🍽️</div>
            <div class="ncc-label">Nhà Hàng</div>
        </a>
        <a class="ncc-box" href="index.php?act=nhaXe">
            <div class="ncc-icon">🚐</div>
            <div class="ncc-label">Nhà Xe</div>
        </a>
    </div>
</body>


</html>