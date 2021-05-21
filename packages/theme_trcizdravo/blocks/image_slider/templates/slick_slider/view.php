<?php defined('C5_EXECUTE') or die("Access Denied.");
$navigationTypeText = ($navigationType == 0) ? 'arrows' : 'pages';
$c = Page::getCurrentPage();
$ih = Core::make('helper/image');
if ($c->isEditMode() || count($rows)<1) {
    ?>
    <div class="ccm-edit-mode-disabled-item" style="<?php echo isset($width) ? "width: $width;" : '' ?><?php echo isset($height) ? "height: $height;" : '' ?>">
        <i style="font-size:40px; margin-bottom:20px; display:block;" class="fa fa-picture-o" aria-hidden="true"></i>
        <div style="padding: 40px 0px 40px 0px"><?php echo t('Image Slider disabled in edit mode.')?>
			<div style="margin-top: 15px; font-size:9px;">
				<i class="fa fa-circle" aria-hidden="true"></i>
				<?php if (count($rows) > 0) { ?>
					<?php foreach (array_slice($rows, 1) as $row) { ?>
						<i class="fa fa-circle-thin" aria-hidden="true"></i>
						<?php }
					}
				?>
			</div>
        </div>
    </div>
<?php
} else {
    ?>
    <div class="slick_slider">
        <?php foreach ($rows as $row){
            $src = '';
            if($row['fID']){
                if($file = File::getByID($row['fID'])){
                    if($thumbnail = $ih->getThumbnail($file,660,502,true)){
                        $src = $thumbnail->src;
                    }
                }
            }
            ?>
            <div class="single_iteam"> <a href="<?php echo $row['URL'];?>">
                    <img src="<?php echo $src;?>" alt=""></a>
                <div class="slider_article">
                    <h2><a class="slider_tittle" href="<?php echo $row['URL'];?>"></a></h2>
                </div>
            </div>

        <?php }?>
    </div>

<?php }?>
