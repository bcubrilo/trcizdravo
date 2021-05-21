<?php defined('C5_EXECUTE') or die("Access Denied.");?>

        <div id="kalkulator-trcanja">
            <div class="form-group">
                <label>Dužina</label>
                <input type="text" id="duzina" list="trke" class="form-control" min="0" placeholder="Unesite ili odaberite dužinu">
                <datalist id="trke"  >
                    <option value="42.195">Maraton</option>
                    <option value=" 21.0975">Polumaraton</option>
                    <option value="10">10 km</option>
                    <option value="5">5 km</option>
                    <option value="3">3 km</option>
                    <option value="1.609">1 mi</option>
                    <option value="1.5">1500 m</option>
                </datalist>
                <span class="ocisti"><i class="fa fa-close"></i> </span>
            </div>
            <div class="form-group vrijeme">
                <label>Vrijeme</label>
                <input type="text" class="form-control" id="vrijeme_h" min="0" max="23" placeholder="h">
                <input type="text" class="form-control" id="vrijeme_m" placeholder="m">
                <input type="text" class="form-control" id="vrijeme_s" min="0" max="59" placeholder="s">
                <span class="ocisti"><i class="fa fa-close"></i> </span>
            </div>
            <div class="form-group tempo">
                <label>Tempo</label>
                <input type="text" class="form-control" id="tempo_m" placeholder="m" min="0"/>
                <input type="text" class="form-control" id="tempo_s" placeholder="s" min="0" max="59"/> <span> min/km</span>
                <span class="ocisti"><i class="fa fa-close"></i> </span>
            </div>
            <div style="text-align: center;">
                <button class="btn btn-default btn-primary" id="izracunaj">Izračunaj</button>
            </div>
            <div>
                <p class="poruka"></p>
            </div>
            <div id="predvidjeni-rezultati" style="display: none;">
                <div class="red zaglavlje">
                    <div class="kolona">Trka</div>
                    <div class="kolona">Vrijeme</div>
                    <div class="kolona">Tempo</div>
                </div>

            </div>
            <h2 id="treninziZaglavlje" style="display: none;margin-top: 40px;">Treninzi</h2>
            <div id="tempoterninga">


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
<div>
    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <ins class="adsbygoogle"
         style="display:block"
         data-ad-format="autorelaxed"
         data-ad-client="ca-pub-8787290704403325"
         data-ad-slot="8330148606"></ins>
    <script>
        (adsbygoogle = window.adsbygoogle || []).push({});
    </script>
</div>

