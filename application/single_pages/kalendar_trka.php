<?php defined('C5_EXECUTE') or die("Access Denied.");
$entity = Express::getObjectByHandle('trka');
$list = new Concrete\Core\Express\EntryList($entity);
$dh = Core::make('helper/date');
$trke = $list->getResults();
$trkeJson = array();
$trkeInfo = array();
$i = 1;
foreach ($trke as $trka){
    $info = array();
    $info['grad'] = $trka->getGradTrke();
    $info['drzava'] = $trka->getDrzavaTrke();
    $info['opis'] = $trka->getOpisTrke();
    $info['datum'] = $dh->formatCustom('d.m.Y.',$trka->getDatumTrke());
    $info['start'] = $dh->formatCustom('H:i',$trka->getDatumTrke());
    $info['naziv'] = $trka->getNazivTrke();
    $trkeInfo[$i] = $info;
    $datum = $dh->formatCustom('m-d-Y',$trka->getDatumTrke());
    $trkeJson[$datum].='<span style="background-color:white;" onclick="otvoriKalendarModal('.$i.')" class="kalendar-trka" data-toggle="modal" data-target="#kalendarModalDialog" data-value="'.$i.'">'.$trka->getNazivTrke().'</span>';
    $i++;
    ?>


<?php
}
$page = Page::getCurrentPage();
$theme = $page->getCollectionThemeObject();
$themePath = $theme->getThemeDirectory();
$themeUrl = $theme->getThemeURL();
?>
<h1 style="font-family: 'Cabin Sketch', cursive">KALENDAR TRKA</h1>
<script src="<?php echo $themeUrl;?>/js/jquery.calendario.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $themeUrl;?>/css/calendar.css" />

    <div class="map-container" style="min-height: 100vh;">

        <div class="custom-calendar-wrap custom-calendar-full">
            <div class="custom-header clearfix">
                <h3 class="custom-month-year">
                    <span id="custom-month" class="custom-month"></span>
                    <span id="custom-year" class="custom-year"></span>
                    <nav>
                        <span id="custom-prev" class="custom-prev"></span>
                        <span id="custom-next" class="custom-next"></span>
                        <span id="custom-current" class="custom-current" title="Got to current date"></span>
                    </nav>
                </h3>
            </div>
            <div id="calendar" class="fc-calendar-container"></div>
        </div>
    </div>
<div>
    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <ins class="adsbygoogle"
         style="display:block; text-align:center;"
         data-ad-layout="in-article"
         data-ad-format="fluid"
         data-ad-client="ca-pub-8787290704403325"
         data-ad-slot="8458087215"></ins>
    <script>
        (adsbygoogle = window.adsbygoogle || []).push({});
    </script>
</div>
<div class="modal fade kalendar-modal-transition" id="kalendarModalDialog" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <div>
                    <span class="grad-trke"></span>,<span class="drzava-trke"></span>
                </div>
                <div>
                    <span class="datum-trke"></span> u <span class="start-trke"></span>
                </div>
                <div class="opis-trke">

                </div>
            </div>
            <div class="modal-footer">
                <div class="social_link">
                    <ul class="sociallink_nav">
                        <li>
                            <a onClick="window.open('http://www.facebook.com/sharer.php?s=100&amp;p[title]=<?php echo $title;?>&amp;p[summary]=<?php echo $summary;?>&amp;p[url]=<?php echo $url; ?>&amp;p[images][0]=<?php echo $image;?>','sharer','toolbar=0,status=0,width=548,height=325');" href="javascript: void(0)">
                                <i class="fa fa-facebook"></i>
                            </a>
                        </li>
                        <li>
                            <a href="https://twitter.com/intent/tweet?original_referer=<?php echo $url;?>&ref_src=twsrc%5Etfw&text=<?php echo $title;?>&tw_p=tweetbutton&url=<?php echo $url;?>" class="twitter-share-button" data-show-count="false">
                                <i class="fa fa-twitter"></i>
                            </a>

                        </li>

                        <?php
                        /*

                        <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                        <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                        <li><a href="#"><i class="fa fa-pinterest"></i></a></li>

                         */
                        ?>

                    </ul>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    var trkeInfo;
    $(function() {
        trkeInfo = <?php echo json_encode($trkeInfo);?>;
        var cal = $( '#calendar' ).calendario( {
                onDayClick : function( $el, $contentEl, dateProperties ) {

                    for( var key in dateProperties ) {
                        console.log( key + ' = ' + dateProperties[ key ] );
                    }

                },
                caldata : <?php echo json_encode($trkeJson);?>
            } ),
            $month = $( '#custom-month' ).html( cal.getMonthName() ),
            $year = $( '#custom-year' ).html( cal.getYear() );

        $( '#custom-next' ).on( 'click', function() {
            cal.gotoNextMonth( updateMonthYear );
        } );
        $( '#custom-prev' ).on( 'click', function() {
            cal.gotoPreviousMonth( updateMonthYear );
        } );
        $( '#custom-current' ).on( 'click', function() {
            cal.gotoNow( updateMonthYear );
        } );

        function updateMonthYear() {
            $month.html( cal.getMonthName() );
            $year.html( cal.getYear() );
        }

        // you can also add more data later on. As an example:

    });
    function otvoriKalendarModal(id) {
        var info = trkeInfo[id];

        $("#kalendarModalDialog .modal-title").html(info.naziv);
        $("#kalendarModalDialog .grad-trke").text(info.grad);
        $("#kalendarModalDialog .datum-trke").text(info.datum);
        $("#kalendarModalDialog .drzava-trke").text(info.drzava);
        $("#kalendarModalDialog .start-trke").text(info.start);
        $("#kalendarModalDialog .opis-trke").empty();
        $("#kalendarModalDialog .opis-trke").append($.parseHTML(info.opis));
    }
</script>
<style>

    #kalendarModalDialog .modal-body{
        max-height: 70vh;
        overflow-y: auto;
    }

</style>
