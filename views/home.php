<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travel Explorer</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        * {margin: 0; padding: 0; box-sizing: border-box; font-family: 'Roboto', sans-serif;}
        body {background-color: #f5f5f5;}
        header {
            background: #00aaff;
            color: white;
            padding: 15px 50px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        header h1 {font-size: 24px;}
        nav ul {list-style: none; display: flex; gap: 20px;}
        nav ul li a {
            color: white; text-decoration: none; font-weight: 500;
            transition: 0.3s;
        }
        nav ul li a:hover {text-decoration: underline;}
        .hero {
            position: relative;
            height: 70vh;
            background: url('https://images.unsplash.com/photo-1507525428034-b723cf961d3e') center/cover no-repeat;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            text-align: center;
        }
        .hero h2 {font-size: 48px; margin-bottom: 20px; text-shadow: 2px 2px 5px rgba(0,0,0,0.6);}
        .hero p {font-size: 20px; text-shadow: 1px 1px 3px rgba(0,0,0,0.6);}
        .login-btn {
            background: #ff9900; color: white; border: none;
            padding: 10px 20px; cursor: pointer; border-radius: 5px;
            font-size: 16px;
        }
        .login-btn:hover {background: #e88b00;}
        /* Login Modal */
        .modal {display: none; position: fixed; z-index: 10; left:0; top:0; width:100%; height:100%; overflow:auto; background: rgba(0,0,0,0.6);}
        .modal-content {
            background: white; margin: 10% auto; padding: 20px; border-radius: 10px;
            width: 300px; position: relative;
        }
        .modal-content h3 {margin-bottom: 15px; text-align: center;}
        .modal-content input {
            width: 100%; padding: 10px; margin: 5px 0 15px 0; border-radius: 5px; border: 1px solid #ccc;
        }
        .modal-content button {
            width: 100%; padding: 10px; background: #00aaff; color: white; border: none; border-radius: 5px;
            cursor: pointer;
        }
        .modal-content button:hover {background: #0088cc;}
        .close {
            position: absolute; top: 10px; right: 15px; font-size: 20px; cursor: pointer;
        }
        footer {
            background: #333; color: white; text-align: center; padding: 15px 0; margin-top: 30px;
        }
    </style>
</head>
<body>
    <header>
        <h1>Travel Explorer</h1>
        <nav>
            <ul>
                <li><a href="#">Trang chủ</a></li>
                <li><a href="#">Tour</a></li>
                <li><a href="#">Khách sạn</a></li>
                <li><a href="#">Liên hệ</a></li>
                <li><button class="login-btn" id="openLogin">Đăng nhập</button></li>
            </ul>
        </nav>
    </header>

    <section class="hero">
        <div>
            <h2>Khám phá thế giới cùng Travel Explorer</h2>
            <p>Chuyến đi mơ ước, trải nghiệm không giới hạn</p>
        </div>
    </section>

    <!-- Login Modal -->
    <!-- Login Modal -->
<div class="modal" id="loginModal">
    <div class="modal-content">
        <span class="close" id="closeModal">&times;</span>
        <h3>Đăng nhập</h3>

        <form action="index.php?act=loginHandle" method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Đăng nhập</button>
        </form>
    </div>
</div>

    <footer>
        &copy; 2025 Travel Explorer. All Rights Reserved.
    </footer>

    <script>
        const modal = document.getElementById('loginModal');
        const openBtn = document.getElementById('openLogin');
        const closeBtn = document.getElementById('closeModal');

        openBtn.onclick = () => modal.style.display = 'block';
        closeBtn.onclick = () => modal.style.display = 'none';
        window.onclick = (e) => { if(e.target == modal) modal.style.display = 'none'; }

        function login(){
            const user = document.getElementById('username').value;
            const pass = document.getElementById('password').value;
            if(user && pass){
                alert(`Đăng nhập thành công: ${user}`);
                modal.style.display = 'none';
            } else {
                alert('Vui lòng nhập username và password!');
            }
        }
    </script>
</body>
</html>
