<!DOCTYPE html>
<!-- Created By CodingNepal -->
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Login | Portal Berita Kab.Agam</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <style>
        .corner-text {
            font-family: 'Montserrat', sans-serif;
            position: absolute;
            top: 10px;
            left: 10px;
            color: white;
            font-weight: bold;
            font-size: 20px;
            padding: 20px;

        }
    </style>
</head>

<body>
    <div class="bg-img">
        <div class="corner-text">Portal Berita | Kab.Agam</div>
        <div class="content">
            <header>Admin Login</header>
            <form action="{{ route('actionlogin') }}" method="post">
            @csrf
                <div class="field">
                    <span class="fa fa-user"></span>
                    <input type="text" required name="email" placeholder="Email">
                </div>
                <div class="field space">
                    <span class="fa fa-lock"></span>
                    <input type="password" name="password" class="pass-key" required placeholder="Password">
                </div>
                <div class="field mt-3">
                    <input type="submit" value="LOGIN">
                </div>

                @if(session('error'))
                <div class="alert alert-danger">
                    <b>Opps!</b> {{session('error')}}
                </div>
                @endif

            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8