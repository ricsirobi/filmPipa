<HTMl>

<HEAD>
    <link rel="stylesheet" href="<?php echo PUBLIC_DIR . "login_register.css"; ?>">
    <link rel="stylesheet" href="../../public/style.css">

    <style>
        .oDiv .oForm {
            padding-top: 130px;
            color: #F0F0F0;
        }
    </style>
</HEAD>

<BODY>

    <div class="simple-container">
        <form method="POST">
            <h2>Keresés</h2>

            <div class="row">
                <td><input type="radio" name="searchfor" value="film" checked>Fim</td>
                <td><input type="radio" name="searchfor" value="series">Sorozat</td>
            </div>
            <div class="row">
                <div class="col-md-12 form-group">
                    <input type="text" class="form-control" placeholder="Cím" name="search_title">
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 form-group">
                    <?php
                    $sql = "select * from kategoria";
                    $result = classList($sql);
                    ?>
                    <select name="search_category" id="category">

                        <option value="" selected disabled>Kategória</option>
                        <?php foreach ($result as $row) : $n = $n + 1 ?>
                            <option value="<?= $row["id"] ?>"><?= $row["name"] ?></option>
                        <?php endforeach; ?>
                    </select> (Ha nincs kiválasztva akkor minden kategóriában keres)
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 form-group">
                    <input type="submit" class="btn btn-block btn-login" name="searchBtn" value="Keres">
                </div>
            </div>
        </form>
    </div>

</BODY>

</HTML>
<?php

if (isset($_POST["searchBtn"])) {

    $filmorseries = $_POST["searchfor"];
    $title = $_POST["search_title"];
    $category = $_POST["search_category"];

    if ($category == "") {
        $add = "";
    } else {
        $add = "and kategoria = $category";
        $selectcategoyname = "select * from kategoria where id = $category";
        $result = classList($selectcategoyname);
        $categoryname = $result[0]["name"];
    }

    if ($filmorseries == "film") {

        $sql = "select filmek.id, cim, hossz, borito , name as kategoria
        FROM filmek, kategoria 
        WHERE kategoria.id = filmek.kategoria   and cim like \"%$title%\" $add
        order by cim desc";
        $result = classList($sql);
        if ($result === NULL || empty($result)) : ?>
            <p>Nincs találat</p>
        <?php else : ?>
        
            <head>
                <link rel="stylesheet" href="<?php echo PUBLIC_DIR . "style.css"; ?>">
            </head>

            <body>
                <form action="index.php?P=seeAllFilm" method="post">
                <div class="usersDiv">
                    <h2><?php echo "Film találatok: $categoryname/$title";?><br><input type="submit" name="saveSaw" value="Mentés"></h2>
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
                                <?php foreach ($result as $row) : $n = $n + 1 ?>
                                    <tr>
                                        <td><img src="<?= $row['borito'] ?>" width="300" height="150" alt="cover picture"></td>
                                        <td><?= $row['cim'] ?></td>
                                        <td><?= $row['hossz'] ?></td>
                                        <td><?= $row['kategoria'] ?></td>
                                        <td> <input type='checkbox' name=<?= $row["id"] ?> value=<?= $row["id"] ?>> </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </form>
                    </table>
                </div>
            </body>
        <?php endif;
        






    } else {
        $sql = "select sorozatok.id, cim,evad,resz, borito , name as kategoria
        FROM sorozatok, kategoria 
        WHERE kategoria.id = sorozatok.kategoria and cim like \"%$title%\" $add 
        order by cim desc";
        $result = classList($sql);
        if ($result === NULL || empty($result)) : ?>
            <p>Nincs találat</p>
        <?php else : ?>

            <head>
                <link rel="stylesheet" href="<?php echo PUBLIC_DIR . "style.css"; ?>">
            </head>

            <body>
                <div class="usersDiv">
                    <h2><?php echo "Sorozat találatok: $categoryname/$title";?></h2>
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
                                            <a class="nav-link dropdown-toggle" href="index.php?P=seeEpisodes&evad=<?= $row["evad"] ?>&sid=<?= $row["id"] ?>&title=<?= $row["cim"] ?>" id="navbarDropdownMenuLink" aria-haspopup="true"> Megtekintés</a>
                                        </td>

                                    </tr>
                                <?php endforeach; ?>

                            </tbody>
                        </form>
                    </table>
                </div>
            </body>
<?php endif;
    }
}
?>