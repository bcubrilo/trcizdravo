<?php
$nh = Core::make('helper/navigation');
$ih = Core::make('helper/image');
$currentPage = Page::getCurrentPage();



$currentPageUrl = $nh->getLinkToCollection($currentPage);
$type = false;
try{
  $type = \Concrete\Core\File\Image\Thumbnail\Type\Type::getByHandle('thumbnail_500_300');
}catch (Exception $ex){}

if($odabranaZanimljivost == null){
    $odabranaZanimljivost = $zanimljivosti[0];
}
$minZanimljivostId = 0;
?>

<div class="zanimljivosti-wrapper">
    <?php if ($odabranaZanimljivost){ ?>
    <div class="row">
        <?php
        $zanimljivost = $odabranaZanimljivost;
        $imgSrc = '';
        try{
          if ($zanimljivost->getZanimljivostSlika()) {
            $thumb = $ih->getThumbnail($zanimljivost->getZanimljivostSlika(), 600, 400, true);
            if ($thumb) {
              $imgSrc = $thumb->src;
            }
          }
        }catch (Exception $ex){}

        $naslov = $zanimljivost->getZanimljivostNaslov();
        $url = $currentPageUrl . '/' . $zanimljivost->getID();
        $sadrzaj = $zanimljivost->getZanimljivostSadrzaj();
        ?>
        <div class="col-md-8 ">
            <div class="animated fadeIn">
            <div class="block-wrapper box-shadow-wrapper"
                 id="zanimljivosti-<?php echo $odabranaZanimljivost->getID(); ?>" style="max-width: 600px;"
            >
                <div class="link-wrapper">
                    <a href="<?php echo $currentPageUrl . '/' . $zanimljivost->getID(); ?>">
                        <h4><?php echo $zanimljivost->getZanimljivostNaslov(); ?></h4>
                    </a>
                </div>
                <div class="image-wrapper">
                    <img src="<?php echo $imgSrc; ?>"/>

                </div>
                <div style="text-align: center;">
                    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                    <ins class="adsbygoogle"
                         style="display:block"
                         data-ad-format="fluid"
                         data-ad-layout-key="-fg+5r+6l-ft+4e"
                         data-ad-client="ca-pub-8787290704403325"
                         data-ad-slot="5130253704"></ins>
                    <script>
                        (adsbygoogle = window.adsbygoogle || []).push({});
                    </script>
                </div>
                <div class="text-block-wrapper">
                    <?php echo Concrete\Core\Editor\LinkAbstractor::translateFrom($zanimljivost->getZanimljivostSadrzaj()); ?>

                </div>
                <div class="share-block-wrapper">
                    <ul class="sociallink_nav">
                        <li>
                            <a onClick="window.open('http://www.facebook.com/sharer.php?s=100&amp;p[title]=<?php echo urlencode($naslov); ?>&amp;p[summary]=<?php echo urlencode($sadrzaj); ?>&amp;p[url]=<?php echo urlencode($url); ?>&amp;p[images][0]=<?php echo urlencode($imgSrc); ?>','sharer','toolbar=0,status=0,width=548,height=325');"
                               href="javascript: void(0)">
                                <i class="fa fa-facebook"></i>
                            </a>
                        </li>
                        <li>
                            <a href="https://twitter.com/intent/tweet?original_referer=<?php echo urlencode($url); ?>&ref_src=twsrc%5Etfw&text=<?php echo urlencode($naslov); ?>&tw_p=tweetbutton&url=<?php echo urlencode($url); ?>"
                               class="twitter-share-button" data-show-count="false">
                                <i class="fa fa-twitter"></i>
                            </a>

                        </li>
                    </ul>
                </div>
            </div>

        </div>

        </div>
        <div class="col-md-4 " style="margin: auto;padding-top: 20px;min-height: 300px;">



                <div>
                    <div id="fb-root"></div>
                    <script>(function(d, s, id) {
                            var js, fjs = d.getElementsByTagName(s)[0];
                            if (d.getElementById(id)) return;
                            js = d.createElement(s); js.id = id;
                            js.src = "//connect.facebook.net/sr_RS/sdk.js#xfbml=1&version=v2.10";
                            fjs.parentNode.insertBefore(js, fjs);
                        }(document, 'script', 'facebook-jssdk'));</script>
                    <div class="fb-page" data-href="https://www.facebook.com/trciZdravoStranica/" data-tabs="timeline" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/trciZdravoStranica/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/trciZdravoStranica/">Trči Zdravo</a></blockquote></div>
                </div>
            <div class="googleadd-article" style="text-align: center;min-height:70px;padding-top: 20px;">
                <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                <ins class="adsbygoogle"
                     style="display:block; text-align:center;"
                     data-ad-layout="in-article"
                     data-ad-format="fluid"
                     data-ad-client="ca-pub-8787290704403325"
                     data-ad-slot="1371567592"></ins>
                <script>
                    (adsbygoogle = window.adsbygoogle || []).push({});
                </script>
            </div>


        </div>


    </div>


    <?php

    }?>
    <div class="lista-zanimljivosti">
            <?php if (count($zanimljivosti) > 0){
            $counter = 0;
            //PRVI RED
            foreach ($zanimljivosti as $zanimljivost) {
                $minZanimljivostId = $zanimljivost->getID();
                if ($odabranaZanimljivost && $odabranaZanimljivost->getID() == $zanimljivost->getID()) {
                    continue;
                }
                $imgSrc = '';
                if ($zanimljivost->getZanimljivostSlika()) {
                    $imgSrc = $zanimljivost->getZanimljivostSlika()->getThumbnailURL($type->getBaseVersion());
//            $thumb = $ih->getThumbnail($zanimljivost->getZanimljivostSlika(),500,300,true);
//            if($thumb){
//                $imgSrc = $thumb->src;
//            }
                }
                $naslov = $zanimljivost->getZanimljivostNaslov();
                $url = $currentPageUrl . '/' . $zanimljivost->getID();
                $sadrzaj = $zanimljivost->getZanimljivostSadrzaj();
                ?>
                <div class="zanimljivost animated fadeIn">
                <div class="block-wrapper box-shadow-wrapper "
                         id="zanimljivosti-<?php echo $zanimljivost->getID(); ?>">
                        <div class="link-wrapper">
                            <a href="<?php echo $currentPageUrl . '/' . $zanimljivost->getID(); ?>">
                                <h4><?php echo $zanimljivost->getZanimljivostNaslov(); ?></h4>
                            </a>
                        </div>
                        <?php if (strlen($imgSrc) > 0) { ?>
                            <div class="image-wrapper">
                                <!--                <div class="thumbnail">-->
                                <img src="<?php echo $imgSrc; ?>" width="<?php echo $type->getWidth(); ?>"
                                     height="<?php echo $type->getHeight(); ?>"/>
                                <!--                </div>-->

                            </div>
                        <?php } ?>

                        <?php if (strlen($sadrzaj) > 0) { ?>
                            <div class="text-block-wrapper">
                                <p>
                                    <?php echo Concrete\Core\Editor\LinkAbstractor::translateFrom($zanimljivost->getZanimljivostSadrzaj()); ?>
                                </p>
                            </div>
                        <?php } ?>
                        <div class="share-block-wrapper">
                            <ul class="sociallink_nav">
                                <li>
                                    <a onClick="window.open('http://www.facebook.com/sharer.php?s=100&amp;p[title]=<?php echo urlencode($naslov); ?>&amp;p[summary]=<?php echo urlencode($sadrzaj); ?>&amp;p[url]=<?php echo urlencode($url); ?>&amp;p[images][0]=<?php echo urlencode($imgSrc); ?>','sharer','toolbar=0,status=0,width=548,height=325');"
                                       href="javascript: void(0)">
                                        <i class="fa fa-facebook"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://twitter.com/intent/tweet?original_referer=<?php echo urlencode($url); ?>&ref_src=twsrc%5Etfw&text=<?php echo urlencode($naslov); ?>&tw_p=tweetbutton&url=<?php echo urlencode($url); ?>"
                                       class="twitter-share-button" data-show-count="false">
                                        <i class="fa fa-twitter"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <?php
            } ?>

        <?php }
        ?>
        <div class="col-md-6 googlereklama">
            <div class="" style="min-width: 300px;min-height: 200px;">
                <div style="margin:10px;">
                    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                    <ins class="adsbygoogle"
                         style="display:block"
                         data-ad-format="fluid"
                         data-ad-layout-key="-8i+1w-dq+e9+ft"
                         data-ad-client="ca-pub-8787290704403325"
                         data-ad-slot="1199498586"></ins>
                    <script>
                        (adsbygoogle = window.adsbygoogle || []).push({});
                    </script>
                </div>
            </div>
        </div>
