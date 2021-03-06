<?php defined('C5_EXECUTE') or die('Access Denied.'); ?>

<?php if (count($images)): ?>

    <div class="sg sg-<?php echo $uniqueID; ?> js-sg">

        <?php foreach ($images as $image): ?>

            <a href="<?php echo $image['fullscreenUrl']; ?>"
               title="<?php echo $image['caption']; ?>"
               data-effect="mfp-zoom-in"
               class="sg-item"
            >
                <div class="sg-item-overlay"></div>
                <div class="sg-item-content">
                    <i class="fa fa-search"></i>
                </div>
                <div class="sg-item-image">
                    <img src="<?php echo $image['thumbnailUrl']; ?>"
                         alt="<?php echo $image['alt']; ?>"
                         width="<?php echo $image['thumbnailWidth']; ?>"
                         height="auto" max-height="<?php echo $image['thumbnailWidth']; ?>"
                         overflow="hidden"
                    />
                </div>

            </a>

        <?php endforeach; ?>

    </div>

<?php else: ?>

    <div class="sg-no-images-found"><?php echo t('No images were found.'); ?></div>

<?php endif; ?>