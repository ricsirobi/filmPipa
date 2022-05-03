<?php $sql  = 'select sorozatok.id, cim,evad,resz, borito , name as kategoria
FROM sorozatok, kategoria 
WHERE kategoria.id = sorozatok.kategoria 
order by cim desc';
$result = classList($sql);
if ($result === NULL || empty($result)) : ?>
    <p>Nincs rekord</p>
<?php else : ?>

    <head>
        <link rel="stylesheet" href="<?php echo PUBLIC_DIR . "style.css"; ?>">
    </head>
    <body>
        <div class="usersDiv">
            <h2>Sorozatok:</h2>
            <table class="table">
                <form method="post">
                    <thead>
                        <tr>
                            <th>Borító</th>
                            <th>Cím</th>
                            <th>Évad</th>
                            <th>Epizódok száma</th>
                            <th> Kategória </th>
                            <th> Megtekintés </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($result as $row) : $n = $n + 1 ?>
                            <tr>
                                <td><img src="<?= $row['borito'] ?>" width="300" height="150" alt="cover picture"></td>
                                <td><?= $row['cim'] ?></td>
                                <td><?= $row['evad'] ?></td>
                                <td><?= $row['resz'] ?></td>
                                <td><?= $row['kategoria'] ?></td>
                                <td>
                                    <a class="nav-link dropdown-toggle" href="index.php?P=seeEpisodes&evad=<?=$row["evad"]?>&sid=<?=$row["id"]?>&title=<?=$row["cim"]?>" id="navbarDropdownMenuLink" aria-haspopup="true" > Megtekintés</a>
                                </td>

                            </tr>
                        <?php endforeach; ?>

                    </tbody>
                </form>
            </table>
        </div>
    </body>
<?php endif; ?>