<?php
if (!isset($_SESSION)) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Reset password instructions sent</title>
    <style>
        .center {
            margin: 3em auto;
            padding: 10px;
        }
    </style>
</head>

<body>
    <div class="center">
        <h4><?php echo $_SESSION['email_success'] ?></h4>
        <p> <a href="../index.php"> Continue</a>.</p>
    </div>
</body>

</html>