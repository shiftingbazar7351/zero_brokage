<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&family=Quicksand:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            font-family: "Quicksand", sans-serif;
        }

        * body .main .container {
            width: 492px;
            background: #FFFFFF;
            border: 1px solid #D9D9D9;
            border-radius: 3px;
            padding: 30px;
            display: block;
            margin: 12px auto;
            max-width: 100%;
            box-sizing: border-box;
        }

        * body .main .container .logo {
            margin-bottom: 49.3px;
        }

        * body .main .container .logo img {
            max-width: 190px;
            display: block;
            margin: auto;
        }

        * body .main .container h1 {
            color: #323130;
            font-size: 14px;
            line-height: 16px;
            font-weight: 500;
            text-align: center;
            margin-bottom: 10px;
        }

        * body .main .container .banner {
            background-color: #EFF6FC;
            border-radius: 3px;
            padding-top: 20px;
        }

        * body .main .container .banner img {
            max-width: 100%;
            margin: auto;
            display: block;
        }

        * body .main .container .body {
            text-align: center;
        }

        * body .main .container .body h2 {
            margin: 31px 0 40px 0;
            font-size: 18px;
            line-height: 34px;
            color: #323130;
        }

        * body .main .container .body p {
            margin-bottom: 20px;
        }

        * body .main .container .body p b {
            display: block;
            margin-bottom: 10px;
        }

        * body .main .container .body a {
            width: 122px;
            height: 36px;
            display: flex;
            vertical-align: middle;
            align-items: center;
            justify-content: center;
            color: #FFFFFF;
            border-radius: 3px;
            background-color: #016FB9;
            font-size: 15px;
            font-weight: 600;
            text-decoration: none !important;
            margin: auto;
        }

        * body .main .container .footer {
            max-width: 267px;
            margin: auto;
            text-align: center;
            margin-top: 40px;
        }

        * body .main .container .footer p {
            font-size: 12px;
            line-height: 14px;
            font-weight: 500;
            letter-spacing: 0px;
            color: #323130;
            margin-bottom: 20px;
        }

        * body .main .container .footer p a {
            color: #016FB9;
            text-decoration: none !important;
        }

        * body .main .container .footer hr {
            margin: 15px 0;
        }

        /*# sourceMappingURL=style.css.map */
    </style>
</head>

<body>
    <div class="main">
        <div class="container">
            <div class="logo">
                <img src="{{ asset('assets/img/logofinal.png') }}" alt="Logo" />
            </div>
            <h1>Lets join the tribe of {{ $projectName }}</h1>
            <div class="body">
                <h2>Welcome to {{ $projectName }} <br />you can now get onboard with credential.</h2>
                <p><b>Email:</b>{{ $email }}</p>
                <p><b>Password:</b> {{ $password }}</p>
                {{--  <a href="javascript:void(0)">Login</a>  --}}
            </div>
            <div class="footer">
                <p>Thank you for using <a href="javascript:void(0)">{{ $projectName }}</a></p>
                <hr />
                <p>Please do not reply to this email as it is auto-generated</p>
            </div>
        </div>
    </div>
</body>
</html>
