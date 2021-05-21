<?php
defined('C5_EXECUTE') or die("Access Denied.");
$th = Loader::helper('text');
$c = Page::getCurrentPage();
$dh = Core::make('helper/date'); /* @var $dh \Concrete\Core\Localization\Service\Date */
$ih = Core::make('helper/image');

$thumbnailSrc;
$page = $pages[0];
$title = $th->entities($page->getCollectionName());
$url = ($page->getCollectionPointerExternalLink() != '') ? $page->getCollectionPointerExternalLink() : $nh->getLinkToCollection($page);
$description = $page->getCollectionDescription();
$description = $controller->truncateSummaries ? $th->wordSafeShortText($description, $controller->truncateChars) : $description;
$description = $th->entities($description);
$thumbnail = $page->getAttribute('thumbnail');
if($thumbnail){
    $thumbnailImage = $ih->getThumbnail($thumbnail,348,232,true);
    if($thumbnailImage){
        $thumbnailSrc = $thumbnailImage->src;
    }
}
?>

<div class="single_post_content">
    <h2><span><?php echo $pageListTitle;?></span></h2>

        <ul class="business_catgnav  wow fadeInDown animated " style="visibility: visible; animation-name: fadeInDown;">
            <li class="box-shadow-wrapper" style="margin-bottom:10px;">
                <figure class="bsbig_fig">
                    <a href="<?php echo $url;?>" class="featured_img">
                        <img alt="" src="<?php echo $thumbnailSrc;?>">
                        <span class="overlay"></span>
                    </a>
                    <figcaption style="padding-left:5px">
                        <a href="<?php echo $url;?>"><?php echo $title;?></a>
                    </figcaption>
                    <p class="page-list-description" style="padding-left: 5px;padding-bottom: 5px;"><?php echo  $description;?></p>
                </figure>
            </li>
        </ul>
        <ul class="spost_nav">
            <?php for($i=1;$i<count($pages);$i++){
                $page = $pages[$i];
                $title = $th->entities($page->getCollectionName());
                $url = ($page->getCollectionPointerExternalLink() != '') ? $page->getCollectionPointerExternalLink() : $nh->getLinkToCollection($page);
                $description = $page->getCollectionDescription();
                $description = $controller->truncateSummaries ? $th->wordSafeShortText($description, $controller->truncateChars) : $description;
                $description = $th->entities($description);
                $thumbnail = $page->getAttribute('thumbnail');
                if($thumbnail){
                    $thumbnailImage = $ih->getThumbnail($thumbnail,100,80,true);
                    if($thumbnailImage){
                        $thumbnailSrc = $thumbnailImage->src;
                    }
                }
                ?>
                <li class="media wow fadeInDown animated box-shadow-wrapper" style="visibility: visible; animation-name: fadeInDown;">
                    <div>
                        <a href="<?php echo $url;?>" class="media-left">
                            <img alt="" src="<?php echo $thumbnailSrc;?>">
                        </a>
                        <div class="media-body">
                            <a href="<?php echo $url;?>" class="catg_title"> <?php echo $title;?></a>
                        </div>
                    </div>
                </li>
            <?php }?>
        </ul>
</div>