</div>

    <script>
        (function(){

            $(window).scroll(function(){
                console.log($(window).scrollTop() );
                console.log($('.lista-zanimljivosti').outerHeight());
                console.log( $('.lista-zanimljivosti').offset().top);
                console.log('----------------');
                if( $(window).scrollTop()>= $('.lista-zanimljivosti').outerHeight() + $('.lista-zanimljivosti').offset().top*0.55)
                {
                    console.log('jgjgjgj');
                    ucitajZanimljivosti();
                }
            });
            var minZanimljivostId = <?php echo $minZanimljivostId;?>;
            var cekamOdgovor = false;
            var $reklame = $('.googlereklama').first().clone();
            var ucitajZanimljivosti = function(){
                if(cekamOdgovor){
                    return;
                }
                cekamOdgovor = true;
                $.ajax('<?php echo URL::to('ucitajZanimljivosti')?>/'+minZanimljivostId, {

                    success: function(data) {
                        if(data){
                            for(var i =0; i<data.zanimljivosti.length; i++){
                                var zanimljivost = data.zanimljivosti[i];
                                var sadrzaj = zanimljivost.sadrzaj;
                                if(sadrzaj){
                                    console.log(sadrzaj);
                                    try{
                                        sadrzaj = zanimljivost.sadrzaj;
                                    }catch(err){
                                        console.log(err.message);
                                    }
                                }
                                var sadrzajPreview = zanimljivost.sadrzaj.length > 50 ? zanimljivost.sadrzaj.substring(0,50): zanimljivost.sadrzaj;
                                minZanimljivostId = zanimljivost.id < minZanimljivostId ? zanimljivost.id : minZanimljivostId;
                                console.log(zanimljivost.slikaSrc);
                                $('.lista-zanimljivosti').append(
                                    $('<div class="zanimljivost animated fadeIn">')
                                        .append(
                                            $('<div class="block-wrapper box-shadow-wrapper " id="zanimljivosti-"'+zanimljivost.id+'">')
                                                .append($('<div class="link-wrapper">').append($('<a href="'+zanimljivost.url+'">').append('<h4>'+zanimljivost.naslov+'</h4>')))
                                                .append($('<div class="image-wrapper">').append('<img src="'+zanimljivost.slikaSrc+'"/>'))
                                                .append('<div class="text-block-wrapper">'+sadrzaj+'</div>')
                                                .append($('<div class="share-block-wrapper">')
                                                    .append($('<ul class="sociallink_nav">')
                                                        .append('<li>\n' +
                                                            '                            <a onclick="window.open(\'http://www.facebook.com/sharer.php?s=100&amp;p[title]='+zanimljivost.naslov+'&amp;'+encodeURIComponent(sadrzajPreview)+'&amp;p[url]='+zanimljivost.url+'&amp;p[images][0]='+zanimljivost.slikaSrc+',\'sharer\',\'toolbar=0,status=0,width=548,height=325\');" href="javascript: void(0)">' +
                                                            '                                <i class="fa fa-facebook"></i>\n' +
                                                            '                            </a>\n' +
                                                            '                        </li>')
                                                        .append('<li>\n' +
                                                            '                            <a href="https://twitter.com/intent/tweet?original_referer='+zanimljivost.url+'&amp;ref_src=twsrc'+zanimljivost.naslov+'&amp;tw_p=tweetbutton&amp;url='+zanimljivost.url+'" class="twitter-share-button" data-show-count="false">\n' +
                                                            '                                <i class="fa fa-twitter"></i>\n' +
                                                            '                            </a>\n' +
                                                            '                        </li>')
                                                    )
                                                )
                                        )

                                );

                            }

                        }
                        cekamOdgovor = false;
                    },
                    error: function() {
                        cekamOdgovor = false;
                        console.log('Not working');
                    }
                });
            };
        })();
    </script>