<script>
    (function(){
        $('#izracunaj').click(function(){
            $('#kalkulator-trcanja .poruka').text('');
            $('#predvidjeni-rezultati').css('display','table');
            var control = 0;
            var d = parseFloat($('#duzina').val());
            var t_h = $('#vrijeme_h').val() ? parseInt($('#vrijeme_h').val()) : 0;
            var t_m = $('#vrijeme_m').val() ? parseInt($('#vrijeme_m').val()) : 0;
            var t_s = $('#vrijeme_s').val() ? parseInt($('#vrijeme_s').val()) : 0;
            var T_m = parseInt($('#tempo_m').val());
            var T_s = parseInt($('#tempo_s').val());

            var t = (t_h ? t_h*3600 : 0) + (t_m  ? t_m * 60 : 0) + (t_s ? t_s : 0);
            var T = (T_m  ? T_m * 60 : 0) + (T_s ? T_s : 0);

            if(d > 0){
                control++;
            }
            if(t > 0){
                control++;
            }
            if(T > 0){
                control++;
            }
            if(control != 2){
                $('#kalkulator-trcanja .poruka').text('Niste ispravno popunili polja!')
                return;
            }

            if(!T){
                T = t/d;
                $('#tempo_m').val(Math.floor(T/60));
                var tmpSeconds = (T%60).toFixed(2);
                if(tmpSeconds==Math.floor(tmpSeconds)){tmpSeconds = Math.floor(tnpSeconds)}
                $('#tempo_s').val(tmpSeconds);
            }
            if(!t){
                t = d * T;
                $('#vrijeme_h').val(Math.floor(t/3600));
                $('#vrijeme_m').val(Math.floor((t%3600)/60));
                $('#vrijeme_s').val((t%3600)%60)
            }
            if(!d){
                d = t / T;
                $('#duzina').val(d.toFixed(2));
            }
            var t_min = t_h*60 + t_m + t_s/60;
            var d_m = d * 1000;

            $('#predvidjeni-rezultati .red:not(.zaglavlje)').remove();
            $('#tempoterninga .red').remove();
            $.ajax('<?php echo $view->action('predvidi',Core::make('token')->generate('kalkulator-trcanja'))?>/'+d_m+'/'+t_min,{

                success: function(data) {

                    if(data.rezultati){

                        for(var i= 0; i< data.rezultati.length; i++){
                            var rezultat = data.rezultati[i];
                            $('#predvidjeni-rezultati').append(
                                $('<div class="red">')
                                    .append('<div class="kolona">'+rezultat.disciplina
                                        +':</div>'
                                        +'<div class="kolona">'+rezultat.vrijeme+'</div>'
                                        +'<div class="kolona">'+rezultat.tempo+'</div>'

                                    )
                            );
                        }


                    }
                    if(data.trening) {
                        $('#treninziZaglavlje').css('display','block');
                        for(var i=0;i<data.trening.length;i++){
                            var trening = data.trening[i];
                            $('#tempoterninga').append(
                                $('<div class="red">')
                                    .append('<div class="kolona">'+trening.tip
                                        +':</div>'

                                        +'<div class="kolona">'+trening.tempo+' min/km</div>'

                                    )
                            );
                        }
                    }
                }
            });

        });

        $('#duzina').keypress(function validate(evt) {
                var theEvent = evt || window.event;
                var key = theEvent.keyCode || theEvent.which;
                key = String.fromCharCode( key );
                var regex = /[0-9]|\./;
                if( !regex.test(key) ) {
                    theEvent.returnValue = false;
                    if(theEvent.preventDefault) theEvent.preventDefault();
                }
            }
        );
        $('#vrijeme_m').keypress(function validate(evt) {
                var theEvent = evt || window.event;
                var key = theEvent.keyCode || theEvent.which;
                key = String.fromCharCode( key );
                var regex = /[0-9]|\./;
                if( !regex.test(key) || parseInt($('#vrijeme_m').val()+key)>59) {
                    theEvent.returnValue = false;
                    if(theEvent.preventDefault) theEvent.preventDefault();
                }
            }
        );
        $('#vrijeme_s').keypress(function validate(evt) {
                var theEvent = evt || window.event;
                var key = theEvent.keyCode || theEvent.which;
                key = String.fromCharCode( key );
                var regex = /[0-9]|\./;
                if( !regex.test(key) || parseInt($('#vrijeme_s').val()+key)>59) {
                    theEvent.returnValue = false;
                    if(theEvent.preventDefault) theEvent.preventDefault();
                }
            }
        );
        $('#vrijeme_h').keypress(function validate(evt) {
                var theEvent = evt || window.event;
                var key = theEvent.keyCode || theEvent.which;
                key = String.fromCharCode( key );
                var regex = /[0-9]|\./;
                if( !regex.test(key)) {
                    theEvent.returnValue = false;
                    if(theEvent.preventDefault) theEvent.preventDefault();
                }
            }
        );
        $('#tempo_m').keypress(function validate(evt) {
                var theEvent = evt || window.event;
                var key = theEvent.keyCode || theEvent.which;
                key = String.fromCharCode( key );
                var regex = /[0-9]|\./;
                if( !regex.test(key)) {
                    theEvent.returnValue = false;
                    if(theEvent.preventDefault) theEvent.preventDefault();
                }
            }
        );
        $('#tempo_s').keypress(function validate(evt) {
                var theEvent = evt || window.event;
                var key = theEvent.keyCode || theEvent.which;
                key = String.fromCharCode( key );
                var regex = /[0-9]|\./;
                if( !regex.test(key) || parseFloat($('#tempo_s').val()+key)>59.99) {
                    theEvent.returnValue = false;
                    if(theEvent.preventDefault) theEvent.preventDefault();
                }
            }
        );
        $('.ocisti').click(function(){
            $(this).closest('.form-group').find('input').val('');
        });

    })();
</script>
<style>

    #kalkulator-trcanja label,#kalkulator-trcanja input,#kalkulator-trcanja span{
        font-size: 18px;
    }
    #kalkulator-trcanja{
        max-width:500px;
        margin-left: auto;
        margin-right: auto;
        padding: 3rem;
        border:1px solid lightgrey;
        border-radius: 3px;
        margin-top:3rem;
        margin-bottom:3rem;
    }
    #kalkulator-trcanja .poruka{
        color: red;
        padding:20px 0;
        text-align: center;
    }
    #kalkulator-trcanja input {
        width:6em;
        display: inline-block;
        height:5rem;
    }
    #kalkulator-trcanja #duzina {
        width:14em;
    }
    #kalkulator-trcanja .tempo inpu, #kalkulator-trcanja .vrijeme input{
        width:5em;
    }

    #kalkulator-trcanja .form-group label{
        width: 30%;
    }
    #kalkulator-trcanja .ocisti{
        float: right;
        margin-top:1rem;
        cursor: pointer;
    }
    @media (max-width: 500px) {
        #kalkulator-trcanja label,#kalkulator-trcanja input, #kalkulator-trcanja span{
            font-size:12px;
        }
        #kalkulator-trcanja .form-group label{
            display: block;
        }
        #kalkulator-trcanja{
            padding:1rem;
        }
        #kalkulator-trcanja .tempo input{
            /*width:4.6em;*/
        }
    }
    #predvidjeni-rezultati,#tempoterninga{
        display:table;
        width:100%;
    }
    #predvidjeni-rezultati .zaglavlje{
        font-weight:700;
    }
    #predvidjeni-rezultati .red, #tempoterninga .red{
        display: table-row;
    }

    #predvidjeni-rezultati .kolona, #tempoterninga .kolona{
        display: table-cell;
        padding:10px 0px;
        border-bottom: 1px solid lightgray;
    }

</style>