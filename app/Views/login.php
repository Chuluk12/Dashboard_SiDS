
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SiDS Login</title>
    <link rel="shortcut icon" href="/assets/imgs/LOGOAQPA.png" />

    <style>
        @import  url(http://fonts.googleapis.com/css?family=Exo:100,200,400);
        @import  url(http://fonts.googleapis.com/css?family=Source+Sans+Pro:700,400,300);

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Exo', sans-serif;
        }


        body {
            background-image: url('/assets/imgs/background_sids2.jpg');
            background-size: cover;
            overflow: hidden;
            position: relative;
            
        }

        body::before {
            content: "";
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            background-color: rgba(0, 0, 0, 0.35);
            z-index: -1
        }

        .container {
            height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            align-content: center;
            justify-content: center;
        }

        .container .login_container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 10px;
        }

        .container .login_container .header {
            display: flex;
            flex-direction: row
        }

        .header>* {
            margin: 20px;
        }

        .title_area h1 {
            color: white;
            font-size: 2.5rem;
        }

        .title_area h1 span {
            color: red;
        }

        .form_area {
            display: flex;
            flex-direction: column;
            min-width: 250px
        }

        .form_area input {
            width: 100%;
            height: 40px;
            margin: 5px 0;
            padding-left: 10px;
        }

        .form_area input[type=text],
        input[type=password] {
            background-color: transparent;
            border: 2px solid white;
            color: white;
        }

        .form_area button[type=submit]{
            background-color: white;
            border: none;
            font-size: 1.2rem;
            font-weight: 900;
            width: 100%;
            height: 40px;
            margin: 5px 0;
            padding-left: 10px;
            cursor: pointer;
        }

        .form_area input::placeholder {
            color: white;
        }

        .footer {
            position: absolute;
            left: -290px;
            text-align: left;
            color: white;
            font-size: 1rem;
            position: relative;
        }

        .error_message{
            color: red;
            text-align: center
        }




        @media (max-width : 800px) {
            .container .login_container .header {
                display: flex;
                flex-direction: column
            }
        }

    </style>

</head>

<body>
    <div class="bg-body">
    <div class="container">


        <div class="login_container">

            <div class="header">
                <div class="title_area">
                    <h1>
                        Sistem Informasi <br> Dokumen Standar <span>(SiDS) <small>1.0</small> </span> 
                    </h1>
                </div>
                <div class="form_area">
                    <form action="/login" method="POST" autocomplete="off">
                        <?= csrf_field(); ?>
                        <input type="text" placeholder="Username" name="username" ><br />
                        <input type="password" placeholder="Password" name="password"><br />
                        <button type="submit" name="btn-login" value="Login">Login</button>
                        <p class="error_message">
                            <?= session()->getFlashdata('message');?>
                        </p>
                    </form>
                </div>
                </div>

            <div class="form_area">
                <h1 ><b>PT GRAND TWINS ENGINEERING</b></h1>
            </div>


        </div>
    </div>
    </div>

</body>

</html>
