<?php
defined('C5_EXECUTE') or die("Access Denied.");
$th = Loader::helper('text');
$c = Page::getCurrentPage();
$dh = Core::make('helper/date'); /* @var $dh \Concrete\Core\Localization\Service\Date */
$ih = Core::make('helper/image');
?>

<?php if ($c->isEditMode() && $controller->isBlockEmpty()) {
    ?>
    <div class="ccm-edit-mode-disabled-item"><?php echo t('Empty Page List Block.')?></div>
<?php
} else {
    ?>
<div class="slick_slider">

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

    foreach ($pages as $page):

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
    $thumbnail = $page->getAttribute('thumbnail');
    if($thumbnail){
        $thumbnailImage = $ih->getThumbnail($thumbnail,660,502,true);
        if($thumbnailImage){
            $thumbnailSrc = $thumbnailImage->src;
        }
    }
    $date = $dh->formatDateTime($page->getCollectionDatePublic(), true);
?>
        <div class="single_iteam">
            <a href="<?php echo $url;?>dgdgdgdd">
                <div clas="slick-slider-image-wrapper">
                    <img src="<?php echo $thumbnailSrc;?>" alt="">
                </div>
            </a>
            <div class="slider_article">
                <h2><a class="slider_tittle" href="<?php echo $url;?>"><?php echo $title;?></a></h2>
                <?php echo $description;?>
            </div>
        </div>

	<?php endforeach; ?>
</div>


<?php
} ?>
