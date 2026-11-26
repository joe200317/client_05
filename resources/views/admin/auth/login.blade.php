
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title>Admin Login | Mind Training</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@500;600;700&display=swap" rel="stylesheet">

    <style>
        * { box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100vh;
            display: grid;
            place-items: center;
            padding: 24px;
            font-family: 'DM Sans', sans-serif;
            color: #24392a;
            background:
                radial-gradient(circle at 15% 15%, #e2efd9, transparent 35%),
                linear-gradient(135deg, #f7f8ef, #edf5e5);
        }

        .login-card {
            width: 100%;
            max-width: 430px;
            padding: 42px;
            background: rgba(255,255,255,.94);
            border: 1px solid #e1ead9;
            border-radius: 24px;
            box-shadow: 0 24px 70px rgba(36,57,42,.10);
        }

        .brand {
            text-align: center;
            margin-bottom: 32px;
        }

        .brand-mark {
            width: 54px;
            height: 54px;
            margin: 0 auto 14px;
            display: grid;
            place-items: center;
            border-radius: 17px;
            color: white;
            font-size: 25px;
            background: linear-gradient(135deg, #215731, #70a34e);
        }

        .brand h1 {
            margin: 0;
            font: 700 27px 'Playfair Display', serif;
        }

        .brand p {
            margin: 7px 0 0;
            color: #718071;
            font-size: 12px;
            letter-spacing: 1.5px;
            text-transform: uppercase;
        }

        .intro {
            margin-bottom: 25px;
        }

        .intro h2 {
            margin: 0 0 7px;
            font: 600 23px 'Playfair Display', serif;
        }

        .intro p {
            margin: 0;
            color: #718071;
            font-size: 13px;
        }

        .field { margin-bottom: 18px; }

        label {
            display: block;
            margin-bottom: 8px;
            font-size: 13px;
            font-weight: 700;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 13px 14px;
            border: 1px solid #dce6d2;
            border-radius: 11px;
            outline: none;
            font: inherit;
            font-size: 14px;
            background: #fbfcf9;
        }

        input:focus {
            border-color: #54845a;
            box-shadow: 0 0 0 3px rgba(84,132,90,.12);
        }

        .remember {
            display: flex;
            align-items: center;
            gap: 9px;
            margin: 4px 0 22px;
            color: #607060;
            font-size: 13px;
        }

        .remember input { accent-color: #2d7542; }

        .submit-btn {
            width: 100%;
            padding: 14px;
            border: 0;
            border-radius: 999px;
            color: white;
            background: linear-gradient(110deg, #215731, #43834c);
            font: 700 14px 'DM Sans', sans-serif;
            cursor: pointer;
            box-shadow: 0 9px 20px rgba(45,117,66,.18);
        }

        .submit-btn:hover { filter: brightness(1.08); }

        .error {
            margin-bottom: 18px;
            padding: 12px 14px;
            color: #9e2f24;
            background: #fdf0ee;
            border: 1px solid #ecc5be;
            border-radius: 10px;
            font-size: 13px;
        }

        .back-link {
            display: block;
            margin-top: 24px;
            text-align: center;
            color: #64805e;
            font-size: 13px;
            text-decoration: none;
        }

        .back-link:hover { color: #215731; }

        @media (max-width: 480px) {
            .login-card { padding: 30px 22px; }
        }
    </style>
</head>
<body>
    <main class="login-card">
        <div class="brand">
            <div class="brand-mark">✦</div>
            <h1>Mind Training</h1>
            <p>Administration Portal</p>
        </div>

        <div class="intro">
            <h2>Welcome back</h2>
            <p>Sign in with your administrator credentials.</p>
        </div>

        @if ($errors->any())
            <div class="error" role="alert">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.login.submit') }}">
            @csrf

            <div class="field">
                <label for="email">Email address</label>
                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email', $rememberedEmail ?? '') }}"
                    placeholder="admin@example.com"
                    autocomplete="username"
                    required
                    autofocus
                >
            </div>

            <div class="field">
                <label for="password">Password</label>
                <input
                    id="password"
                    type="password"
                    name="password"
                    placeholder="Enter your password"
                    autocomplete="current-password"
                    required
                >
            </div>

            <label class="remember">
                <input
                    type="checkbox"
                    name="remember"
                    value="1"
                    @checked(old('remember', filled($rememberedEmail ?? '')))
                >
                Remember me
            </label>

            <button type="submit" class="submit-btn">
                Sign in to dashboard →
            </button>
        </form>

        <a href="{{ route('home') }}" class="back-link">
            ← Back to website
        </a>
    </main>
</body>
</html>
