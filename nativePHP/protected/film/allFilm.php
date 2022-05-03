<?php $sql  = 'select filmek.id, cim, hossz, borito , name as kategoria
FROM filmek, kategoria 
WHERE kategoria.id = filmek.kategoria 
order by cim desc';
$result = classList($sql);
 if($result === NULL || empty($result)): ?>
    <p>Nincs rekord</p>
    <?php else: ?>
	<head>
    <link rel="stylesheet" href="<?php echo PUBLIC_DIR."style.css";?>">
    </head>
    <body>
        <div class = "usersDiv">
            <h2>Filmek:</h2>
            <table class="table">
            <form method="post">
            <thead>
                <tr>
                <th>Borító</th>
                <th>Cím</th>
                <th>Hossz(perc)</th>
                <th>Kategória</th>
                <th> Láttam </th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($result as $row): $n=$n+1?>
                <tr>
                <td><img src="<?=$row['borito']?>" width="300" height="150" alt="cover picture"></td>
                <td><?=$row['cim']?></td>
                <td><?=$row['hossz']?></td>
                <td><?=$row['kategoria']?></td>
                <td> <input type='checkbox' value = <?=$row["id"]?>> </td>
                </tr>
            <?php endforeach;?>
            </tbody>
            </form>
            </table>
        </div>
    </body>
	<?php endif; ?>
