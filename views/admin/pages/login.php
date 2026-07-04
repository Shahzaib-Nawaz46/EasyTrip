<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - EasyTrip</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/main.css">
    <style>
        body {
            background-color: #f5f5f5;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
        }
        .login-box {
            background: #fff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 400px;
        }
        .login-box h2 {
            margin-top: 0;
            margin-bottom: 24px;
            color: #003b95;
            text-align: center;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #1a1a1a;
        }
        .form-control {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 14px;
        }
        .btn-primary {
            background-color: #0071c2;
            color: white;
            border: none;
            padding: 12px;
            width: 100%;
            font-size: 16px;
            font-weight: bold;
            border-radius: 4px;
            cursor: pointer;
        }
        .btn-primary:hover {
            background-color: #004f8a;
        }
        .error-msg {
            color: #d9534f;
            background: #fdf7f7;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 20px;
            border: 1px solid #d9534f;
            font-size: 14px;
        }
    </style>
</head>
<body>

<div class="login-box">
    <h2>EasyTrip Admin</h2>
    <?php if(!empty($error)): ?>
        <div class="error-msg"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <form method="POST" action="<?= BASE_URL ?>/admin/login">
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" class="form-control" required autofocus>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" class="form-control" required>
        </div>
        <button type="submit" class="btn-primary">Login</button>
    </form>
</div>

</body>
</html>
