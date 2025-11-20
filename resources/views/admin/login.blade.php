<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>

    <link rel="stylesheet" href="{{ asset('purple/assets/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('purple/assets/css/style.css') }}">

    <style>
        body {
            background: #6a1b9a; /* purple gelap */
        }
        .login-box {
            width: 380px;
            margin: 120px auto;
            background: #ffffff;
            padding: 35px 30px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.25);
        }
        .login-title {
            font-size: 22px;
            font-weight: bold;
            color: #6a1b9a;
            text-align: center;
        }
        .btn-purple {
            background: #6a1b9a;
            color: #fff;
            width: 100%;
        }
        .btn-purple:hover {
            background: #4a116b;
        }
    </style>
</head>

<body>

<div class="login-box">
    <h3 class="login-title mb-4">Admin Login</h3>

    @if(session('error'))
        <div class="alert alert-danger py-2">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="{{ route('admin.login') }}">
        @csrf

        <div class="form-group mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required placeholder="admin@gmail.com">
        </div>

        <div class="form-group mb-4">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required placeholder="••••••••">
        </div>

        <button class="btn btn-purple btn-lg">Login</button>

    </form>
</div>

</body>
</html>
