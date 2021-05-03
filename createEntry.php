<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
    <h1>Create New Journal Entry</h1>
    <p>Max length: 500 characters</p>
    <form action="index.php" method="post">
        <textarea name="entry" rows="10" cols="50" maxlength="500" required></textarea>
        <input name="form" type="hidden" value="new"><br>
        <input type="submit" value="create entry">
    </form>
    </body>
</html>