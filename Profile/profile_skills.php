<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        *{
            margin: 0;
            padding: 0;
            font-family: 'Poppins', 'sans-serif';
            box-sizing: border-box;
        }

        .hero{
            width:100%;
            min-height: 100vh;
            background:#eceaff;
            color: #333;
        }

        nav{
            background: #1a1a1a;
            width: 100%;
            padding: 10px 10%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative;
        }

        .logo {
            width: 120px;

        }

        .user-pic {
            width: 40px;
            border-radius: 50%;
            cursor: pointer;
            margin-left: 30px;
        }

        nav ul {
            width: 100%;
            text-align: right;
        }

        nav ul li {
            display: inline-block;
            list-style: none;
            margin: 10px 20px;
        }

        nav ul li a {
            color: #fff;
            text-decoration: none;
        }

        .sub-menu-wrap{
            position: absolute;
            top: 100%;
            right: 10%;
            width: 320px;
            max-height: 0px;
            overflow: hidden;
            transition: max-height 0.5s;
        }

        .sub-menu-wrap.open-menu{
            max-height: 400px;

        }

        .sub-menu {
            background: #fff;
            padding: 20px;
            margin: 10px;
        }

        .user-info {
            display: flex;
            align-items: center;
        }

        .user-info h2 {
            font-weight: 500;
        }
        .user-info img {
            width: 60px;
            border-radius: 50%;
            margin-right: 15px;
        }
        .sub-menu hr{
            border: 0;
            height: 1px;
            width: 100%;
            background: #ccc;
            margin: 15px 0 10px;
        }

        .sub-menu-link {
            display: flex;
            align-items: center;
            text-decoration: none;
            color: #525252;
            margin: 12px 0;
        }

        .sub-menu-link p {
            width: 100%;
        }

        .sub-menu-link img {
            width: 50px;
            background:#e5e5e5;
            border-radius: 50%;
            padding: 8px;
            margin-right: 15px;
        }

        .sub-menu-link span {
            font-size: 22px;
            transition: transform 0.5s;
        }

        .sub-menu-link:hover span{
            transform: translateX(5px);
        }

        .sub-menu-link:hover p {
            font-weight: 600;

        }
        
    </style>

    
        
</head>

<body>

<div class="hero">
    <nav>
        <img src="../Photos/EngineerIN_logo.png" class="logo" style="width:10%;">
        <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">Features</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#">Contact</a></li>
        </ul>
        <img src="../Photos/photo1.png" class="user-pic" onclick="toggleMenu()">

        <div class="sub-menu-wrap" id="subMenu">
            <div class="sub-menu">
                <div class="user-info">
                    <img src="../Photos/photo1.png" style=" width: 30%; border-radius: 50%;">
                    <h2>Username</h2>
                </div>
                <hr>

                <a href="#" class="sub-menu-link">
                    <img src="../Photos/photo1.png">
                    <p>Edit Profile</p>
                    <span>></span>
                </a>
                <a href="#" class="sub-menu-link">
                    <img src="../Photos/photo1.png">
                    <p>Settings & Privacy</p>
                    <span>></span>
                </a>
                <a href="#" class="sub-menu-link">
                    <img src="../Photos/photo1.png">
                    <p>Help & Support</p>
                    <span>></span>
                </a>
                <a href="#" class="sub-menu-link">
                    <img src="../Photos/photo1.png">
                    <p>Logout</p>
                    <span>></span>
                </a>

            </div>
        </div>

    </nav>
</div>

<script>
        let subMenu = document.getElementById("subMenu");
        function toggleMenu() {
            subMenu.classList.toggle("open-menu");
        }
</script>

</body>
</html>
