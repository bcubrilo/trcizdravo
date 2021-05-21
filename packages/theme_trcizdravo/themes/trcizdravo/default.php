<?php
defined('C5_EXECUTE') or die("Access Denied.");

$this->inc('elements/header.php');
?>

    <div class="container">

        <section id="contentSection">
            <?php
            $a = new Area('Main');
            $a->display($c);
            ?>
        </section>


    </div>
<?php
$this->inc('elements/footer.php');
