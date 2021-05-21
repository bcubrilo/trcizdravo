<?php
defined('C5_EXECUTE') or die("Access Denied.");

$this->inc('elements/header.php');

$th = Loader::helper('text');
$dh = Core::make('helper/date');
$nh = Core::make('helper/navigation');
$page = Page::getCurrentPage();
$title = $th->entities($page->getCollectionName());
$date = $dh->formatDate($page->getCollectionDatePublic(), true);
$parentPageId = $page->getCollectionParentID();
$url = ($page->getCollectionPointerExternalLink() != '') ? $page->getCollectionPointerExternalLink() : $nh->getLinkToCollection($page);
$praviUrl = $url;
$parentTitle;
if($parentPageId){
    $parentPage = Page::getByID($parentPageId);
    if($parentPage){
        $parentTitle = $th->entities($parentPage->getCollectionName());
    }
}

$md = new \Mobile_Detect();
$isMobile = $md->isMobile();

$ih = Core::make('helper/image');
$thumbnail = $page->getAttribute('thumbnail');
$thumbnailMobileSrc = '';
$tag;
if($thumbnail){
    if($isMobile){

        $type400300 = \Concrete\Core\File\Image\Thumbnail\Type\Type::getByHandle('thumbnail_400_300');

        $thumbnailMobileSrc = $thumbnail->getThumbnailURL($type400300->getBaseVersion());
    }
    $tag = Core::make('html/image', array($thumbnail, false))->getTag();
    if($tag){
        $tag->addClass('page-thumbnail-image');
    }
}
$description = $page->getCollectionDescription();
$description = $controller->truncateSummaries ? $th->wordSafeShortText($description, $controller->truncateChars) : $description;
$description = $th->entities($description);
$thumbnail = $page->getAttribute('thumbnail');

$pageList = new \Concrete\Core\Page\PageList();
$pageList->filterByParentID($parentPageId);
$pageList->sortByDisplayOrder();

?>
    <div class="container">

        <section id="contentSection">
            <div class="row">
                <div class="col-lg-8 col-md-8">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="left_content">
                                <div class="single_page">
                                    <h1 class="page-title"><?php echo $title;?></h1>
                                    <div class="post_commentbox">
                                        <span><i class="fa fa-calendar"></i><?php echo $date;?></span>
                                        <a href="#"><i class="fa fa-tags"></i><?php echo $parentTitle;?></a>
                                    </div>
                                    <div class="single_page_content">
                                        <div class="page-thumbnail-wrapper">
                                            <?php echo $isMobile ?
                                                "<img src='$thumbnailMobileSrc' class='page-thumbnail-image'/>"
                                                : $tag;

                                            ?>
                                        </div>
                                        <div class="googleadd-article" style="text-align: center;min-height:70px;">
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
                                        <?php
                                        $a = new Area('Main');
                                        $a->display($c);

                                        $a = new GlobalArea('Global Main');
                                        $a->display($c);
                                        ?>

                                    </div>


                                    <?php
                                    $title=urlencode($title);
                                    $url=urlencode($url);
                                    $summary=urlencode($description);
                                    $image=urlencode($tag->src);
                                    ?>
                                    <div class="social_link">
                                        <ul class="sociallink_nav">
                                            <li>
                                                <a onClick="window.open('http://www.facebook.com/sharer.php?s=100&amp;p[title]=<?php echo $title;?>&amp;p[summary]=<?php echo $summary;?>&amp;p[url]=<?php echo $url; ?>&amp;p[images][0]=<?php echo $image;?>','sharer','toolbar=0,status=0,width=548,height=325');" href="javascript: void(0)">
                                                    <i class="fa fa-facebook"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="https://twitter.com/intent/tweet?original_referer=<?php echo $url;?>&ref_src=twsrc%5Etfw&text=<?php echo $title;?>&tw_p=tweetbutton&url=<?php echo $url;?>" class="twitter-share-button" data-show-count="false">
                                                    <i class="fa fa-twitter"></i>
                                                </a>

                                            </li>

                                            <?php
                                            /*

                                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                            <li><a href="#"><i class="fa fa-pinterest"></i></a></li>

                                             */
                                            ?>

                                        </ul>
                                    </div>
                                    <div class="fb-comments" data-href="<?php echo $praviUrl;?>" data-width="500" data-numposts="5"></div>
                                    <div>
                                        <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                                        <ins class="adsbygoogle"
                                             style="display:block; text-align:center;"
                                             data-ad-layout="in-article"
                                             data-ad-format="fluid"
                                             data-ad-client="ca-pub-8787290704403325"
                                             data-ad-slot="8458087215"></ins>
                                        <script>
                                            (adsbygoogle = window.adsbygoogle || []).push({});
                                        </script>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <?php
                                $a = new Area('Page Footer');
                                $a->display($c);
                            ?>
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
                    <aside class="right_content">
                        <?php
                        $a = new GlobalArea('Global Right Area');
                        $a->display($c);
                        ?>

                    </aside>

                </div>
            </div>

        </section>
    </div>
    <div id="myModal" class="modal">

        <!-- The Close Button -->
        <span class="closeimg" onclick="document.getElementById('myModal').style.display='none'">&times;</span>

        <!-- Modal Content (The Image) -->
        <img class="modal-content" id="img01">

        <!-- Modal Caption (Image Text) -->
        <div id="caption"></div>
    </div>
    <style>
        <?php if($c->isEditMode()){?>
            #adunit{
                display: none;
            }

            <?php }?>
        /* Style the Image Used to Trigger the Modal */
        #myImg {
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
        }

        #myImg:hover {opacity: 0.7;}

        /* The Modal (background) */
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            padding-top: 100px; /* Location of the box */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
        }

        /* Modal Content (Image) */
        .modal-content {
            margin: auto;
            display: block;
            width: 80%;
            max-width: 700px;
        }

        /* Caption of Modal Image (Image Text) - Same Width as the Image */
        #caption {
            margin: auto;
            display: block;
            width: 80%;
            max-width: 700px;
            text-align: center;
            color: #ccc;
            padding: 10px 0;
            height: 150px;
        }

        /* Add Animation - Zoom in the Modal */
        .modal-content, #caption {
            -webkit-animation-name: zoom;
            -webkit-animation-duration: 0.6s;
            animation-name: zoom;
            animation-duration: 0.6s;
        }

        @-webkit-keyframes zoom {
            from {-webkit-transform:scale(0)}
            to {-webkit-transform:scale(1)}
        }

        @keyframes zoom {
            from {transform:scale(0)}
            to {transform:scale(1)}
        }

        /* The Close Button */
        .closeimg {
            position: absolute;
            top: 15px;
            right: 35px;
            color: #f1f1f1;
            font-size: 40px;
            font-weight: bold;
            transition: 0.3s;
            cursor: pointer;
        }

        .close:hover,
        .close:focus {
            color: #bbb;
            text-decoration: none;
            cursor: pointer;
        }

        /* 100% Image Width on Smaller Screens */
        @media only screen and (max-width: 700px){
            .modal-content {
                width: 100%;
            }
        }
    </style>

<?php
$this->inc('elements/footer.php');
