<nav id="main-nav" class="nav">
    <form class="form-inline <?= (isset($_GET['p']) && $_GET['p'] === 'search') ? ' active' : ''; ?>" id="searchThrough" action="<?= $root; ?>/search" method="POST">
        <input type="text" class="form-control" placeholder="Rechercher un livre, un auteur, un thème..." name="search_query"/>
    </form>
    <button class="responsiveMenu icon-bars"></button>
    <div class="col-md-2 nav_center">
        <a href="<?= $root; ?>/home"><img src="<?= $root; ?>/view/assets/img/logo.png" /></a>
    </div>
    <div class="responsiveListLinks row">
        <div class="col-md-5 col-sm-12 nav_left">
            <ul class="row">
                <li class="col-md-4 col-sm-12">
                    <a href="<?= $root; ?>/home" <?= (!isset($_GET['cat']) && $_GET["p"] === "home") ? 'class="active"' : ''; ?>>Accueil</a>
                </li>
                <li class="col-md-4 col-sm-12">
                    <a href="<?= $root; ?>/discover" <?= (!isset($_GET['cat']) && $_GET["p"] === "discover") ? 'class="active"' : ''; ?>>Découvrir</a>
                </li>
                <li class="col-md-4 col-sm-12">
                    <a href="<?= $root; ?>/salons" <?= (!isset($_GET['cat']) && $_GET["p"] === "salons") ? 'class="active"' : ''; ?>>Salons</a>
                </li>

            </ul>
        </div>
        <div class="col-md-5 col-sm-12 nav_right col-md-offset-2">
            <ul class="row">
                <li class="col-md-4 col-sm-12">
                    <a href="<?= $root; ?>/contact" <?= (!isset($_GET['cat']) && $_GET["p"] === "contact") ? 'class="active"' : ''; ?>>Contact</a>
                </li>
                <li class="col-md-6 col-sm-12 dropdown align-center">
                <?php if(isset($curr_user)){
                    ?>
                    <div class="dropdown-me">
                        <a href="<?= $root.'/user/'.$curr_user['id'].'/edit'; ?>">Éditer le profil</a>
                        <a href="<?= $root.'/user/'.$curr_user['id'].'/messages'; ?>">Messages <?= count($unreads) > 0 ? ' <span class="tag unreadTag">'.count($unreads).' non-lu</span>' : ''; ?></a>
                        <?php if(intval($curr_user['isAdmin']) == 1){
                        ?>
                        <a href="<?= $root; ?>/admin">Admin <?= (count($unreadsAdmin) > 0) ? ' <span class="tag unreadTag">'.count($unreadsAdmin).' non-lu</span>' : ''; ?></a>
                        <?php
                        } ?>
                    </div>
                <?php
                }
                    if(!isset($_SESSION['loggedin'])){
                ?>
                    <a href="<?= $root.'/login'?>" <?= ($_GET["p"] === "login") ? 'class="active"' : ''; ?>>Compte</a>
                <?php
                    }else{
                ?>

                    <a href="<?= $root.'/user/'.$curr_user['id']; ?>" <?= ($_GET["p"] === "user" && $_GET['id'] === $curr_user['id']) ? 'class="active"' : ''; ?>> <?= $curr_user['username']; ?><?= (count($unreads) > 0 || ( isset($unreadsAdmin) && count($unreadsAdmin) > 0)) ? ' <span class="unreadNotif icon-mail"></span>' : ''; ?></a>
                    | <a href="<?= $root; ?>/processes/logout" class="logout icon-locker-streamline-unlock"></a>
                <?php
                    }
                ?>

                </li>
            </ul>
        </div>
        <button class="responsiveMenuClose icon-x"></button>
    </div>
    <a href="#" id="searchbar" class="<?= (isset($_GET['p']) && $_GET['p'] === 'search') ? 'icon-x' : 'icon-search'; ?>"></a>
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
                if($nextSalon){
                $salonBook = $salons->getWorkOfSalon($nextSalon["work_id"]); 
                $salonBookType = $works->getBookType($salonBook['id'])['name'];
                $salonBookCat = $works->getBookCat($salonBook['id'])['name'];

                ?>
            <?= date( 'l jS F \à H\hi', strtotime( $nextSalon['date'] )); ?> <br/>
            <a href="<?= $root . '/discover/'.$salonBookType.'/'.$salonBookCat.'/'.$salonBook['id']; ?>"><?= $salonBook['name']; ?> </a> de <?= $salonBook['author']; ?><?php } ?>
        </p>
        <a class="btn btn-primary" href="<?= $root; ?>/salons/<?= $nextSalon['id']; ?>">Participer</a>
    </div>
</nav>