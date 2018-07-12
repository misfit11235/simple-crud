<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>C.R.U.D.</title>
</head>
<body>
    <div>
        <form method="post" action="User.php">
            Username: <input type="text" name="username">
            Pass: <input type="password" name="pass">
            Email: <input type="email" name="email">
            <input type="submit" value="Create" name="insert">
        </form>
        <br>
    </div>
    <div>
        <form method="get" action="User.php">
            Get MySQL table ->> <input type="submit" value="Retrieve" name="retrieve">
        </form>
        <br>
    </div>
    <div>
        <form method="post" action="User.php">
            User ID for update: <input type="text" name="targetId">
            Username: <input type="text" name="username">
            Pass: <input type="password" name="pass">
            Email: <input type="email" name="email">
            <input type="submit" value="Update" name="update">
        </form>
        <br>
    </div>
    <div>
        <form method="post" action="User.php">
            User ID for removal: <input type="text" name="targetId">
            <input type="submit" value="Delete" name="delete">
        </form>
        <br>
    </div>
</body>
</html>
