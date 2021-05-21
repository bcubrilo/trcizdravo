<?php defined('C5_EXECUTE') or die("Access Denied.");
/*
$ih = Core::make('helper/image');
$imageSrc = '';
if($fID){
    if($file = File::getByID($fID)){
        if($thumbnail = $ih->getThumbnail($file,140,140,true)){
            $imageSrc = $thumbnail->src;
        }
    }
}
*/
$currentPage = Page::getCurrentPage();
$popupCookieExists = Cookie::has('trci_zdravo_popup_block');
if(!$popupCookieExists || $currentPage->isEditMode() || 1==1){
?>
<div class="popup-container">
    <span class="popup-close close">x</span>
    <a target="_blank" href="<?php echo $url;?>" class="popu-url">
<!--        <div class="popup-image-container">-->
<!--            <img src="--><?php //echo $imageSrc;?><!--"/>-->
<!--        </div>-->
        <div class="popup-text">
            <p class="popup-title">
                <?php echo $title;?>
            </p>
            <div class="popup-description">
                <p><?php echo $description;?></p>
            </div>
        </div>
    </a>
</div>

<style>
    <?php if($currentPage->isEditMode()){?>
        .popup-container{
            position: relative !important;;
            left: 0 !important;
            z-index: auto !important;
        }
    <?php } ?>
    .popup-container{
        width:90vw;
        max-width: 500px;
        height: auto;
        background: #30307A;
        bottom: 20px;
        left: -380px;
        position: fixed;
        border-radius: 5px;
        box-shadow: 0px 25px 10px -15px rgba(0, 0, 0, 0.05);
        transition: 3s;
        z-index: 10000;
        overflow: auto;
    }
    .popup-close{
        position:absolute;
        top: 5px;
        right: 5px;
        width: 20px;
        height: 20px;
        cursor:pointer;
        z-index:500;
    }
    .popup-image-container{
        width:30%;

    }
    .popup-image-container img{
        width:100%;
        height:auto;
    }
    .popup-text, .popup-image-container{
        float:left;
    }
    .popup-text{

        padding:2%;
    }
    .popup-container h5,.popup-container span, .popup-container p{
        color:white !important;
    }
    .popup-title{
        font-size: 25px;
        text-transform: uppercase;
        font-weight: 700;
    }
    .popup-description{
        padding: 20px 0px;
    }
</style>
<script>
    (function(){
        setTimeout(function(){
            $('.popup-container').css('left','10px');
        },2000);

        $('.popup-close').click(function(){
            $(this).closest('.popup-container').detach();

        });
        var d = new Date();
        d.setTime(d.getTime() + (6*60*60*1000));
        document.cookie = 'trci_zdravo_popup_block' + "=" + '1' + ";" + "expires="+ d.toUTCString() + ";path=/";

    })();
</script>
<?php }?>