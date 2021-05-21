<?php
defined('C5_EXECUTE') or die("Access Denied.");

$ih = Core::make('helper/image');
$nh = Core::make('helper/navigation');

$zanimljivostiUrl = $nh->getLinkToCollection(Page::getByPath('/zanimljivosti'));
$type = \Concrete\Core\File\Image\Thumbnail\Type\Type::getByHandle('thumbnail_100_80');
?>

<div class="single_sidebar">
    <h2 style="margin-top: 0;"><span>Zanimljivosti</span></h2>
    <ul class="spost_nav">

        <?php
        foreach ($zanimljivosti as $zanimljivost) {
                $naslov = $zanimljivost->getZanimljivostNaslov();
                $url = $zanimljivostiUrl.'/'.$zanimljivost->getID();
                $imgSrc = '';
                if ($zanimljivost->getZanimljivostSlika()) {
                    $imgSrc = $zanimljivost->getZanimljivostSlika()->getThumbnailURL($type->getBaseVersion());
                    }
            ?>
            <li class="media wow fadeInDown box-shadow-wrapper">
                <div>
                    <a href="<?php echo $url;?>" class="media-left">
                        <div style="height: 80px;overflow: hidden;">
                            <img style="" alt="" src="<?php echo $imgSrc;?>">
                        </div>
                    </a>
                    <div class="media-body">
                        <a href="<?php echo $url;?>" class="catg_title"><?php echo $naslov;?></a>
                    </div>
                </div>
            </li>
        <?php
            }
        ?>

    </ul>
</div><!-- end .ccm-block-page-list -->

