<nav id="main-nav" class="nav row">
    <form class="form-inline" id="searchThrough" action="<? $root; ?>/search" method="POST">
        <input type="text" class="form-control" placeholder="Rechercher un livre, un auteur, un thème..." name="search_query"/>
    </form>
    <div class="col-md-5 nav_left">
        <ul class="row">
            <li class="col-md-4">
                <a href="<?= $root; ?>/home" <?= ($_GET["p"] === "home") ? 'class="active"' : ''; ?>>Accueil</a>
            </li>
            <li class="col-md-4">
                <a href="<?= $root; ?>/discover" <?= ($_GET["p"] === "discover") ? 'class="active"' : ''; ?>>Découvrir</a>
            </li>
            <li class="col-md-4">
                <a href="<?= $root; ?>/salons" <?= ($_GET["p"] === "salons") ? 'class="active"' : ''; ?>>Salons</a>
            </li>

        </ul>
    </div>
    <div class="col-md-2 nav_center">
        <a href="<?= $root; ?>/home"><img src="<?= $root; ?>/view/assets/img/logo.png" /></a>
    </div>
    <div class="col-md-5 nav_right">
        <ul class="row">
            <li class="col-md-4">
                <a href="<?= $root; ?>/contact" <?= ($_GET["p"] === "contact") ? 'class="active"' : ''; ?>>Contact</a>
            </li>
            <li class="col-md-6 dropdown align-center">
            <?php if(isset($curr_user)){
                ?>
                <div class="dropdown-me">
                    <a href="<?= $root.'/user/'.$curr_user['id'].'/edit'; ?>">Éditer le profil</a>
                    <?= ($curr_user['isAdmin']) ? '<a href="'.$root.'/admin">Admin</a>' : ""; ?> 
                </div>
            <?php
            }
                if(!isset($_SESSION['loggedin'])){
            ?>
                <a href="<?= $root.'/login'?>" <?= ($_GET["p"] === "login") ? 'class="active"' : ''; ?>>Compte</a>
            <?php
                }else{
            ?>

                <a href="<?= $root.'/user/'.$curr_user['id']; ?>" <?= ($_GET["p"] === "user" && $_GET['id'] === $curr_user['id']) ? 'class="active"' : ''; ?>> <?= $curr_user['username']; ?></a>
                | <a href="<?= $root; ?>/processes/logout">b</a>
            <?php
                }
            ?>

            </li>
            <li class="col-md-2">
                <a href="#" class="icon-search"></a>
            </li>
        </ul>
    </div>
</nav>

<nav id="secondary-nav" class="nav">
    <div class="nav_left">

        <h2 class="small_title">Nous Rejoindre</h2>

        <form class="form-inline" action="<?= $root; ?>/processes/newuser" method="post">
            <input class="form-control" name="email" type="text" placeholder="email">
            <button type="submit" class="btn btn-primary sm">Envoi</button>
        </form>

    </div>
    <div class="nav_right">
        <h2 class="small_title">Prochain salon</h2>
        <p> 
            <?php 
                $nextSalon = $salons->getNextSalon();
                $salonBook = $salons->getWorkOfSalon($nextSalon["work_id"]); 
                $salonBookType = $works->getBookType($salonBook['id'])['name'];
                $salonBookCat = $works->getBookCat($salonBook['id'])['name'];

                ?>
            <?= date( 'l jS F \à H\hi', strtotime( $nextSalon['date'] )); ?> <br/>
            <a href="<?= $root . '/discover/'.$salonBookType.'/'.$salonBookCat.'/'.$salonBook['id']; ?>"><?= $salonBook['name']; ?> </a> de <?= $salonBook['author']; ?>
        </p>
        <a class="btn btn-primary" href="<?= $root; ?>/salons/<?= $nextSalon['id']; ?>">Participer</a>
    </div>
</nav>