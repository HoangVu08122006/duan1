<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travel Explorer - Beach Summer UI</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        * {margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif;}

        body {
            background: #e9f9ff;
            color: #333;
        }

        /* HEADER */
        header {
            background: linear-gradient(135deg, #00c6fb, #005bea);
            padding: 15px 60px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: white;
            position: sticky;
            top: 0;
            z-index: 1200;
            box-shadow: 0 3px 20px rgba(0,0,0,0.25);
        }

        header h1 {
            font-size: 28px;
            font-weight: 700;
            text-shadow: 0 2px 8px rgba(0,0,0,0.3);
        }

        nav ul {
            list-style: none;
            display: flex;
            gap: 30px;
        }

        nav ul li a {
            color: #fff;
            text-decoration: none;
            font-weight: 500;
            transition: 0.3s;
        }
        nav ul li a:hover {opacity: 0.75;}

        .login-btn {
            background: #ffcc33;
            padding: 10px 20px;
            border-radius: 25px;
            border: none;
            color: #333;
            cursor: pointer;
            font-weight: 600;
            transition: 0.3s;
        }
        .login-btn:hover {background: #ffb020;}

        /* HERO */
        .hero {
            height: 75vh;
            background: url('https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=1920&q=80')
                        center/cover no-repeat;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }

        .hero::before {
            content: "";
            position: absolute;
            inset: 0;
            background: rgba(0, 94, 170, 0.35);
        }

        .hero-content {
            position: relative;
            color: white;
            text-align: center;
            max-width: 700px;
        }

        .hero-content h2 {
            font-size: 50px;
            font-weight: 700;
            margin-bottom: 15px;
            text-shadow: 0 5px 15px rgba(0,0,0,0.45);
        }

        .hero-content p {
            font-size: 20px;
            margin-bottom: 25px;
            opacity: 0.95;
        }

        /* MODAL BEACH SUMMER */
        .modal {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.55);
            backdrop-filter: blur(6px);
            justify-content: center;
            align-items: center;
            z-index: 2000;

            background-image: url('https://images.unsplash.com/photo-1507525428034-b723cf961d3e');
            background-size: cover;
            background-position: center;
        }

        .modal-content {
            width: 370px;
            padding: 30px;
            border-radius: 20px;

            background: rgba(255, 255, 255, 0.9);
            border: 2px solid #80dfff;

            box-shadow:
                0 4px 25px rgba(0,150,255,0.4),
                inset 0 0 10px rgba(255,255,255,0.7);

            animation: fadeIn .6s ease;
            position: relative;
        }

        @keyframes fadeIn {
            from {opacity: 0; transform: translateY(20px);}
            to {opacity: 1; transform: translateY(0);}
        }

        .modal-content h3 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 24px;
            font-weight: 700;
            color: #007acc;
            text-shadow: 0 2px 8px rgba(0,120,255,0.4);
        }

        .modal-content input {
            width: 100%;
            padding: 12px;
            margin-bottom: 18px;

            background: #e8f7ff;
            border: 1px solid #99d9ff;
            border-radius: 8px;
            color: #333;
            font-size: 15px;

            transition: 0.3s;
        }

        .modal-content input:focus {
            border-color: #00aaff;
            box-shadow: 0 0 10px #a3e4ff;
            outline: none;
        }

        .modal-content button {
            width: 100%;
            padding: 12px;

            background: linear-gradient(135deg, #ffee66, #ffbb33);
            border: none;
            border-radius: 10px;
            color: #333;
            font-weight: 700;
            font-size: 17px;
            cursor: pointer;

            box-shadow: 0 3px 12px rgba(255,200,0,0.55);
            transition: 0.25s;
        }

        .modal-content button:hover {
            background: linear-gradient(135deg, #ffdf33, #ffaa22);
            transform: translateY(-2px);
        }

        .close {
            position: absolute;
            right: 18px;
            top: 15px;
            font-size: 28px;
            color: #0099cc;
            cursor: pointer;
            font-weight: 700;
            transition: 0.2s;
        }
        .close:hover {color: #006688;}

        /* FOOTER */
        footer {
            margin-top: 40px;
            background: #0099cc;
            text-align: center;
            padding: 18px 0;
            font-size: 14px;
            color: white;
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
    <div class="hero-content">
        <h2>Cùng gia đình và bạn bè đến với những chuyến đi đầy đáng nhớ!</h2>
        <p>Đắm mình trong nắng vàng – biển xanh – gió mát</p>
    </div>
</section>

<!-- LOGIN MODAL -->
<div class="modal" id="loginModal">
    <div class="modal-content">
        <span class="close" id="closeModal">&times;</span>

        <h3>Đăng nhập</h3>

        <form action="index.php?act=loginHandle" method="POST">
            <input type="text" name="username" placeholder="Tên đăng nhập" required>
            <input type="password" name="password" placeholder="Mật khẩu" required>
            <button type="submit">Đăng nhập</button>
        </form>

    </div>
</div>

<footer>
    © 2025 Travel Explorer — Summer Beach Edition
</footer>

<script>
    const modal = document.getElementById("loginModal");
    const openBtn = document.getElementById("openLogin");
    const closeBtn = document.getElementById("closeModal");

    openBtn.onclick = () => modal.style.display = "flex";
    closeBtn.onclick = () => modal.style.display = "none";
    window.onclick = e => { if(e.target === modal) modal.style.display = "none"; };
</script>

</body>
</html>
