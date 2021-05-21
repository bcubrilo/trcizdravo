<?php
defined('C5_EXECUTE') or die("Access Denied.");
$th = Loader::helper('text');
$c = Page::getCurrentPage();
$ih = Core::make('helper/image');
?>

    <div class="row">
        <div class="col-xs-12">
        <?php foreach ($pages as $page):

            $title = $th->entities($page->getCollectionName());
            $url = $nh->getLinkToCollection($page);
            $target = ($page->getCollectionPointerExternalLink() != '' && $page->openCollectionPointerExternalLinkInNewWindow()) ? '_blank' : $page->getAttribute('nav_target');
            $target = empty($target) ? '_self' : $target;
            $thumbnail = $page->getAttribute('thumbnail');
            $hoverLinkText = $title;
            $description = $page->getCollectionDescription();
            $description = $controller->truncateSummaries ? $th->wordSafeShortText($description, $controller->truncateChars) : $description;
            $description = $th->entities($description);
            if ($useButtonForLink) {
                $hoverLinkText = $buttonLinkText;
            }

            ?>
            <div class="business_catgnav  wow fadeInDown animated animated box-shadow-wrapper">
                <div class="row">
                    <div class="col-md-6">
                        <a href="<?php echo $url ?>" target="<?php echo $target ?>" class="featured_img ">
                            <?php
                            $thumbnailSrc = '';
                            if($thumbnail){
                                $thumbnailImage = $ih->getThumbnail($thumbnail,348,232,true);
                                if($thumbnailImage){
                                    $thumbnailSrc = $thumbnailImage->src;
                                }
                            }

                            ?>
                            <img src="<?php echo $thumbnailSrc;?>"/>
                            <span class="overlay"></span>

                        </a>
                    </div>
                    <div class="col-md-6">
                        <figcaption>
                            <h3><a href="<?php echo $url;?>"><?php echo $title;?></a></h3>
                        </figcaption>
                        <p class="page-description"><?php echo $description;?></p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        </div>
    </div>

<?php if ($showPagination): ?>
    <?php echo $pagination;?>
<?php endif; ?>

<?php if ($c->isEditMode() && $controller->isBlockEmpty()): ?>
    <div class="ccm-edit-mode-disabled-item"><?php echo t('Empty Page List Block.')?></div>
<?php endif; ?>