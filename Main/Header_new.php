<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <!--<link rel="stylesheet" type="text/css" href="Site.css">-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Header</title>
    
    <style>
        * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: sans-serif;
    }

    body {
        width: 100%;
        height: 100vh;
        background: rgb(247, 242, 242);
    }

    header {
        height: 60px;
        width: 100%;
        background: #fff;
        box-shadow: 0px 2px 5px 5px rgba(204, 202, 202, 0.5);
        display: flex;
        align-items: center;
    }

    nav {
        display: flex;
        justify-content: space-between;
        align-items: center;
        width: 92%;
        margin: 0 auto;
    }

    .nav-left .logo img {
        width: 200px;
        height: auto;
        margin-left: -10px;
    }


    .nav-left .search-icon {
        width: 30px;
        text-align: center;
        color: rgb(44, 42, 42);
    }

    .nav-right {
        display: flex;
        align-items: center;
        justify-content: space-around;
        flex: 1;
    }

    .nav-right .nav-menus {
        text-align: center;
        cursor: pointer;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 0 10px;
        position: relative;
    }

    .nav-right .nav-menus i {
        font-size: 20px;
        color: #706e6e;
        margin-bottom: 2px;
    }

    .nav-right .nav-menus p {
        font-size: 13px;
        color: #706e6e;
        margin: 0;
    }

    .nav-right .nav-menus:nth-child(7) {
        border-left: 1px solid #ccc;
        padding-left: 15px;
    }

    .nav-right a {
        font-size: 13px;
        color: rgb(185, 122, 5);
        padding-left: 15px;
        text-decoration: none;
    }


    .nav-right .nav-menus:hover::after {
        content: '';
        width: 100%;
        height: 2px;
        background: #000;
        position: absolute;
        bottom: -10px;
        left: 0;
    }




    </style>
</head>



<body>
    <header>

        <nav>
            <div class="nav-left">
                <div class="logo">
                    <img src="../Photos/EngineerIN_logo.png" alt="ECE Paris"></img>
                </div>
                
            </div>
            <div class="nav-right">
                <div class="nav-menus">
                    <i class="fa-solid fa-house"></i>
                    <p>Home</p>
                </div>
                <div class="nav-menus">
                    <i class="fa-solid fa-users"></i>
                    <p>Mon Reseau</p>
                </div>

                <div class="nav-menus">
                    <i class="fa-solid fa-briefcase"></i>
                    <p>Emplois</p>
                </div>

                <div class="nav-menus">
                    <i class="fa-solid fa-message"></i>
                    <p>Messagerie</p>
                </div>
                <div class="nav-menus">
                    <i class="fa-solid fa-bell"></i>
                    <p>Notification</p>
                </div>

                <div class="nav-menus">
                    <i class="fa-solid fa-user"></i>
                    <p>Vous </p>
                </div>
                <div class="nav-menus">
                    <i class="fa-solid fa-border-none"></i>
                    <p>For Business <i class="fa-solid fa-caret-down"></i></p>
                </div>

                <a href="">Try Premium <br>for $100</a>
            </div>
        </nav>

    </header>
</body>

</html>
