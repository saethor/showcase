<?php

// Random image generator. Currently not working because of cache problem

// Array containinc the images
$heroImages = ['hero1', 'hero2', 'hero3'];

// Checks if random image have been generated before
if(isset($_SESSION['lastUsedHero'])) {

    $last = $_SESSION['lastUsedHero'];
    $selected;

    do {

        $selected = $heroImages[(rand(0, (count($heroImages) - 1) ))];

    } while ($selected == $last);

}
else {
    $selected = $heroImages[0];
}

$_SESSION['lastUsedHero'] = $selected;


?>


<main class="hero" style="background: url(<?php echo $path . 'assets/images/' . $selected . '.jpg'; ?>) no-repeat center center fixed;">
    <div class="container">

        <div class="hero-title">
            <h1><?php echo $heroTitle; ?></h1>
        </div>


        <div class="hero-footer">

            <div class="social-icons">
                <a href="https://facebook.com/saethor94" target="_blank" class="social-icon">
                    <i class="fa fa-facebook"></i>
                </a>
                <a href="https://twitter.com/saethor94" target="_blank" class="social-icon">
                    <i class="fa fa-twitter"></i>
                </a>
                <a href="https://plus.google.com/u/0/+S%C3%A6%C3%BE%C3%B3rHallgr%C3%ADmsson/" target="_blank" class="social-icon">
                    <i class="fa fa-google-plus"></i>
                </a>
                <a href="https://github.com/saethor" target="_blank" class="social-icon">
                    <i class="fa fa-github"></i>
                </a>
            </div>

            <div class="scroll">
                <a href="#section-album"><i class="fa fa-angle-double-down"></i></a>
            </div>

        </div>

    </div>
</main>
<!-- /.Hero -->
