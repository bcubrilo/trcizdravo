<?php
defined('C5_EXECUTE') or die("Access Denied.");

$this->inc('elements/header.php');
?>
    <div class="container">

        <section id="contentSection">
            <div class="row">
                <div class="col-lg-8 col-md-8">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="left_content">
                                <div class="single_page">
                                    <div class="single_page_content">
                                        <?php
                                        $a = new Area('Main');
                                        $a->display($c);
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <?php
                            $a = new GlobalArea('Global Bottom Area');
                            $a->display($c);
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <?php
//                    $mppBlock = BlockType::getByHandle('most_popular_pages');
//                    $mppBlock->render('view');
                    ?>
                    <aside class="right_content">
                        <?php
                        $a = new GlobalArea('Global Right Area');
                        $a->display($c);
                        ?>
                    </aside>
                    <div style="overflow: hidden;width: 100%;">
                        <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                        <!-- Reklama sa desne strane -->
                        <ins class="adsbygoogle"
                             style="display:inline-block;width:300px;height:600px"
                             data-ad-client="ca-pub-8787290704403325"
                             data-ad-slot="8424742290"></ins>
                        <script>
                            (adsbygoogle = window.adsbygoogle || []).push({});
                        </script>
                    </div>
                </div>
            </div>

        </section>


    </div>

<?php
$this->inc('elements/footer.php');
