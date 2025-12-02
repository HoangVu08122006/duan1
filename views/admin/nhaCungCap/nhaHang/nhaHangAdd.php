<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Thêm nhà hàng</title>
  <style>
    body {
      font-family: 'Segoe UI', Arial, sans-serif;
      background: linear-gradient(135deg, #ffecd2 0%, #fcb69f 100%);
      margin: 0;
      color: #333;
    }

    h2 {
      text-align: center;
      margin-bottom: 25px;
      color: #2c3e50;
      font-size: 28px;
    }

    form {
      max-width: 500px;
      margin: 0 auto;
      background: #fff;
      padding: 30px;
      border-radius: 15px;
      box-shadow: 0 8px 20px rgba(0,0,0,0.15);
      animation: fadeIn 0.6s ease;
    }

    label {
      display: block;
      margin: 12px 0 6px;
      font-weight: 600;
      color: #444;
    }

    input[type="text"], textarea {
      width: 100%;
      padding: 12px;
      border: 1px solid #ccc;
      border-radius: 8px;
      font-size: 15px;
      margin-bottom: 18px;
      transition: all 0.3s ease;
    }

    input[type="text"]:focus, textarea:focus {
      border-color: #ff7f50;
      box-shadow: 0 0 6px rgba(255,127,80,0.4);
      outline: none;
    }

    button {
      display: block;
      width: 100%;
      padding: 14px;
      background: linear-gradient(135deg, #ff7f50, #ff4500);
      color: #fff;
      border: none;
      border-radius: 8px;
      font-size: 16px;
      font-weight: 600;
      cursor: pointer;
      transition: transform 0.2s ease, box-shadow 0.3s ease;
    }

    button:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(0,0,0,0.2);
    }

    .back-link {
      text-align: center;
      margin-top: 25px;
    }

    .back-link a {
      display: inline-block;
      padding: 10px 18px;
      background-color: #6c757d;
      color: #fff;
      border-radius: 8px;
      text-decoration: none;
      font-weight: 500;
      transition: background-color 0.3s ease;
    }

    .back-link a:hover {
      background-color: #5a6268;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }
  </style>
</head>
<body>
  <h2>🍽️ Thêm nhà hàng</h2>
  <form method="post">
    <label>Tên nhà hàng:</label>
    <input type="text" name="ten_nha_hang" required>
    <label>SĐT:</label>
    <textarea name="sdt_nha_hang"></textarea>
    <label>Giá:</label>
    <textarea name="gia_nha_hang"></textarea>
    <label>Mô tả:</label>
    <textarea name="mo_ta"></textarea>
    <button type="submit">💾 Lưu</button>
  </form>

  <div class="back-link">
    <a href="index.php?act=nhaHang">⬅️ Quay lại danh sách</a>
  </div>
</body>
</html>
