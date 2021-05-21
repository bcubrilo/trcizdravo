<?php defined('C5_EXECUTE') or die("Access Denied."); ?>
<!DOCTYPE html>
<html lang="<?php echo 'sr' /* Localization::activeLanguage()*/ ?>">
<head>
    <link href="https://fonts.googleapis.com/css?family=Lemonada" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset='utf-8'>

    <?php echo $html->css($view->getStylesheet('main.less')) ?>
    <?php
        $homePage = Page::getByID(HOME_CID);
        $nh = Core::make('helper/navigation');
        $homePageUrl = $nh->getLinkToCollection($homePage);

        $c = Page::getCurrentPage();
        $thumbnail = $c->getAttribute('thumbnail');
        $thumbnailSrc ='';
        $ih = Core::make('helper/image');
        $th = Loader::helper('text');

    if($thumbnail){
        $thumbnailImage = $ih->getThumbnail($thumbnail,200,100,true);
        if($thumbnailImage){
            $thumbnailSrc = $thumbnailImage->src;
        }
    }

    View::element('header_required', [
        'pageTitle' => isset($pageTitle) ? $pageTitle : '',
        'pageDescription' => isset($pageDescription) ? $pageDescription : '',
        'pageMetaKeywords' => isset($pageMetaKeywords) ? $pageMetaKeywords : ''
    ]);

    ?>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="imagetoolbar" content="no" />
    <link rel='shortcut icon' type='image/x-icon' href='<?php echo $this->getThemePath();?>/assets/favicon.ico'/>

    <script>
        if (navigator.userAgent.match(/IEMobile\/10\.0/)) {
            var msViewportStyle = document.createElement('style');
            msViewportStyle.appendChild(
                document.createTextNode(
                    '@-ms-viewport{width:auto!important}'
                )
            );
            document.querySelector('head').appendChild(msViewportStyle);
        }
    </script>

    <script src="<?php echo $this->getThemePath();?>/js/html5shiv.min.js"></script>
    <script src="<?php echo $this->getThemePath();?>/js/respond.min.js"></script>

        <script type="application/ld+json">
            {
                "@context": "http://schema.org",
                "@type": "NewsArticle",
                "headline": "<?php echo $th->entities($c->getCollectionName());?>",
                "image": [
                    "<?php echo $thumbnailSrc;?>"

                ]
            }
        </script>


</head>

<body class="novaklasa">
<?php
$user = new User();
if(!$user->isLoggedIn()){
?>
<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-96195546-1', 'auto');
    ga('send', 'pageview');

</script>
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = 'https://connect.facebook.net/sr_RS/sdk.js#xfbml=1&version=v2.11';
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>
<?php }?>
<div class="<?php echo $c->getPageWrapperClass()?>">


    <a class="scrollToTop" href="#"><i class="fa fa-angle-up"></i></a>
    <div class="container">
        <header id="header">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="header_top">
                        <div class="header_top_left">
                            <ul class="top_nav">
                                <li><a href="<?php echo $homePageUrl;?>">Početna</a></li>
                                <li><a  target="_blank" href="https://www.treningplan.trcizdravo.com">Trening Plan</a></li>
                            </ul>
                        </div>
                        <div class="header_top_right">
                            <p><?php echo date('d.M.Y');?></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="header_bottom" style="overflow: hidden">
                        <div class="logo_area" style="display: inline-block;">
                            <a href="<?php echo $homePageUrl;?>" class="logo">
                                <img style="max-width: 150px;width: 100%;height:auto;" src="<?php echo $this->getThemePath();?>/assets/trci-zdravo-logo.png"/>
<!--                                <h1>TRČI<span style="color: #d083cf;">ZDRAVO</span></h1>-->
                            </a>

                        </div>
                        <div style="display: inline-block;overflow: hidden">
                            <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                            <!-- Oglas Heder leaderboard -->
                            <ins class="adsbygoogle"
                                 style="display:inline-block;width:728px;height:90px"
                                 data-ad-client="ca-pub-8787290704403325"
                                 data-ad-slot="1337133338"></ins>
                            <script>
                                (adsbygoogle = window.adsbygoogle || []).push({});
                            </script>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <?php
                    $a = new GlobalArea('Header');
                    $a->display($c);
                    ?>
                </div>
            </div>

        </header>
        <section id="navArea">
            <nav class="navbar navbar-inverse" role="navigation">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <?php
                    $a = new GlobalArea('Navigation');
                    $a->display($c);
                    ?>
                </div>
            </nav>
        </section>
    </div>