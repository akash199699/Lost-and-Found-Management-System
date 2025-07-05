<!DOCTYPE html>
<html>
<head>
    <title>Sign Up</title>
	<link rel="stylesheet" type="text/css" href="sty.css">

</head>
<body>
	<div class="container">
    <h2>Sign Up</h2>
    <form action="signup_process.php" method="post">
        Username : <input type="text" name="username_signup"><br><br>
        Password : <input type="password" name="password_signup"><br><br>
        Email : <input type="text" name="email_signup"><br><br>
        Role : <input type="text" name="other_info_signup"><br><br>
        <input type="submit" value="Sign Up">
    </form>
    <p>Already have an account? <a href="login.php">Login here</a>.</p>
</body>
</html>
