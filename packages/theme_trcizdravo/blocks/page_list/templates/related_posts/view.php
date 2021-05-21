<?php
defined('C5_EXECUTE') or die("Access Denied.");
$th = Loader::helper('text');
$c = Page::getCurrentPage();
$dh = Core::make('helper/date'); /* @var $dh \Concrete\Core\Localization\Service\Date */
$ih = Core::make('helper/image');
$pageTypeId = $c->getPageTypeID();

$pageTypeObject = $c->getPageTypeObject();
$pageTypeHandle = '';
if($pageTypeObject){
    $pageTypeHandle = $pageTypeObject->getPageTypeHandle();
}
if($pageTypeHandle!='blog'){
    return;
}
?>

<?php if ($c->isEditMode() && $controller->isBlockEmpty()) {
    ?>
    <div class="ccm-edit-mode-disabled-item"><?php echo t('Empty Page List Block.')?></div>
<?php
} else {
    ?>
<div class="related_post">
    <h2><?php echo $pageListTitle;?>
        <i class="fa fa-thumbs-o-up"></i>
    </h2>
    <ul class="spost_nav wow fadeInDown animated animated" style="visibility: visible; animation-name: fadeInDown;">

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
    if($page->cID == $c->cID){
        continue;
    }
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
        $thumbnailImage = $ih->getThumbnail($thumbnail,100,80,true);
        if($thumbnailImage){
            $thumbnailSrc = $thumbnailImage->src;
        }
    }
    $date = $dh->formatDateTime($page->getCollectionDatePublic(), true);
?>
        <li class="box-shadow-wrapper">
            <div class="media">
                <a class="media-left" href="<?php echo $url;?>">
                    <img src="<?php echo $thumbnailSrc;?>" alt="">
                </a>
                <div class="media-body">
                    <a class="catg_title" href="<?php echo $url;?>"> <?php echo $title;?></a>
                </div>
            </div>
        </li>


    <?php endforeach; ?>
    </ul>
</div>


<?php
} ?>
