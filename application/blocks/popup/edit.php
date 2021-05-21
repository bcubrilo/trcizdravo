<?php

defined('C5_EXECUTE') or die("Access Denied.");
$al = Core::make('helper/concrete/asset_library');
$image = null;
if($fID){
    $image = File::getByID($fID);
}
?>
<fieldset>
    <div class="form-group">
        <?php
        echo $form->label('ccm-b-image', t('Image'));
        echo $al->image('ccm-b-image', 'fID', t('Choose Image'), $image);
        ?>
    </div>

    <div class="form-group">
        <label class="control-label">Url</label>
        <input class="form-control" type="text" name="url" value="<?php echo $url;?>"/>
    </div>
    <div class="form-group">
        <label class="control-label">Title</label>
        <input class="form-control" type="text" name="title" value="<?php echo $title;?>"/>
    </div>
    <div class="form-group">
        <label class="control-label">Description</label>
        <input class="form-control" type="text" name="description" value="<?php echo $description;?>"/>
    </div>

</fieldset>