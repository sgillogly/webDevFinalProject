<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
    <h1>Login </h1>
    <form action="index.php" method="post">
        <table>
        <tr>
        <td><label>username: </label></td>
        <td><input type="text" name="user" required></td>
        </tr>
        <tr>
        <td><label>password: </label></td>
        <td><input type="password" name="pass" required></td>
        </tr>
        </table>
        <input name="form" type="hidden" value="login">
        <input type="submit" value="login">
    </form>
    </body>
</html>