<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
    <h1>Update Journal Entry</h1>
    <p>Max length: 500 characters</p>
    <form action="index.php" method="post">
        <textarea name="entry" rows="10" cols="50" maxlength="500" required><?php echo $result['entry'] ?></textarea>
        <input name="entryID" type="hidden" value="<?php echo $_GET['id'] ?>">
        <input name="form" type="hidden" value="update"><br>
        <input type="submit" value="update entry">
    </form>
    </body>
</html>