<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <h3>
        <?php if(empty($_SESSION['user_login_in'])){?>
            <a href="index.php?action=home">home</a>
            <a href="index.php?action=create">create user</a>
            <a href="index.php?action=login">log in</a>
        <?php } else { ?>
            <a href="index.php?action=home">home</a>
            <a href="index.php?action=new">create entry</a>
            <a href="index.php?action=read">read journal</a>
            <a href="index.php?action=logout">log out</a>
        <?php } ?>
        </h3>
    </body>
</html>