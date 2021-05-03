<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
    <h1>Read Entries</h1>
    <table>
        <tr>
        <th>ID</th>
        <th>Entry</th>
        </tr>
        <?php foreach($results as $r){
            echo "<tr><td>{$r['id']}</td><td>{$r['entry']}</td>";?>
            <td><p><a href="index.php?action=update&id=<?php echo $r['id']?>">update</a></p></td>
            <td><p><a href="index.php?action=delete&id=<?php echo $r['id']?>">delete</a></p></td>
        <?php echo "</tr>";
        } ?>
    </table>
    </body>
</html>