<?php
defined('C5_EXECUTE') or die("Access Denied.");
$th = Loader::helper('text');
$c = Page::getCurrentPage();
$dh = Core::make('helper/date'); /* @var $dh \Concrete\Core\Localization\Service\Date */
$ih = Core::make('helper/image');
$nh = Core::make('helper/navigation');
?>

<div class="single_sidebar">
    <h2 style="margin-top: 0;"><span>NAJČITANIJE</span></h2>
    <ul class="spost_nav">

    <?php

    $includeEntryText = false;
    if (
        (isset($includeName) && $includeName)
        ||
        (isset($includeDescription) && $includeDescription)
        ||
        (isset($useButtonForLink) && $useButtonForLink)
    ) {
        $includeEntryText = true;
    }

    foreach ($pages as $tmpPage):
    $page = Page::getByID($tmpPage['cID']);
        // Prepare data for each page being listed...
    $buttonClasses = 'ccm-block-page-list-read-more';
    $entryClasses = 'ccm-block-page-list-page-entry';
    $title = $th->entities($page->getCollectionName());
    $url = ($page->getCollectionPointerExternalLink() != '') ? $page->getCollectionPointerExternalLink() : $nh->getLinkToCollection($page);
    $target = ($page->getCollectionPointerExternalLink() != '' && $page->openCollectionPointerExternalLinkInNewWindow()) ? '_blank' : $page->getAttribute('nav_target');
    $target = empty($target) ? '_self' : $target;
    $description = $page->getCollectionDescription();
    $description = $controller->truncateSummaries ? $th->wordSafeShortText($description, $controller->truncateChars) : $description;
    $description = $th->entities($description);
    $thumbnail = false;
    $thumbnailSrc = '';
    if($thumbnail = $page->getAttribute('thumbnail')){
        if($thumbnailImage = $ih->getThumbnail($thumbnail,100,80,true)){
            $thumbnailSrc = $thumbnailImage->src;
        }
    }
    $date = $dh->formatDateTime($page->getCollectionDatePublic(), true);

?>
        <li class="media wow fadeInDown box-shadow-wrapper">
            <div>
                <a href="<?php echo $url;?>" class="media-left">
                    <div style="height: 80px;overflow: hidden;">
                        <img style="" alt="" src="<?php echo $thumbnailSrc;?>">
                    </div>
                </a>
                <div class="media-body">
                    <a href="<?php echo $url;?>" class="catg_title"><?php echo $title;?></a>
                </div>
            </div>
        </li>
	<?php endforeach;
    ?>

    </ul>
</div><!-- end .ccm-block-page-list -->

