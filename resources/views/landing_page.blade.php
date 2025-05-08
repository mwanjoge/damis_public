<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tanzania Document Validation Portal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom background styles -->
    <link rel="stylesheet" href="{{ asset('build/css/background.css') }}">

</head>
<body>

    <!-- Background layers -->
    <div class="flag-bg"></div>
    <div class="overlay"></div>

    <!-- Header with logo and title -->
    <header class="header">
        <div class="title-area">
            <img src="{{ asset('images/emblem.png') }}" alt="Logo"> <!-- Replace with your actual logo -->
            <div class="header-text">
                <h1 >&nbsp;&nbsp;&nbsp;D&nbsp;&nbsp;&nbsp;A&nbsp;&nbsp;&nbsp;M&nbsp;&nbsp;&nbsp;I&nbsp;&nbsp;&nbsp;S&nbsp;&nbsp;&nbsp;</h1>
                <h5>Document Authentication Management Information System</h5>
            </div>
        </div>
    </header>

    <!-- Main content -->
    <div class="d-flex justify-content-center align-items-center">
        <div class="content-box text-center ">
            <h1 class="mb-3">Karibu!</h1>
            <h5 class="mb-4 px-4">The Official Tanzanian Document Legalization Portal</h5>
          

            <form action="{{ route('track.request') }}" method="GET" class="mb-4">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="trackingNumber" placeholder="Enter Tracking Number" required>
                    <button class="btn btn-custom" type="submit">Track Request</button>
                </div>
            </form>
            

            <a href="{{ route('request.index') }}" class="btn btn-outline-light btn-lg">Start New Request</a>
        </div>
    </div>

    <style>
        .header {
            z-index: 3;
            position: relative;
            padding: 20px 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }

        .header .title-area {
            display: flex;
            align-items: center;
            flex-direction: column;
            justify-content: center;
            gap: 15px;
        }

        .header img {
            height: 100px;
        }

        .header-text h1 {
            font-size: 2rem;
            margin: 0;
            font-weight: bold;
            letter-spacing: 0.4em;
        }

        .header-text p {
            font-size: 1rem;
            margin: 0;
            opacity: 0.9;
        }

        .content-box {
            position: relative;
            z-index: 2;
            max-width: 600px;
            margin: auto;
            padding: 40px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            backdrop-filter: blur(10px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.3);
            color: #fff;
        }

        .btn-custom {
            background-color: #006747;
            color: white;
        }

        .btn-custom:hover {
            background-color: #004d36;
        }
    </style>
</body>
</html>