<!--    <script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>-->
<!--    <script>-->
<!--        $(document).ready(function(){-->
<!--            $('.lista-zanimljivosti').masonry({-->
<!--                // options-->
<!--                itemSelector: '.zanimljivost',-->
<!--                columnWidth: 400-->
<!--            });-->
<!--        });-->
<!--    </script>-->
<style>

    .block-wrapper {
        max-width: 500px;
        margin-left: auto;
        margin-right: auto;
        margin-top: 20px;
    }

    .block-wrapper .image-wrapper img {
        width: 100%;
        height: auto;
    }

    .block-wrapper .link-wrapper {
        padding: 10px 10px 10px 10px;
    }

    .block-wrapper .link-wrapper h4 {
        font-family: 'Lemonada', cursive;
        color: #5f4d93;
        font-weight: 700;
    }

    .block-wrapper .share-block-wrapper {
        padding: 10px 10px 10px 10px;
    }

    .text-block-wrapper {
        width: 100%;
        overflow: hidden;
        padding: 10px 10px 10px 10px;
    }
    .text-block-wrapper ul li{
        padding-left:1em;
        text-indent: -.7em;
    }
    .text-block-wrapper ul li:before{
        content: " - ";

    }
    .zanimljivosti-wrapper {
        margin-bottom: 30px;
        margin-top: 30px;

    }
    .lista-zanimljivosti{
        -webkit-column-count: 2;
        -moz-column-count: 2;
        column-count: 2;
        -webkit-column-gap: 1.25rem;
        -moz-column-gap: 1.25rem;
        column-gap: 1.25rem;
    }
    .zanimljivost{
        display: inline-block;
        width: 100%;
        margin-bottom: .75rem;
    }
    @media(max-width: 968px) {
        .lista-zanimljivosti{
            -webkit-column-count: 1;
            -moz-column-count: 1;
            column-count: 1;
        }
    }
    @media(min-width: 968px) {
        .zanimljivost-reklama{
            display: none;
        }
    }


</style>

