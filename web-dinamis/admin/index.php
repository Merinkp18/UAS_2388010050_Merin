<?php

session_start();
require_once "../config/database.php";

if(isset($_SESSION['admin'])){
    header("Location: dashboard.php");
    exit;
}

$error = '';

if(isset($_POST['login'])){

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    $query = mysqli_query(
        $conn,
        "SELECT * FROM admin WHERE email='$email'"
    );

    if(mysqli_num_rows($query) > 0){

        $admin = mysqli_fetch_assoc($query);

        if(password_verify($password, $admin['password'])){

            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['admin_nama'] = $admin['nama_lengkap'];

            header("Location: dashboard.php");
            exit;

        }else{
            $error = "Password salah!";
        }

    }else{
        $error = "Email tidak ditemukan!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>

<meta charset="UTF-8">
<title>Login Admin - Optik Merin</title>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Segoe UI',sans-serif;
}

body{
    background:#f4f7fb;
    height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
}

.login-card{

    width:420px;
    background:white;
    padding:35px;
    border-radius:20px;
    box-shadow:0 10px 30px rgba(0,0,0,.08);

}

.login-card h2{

    text-align:center;
    color:#2563eb;
    margin-bottom:10px;

}

.login-card p{

    text-align:center;
    color:#64748b;
    margin-bottom:25px;

}

.form-group{
    margin-bottom:15px;
}

.form-group label{
    display:block;
    margin-bottom:5px;
}

.form-group input{

    width:100%;
    padding:12px;
    border:1px solid #ddd;
    border-radius:10px;

}

.btn{

    width:100%;
    border:none;
    background:#2563eb;
    color:white;
    padding:12px;
    border-radius:10px;
    cursor:pointer;
    font-size:16px;

}

.btn:hover{
    background:#1d4ed8;
}

.error{

    background:#fee2e2;
    color:#dc2626;
    padding:10px;
    border-radius:10px;
    margin-bottom:15px;

}

</style>

</head>
<body>

<div class="login-card">

<h2>👓 OptiLens</h2>

<p>Login </p>

<?php if($error): ?>
<div class="error">
    <?= $error ?>
</div>
<?php endif; ?>

<form method="POST">

    <div class="form-group">
        <label>Email</label>
        <input
            type="email"
            name="email"
            required
        >
    </div>

    <div class="form-group">
        <label>Password</label>

        <input
            type="password"
            name="password"
            placeholder="password"
            required
        >
    </div>

    <button
        type="submit"
        name="login"
        class="btn"
    >
        Login
    </button>

</form>

</div>

</body>
</html>