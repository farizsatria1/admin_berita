<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Register | Portal Berita Kab.Agam</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
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
            <header>Register Form</header>
            <form action="{{ route('actionregister') }}" method="post">
                @csrf
                <div class="field">
                    <span class="fa fa-user"></span>
                    <input type="text" required name="name" id="name" placeholder="Name" value="{{ old('name') }}">
                </div>

                <div class="field space">
                    <span class="">
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                            <path d="M48 64C21.5 64 0 85.5 0 112c0 15.1 7.1 29.3 19.2 38.4L236.8 313.6c11.4 8.5 27 8.5 38.4 0L492.8 150.4c12.1-9.1 19.2-23.3 19.2-38.4c0-26.5-21.5-48-48-48H48zM0 176V384c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V176L294.4 339.2c-22.8 17.1-54 17.1-76.8 0L0 176z" />
                        </svg>
                    </span>
                    <input type="text" required name="email" id="email" placeholder="Email" value="{{ old('email') }}">
                </div>

                <div class="field space">
                    <span class="fa fa-lock"></span>
                    <input type="password" name="password" id="password" class="pass-key" required placeholder="Password">
                </div>

                <div class="field mt-3">
                    <input type="submit" value="Register" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8"></script>
</body>

</html>