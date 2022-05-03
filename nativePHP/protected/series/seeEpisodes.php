<?php
if (isset($_GET["sid"]) && isset($_GET["evad"])&& isset($_GET["title"]) )

$sql  = 'select resz.id, resz.reszSzam ,resz.cim , resz.hossz from resz, sorozatok where sorozatid = '.$_GET["sid"] . ' group by cim order by reszSzam';
$result = classList($sql);
if ($result === NULL || empty($result)) : ?>
    <p>Nincs rekord</p>
<?php else : ?>

    <head>
        <link rel="stylesheet" href="<?php echo PUBLIC_DIR . "style.css"; ?>">
    </head>

    <body>
        <div class="usersDiv">
            <h2><?=$_GET["title"].": ".$_GET["evad"].". évad"?></h2>
            <table class="table">
                <form method="post">
                    <thead>
                        <tr>
                            <th> Rész</th>
                            <th>Cím</th>
                            <th> Láttam </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($result as $row) : $n = $n + 1 ?>
                            <tr>
                                <td><?=$row["reszSzam"]?> </td>
                                <td><?= $row['cim'] ?></td>
                                <td> <input type='checkbox' value = <?=$row["id"]?>> </td>
                            </tr>
                        <?php endforeach; ?>

                    </tbody>
                </form>
            </table>
        </div>
    </body>
<?php endif; ?>