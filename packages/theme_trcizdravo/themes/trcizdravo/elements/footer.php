<?php defined('C5_EXECUTE') or die("Access Denied.");
?>
<div class="container">

    <footer id="footer">
        <div class="footer_top">
            <div class="row">

                <div class="col-lg-4 col-md-4 col-sm-4">
                    <div class="footer_widget wow fadeInDown animated" style="visibility: visible; animation-name: fadeInDown;">
                        <h2>Meni</h2>
                        <ul class="tag_nav">
                            <li><a href="https://www.trcizdravo.com/kalkulator_kalorija">Kalkulator kalorija</a></li>
                            <li><a href="https://www.trcizdravo.com/kalkulator-trcanja">Kalkulator trčanja</a></li>
                            <li><a target="_blank" href="https://www.treningplan.trcizdravo.com">Trening plan</a></li>

                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <div class="footer_widget wow fadeInRightBig animated" style="visibility: visible; animation-name: fadeInRightBig;">
                        <h2>Kontakt</h2>
                        <h5>administrator@trcizdravo.com</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer_bottom">
            <p class="copyright">Copyright © <?php echo date('Y');?></p>
            <div style="float: right;">

                <?php
                    $a = new GlobalArea('Footer Social');
                    $a->display($c);
                ?>
            </div>
        </div>
    </footer>
</div>

</div>

<script src="<?php echo $this->getThemePath();?>/js/main.js"></script>
<?php View::element('footer_required'); ?>

</body>
</html>
