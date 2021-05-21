<?php
defined('C5_EXECUTE') or die("Access Denied.");
$th = Loader::helper('text');
$c = Page::getCurrentPage();
$dh = Core::make('helper/date'); /* @var $dh \Concrete\Core\Localization\Service\Date */
$ih = Core::make('helper/image');
$nh = Core::make('helper/navigation');
?>

<?php if ($c->isEditMode() || count($pages)<1) {
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

    foreach ($pages as $tmpPage):
    $page = Page::getByID($tmpPage['cID']);
        // Prepare data for each page being listed...
    if($page) {


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
        if ($thumbnail = $page->getAttribute('thumbnail')) {
            if ($thumbnailImage = $ih->getThumbnail($thumbnail, 710, 448, true)) {
                $thumbnailSrc = $thumbnailImage->src;
            }
        }
        $date = $dh->formatDateTime($page->getCollectionDatePublic(), true);

        ?>
        <div class="single_iteam">
            <a href="<?php echo $url; ?>">
                <div class="slick-slider-image-wrapper">
                    <img src="<?php echo $thumbnailSrc; ?>" alt="">
                </div>

            </a>
            <div class="slider_article">
                <h2><a class="slider_tittle" href="<?php echo $url; ?>"><?php echo $title; ?></a></h2>
                <p><?php echo $description; ?></p>
            </div>
        </div>
        <?php
    }
    endforeach;
    ?>


</div><!-- end .ccm-block-page-list -->


<?php
} ?>
