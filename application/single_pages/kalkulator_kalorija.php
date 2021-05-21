
    <div class="row">
        <div class="col-sm-12">
            <h1>Kalkulator Kalorija</h1>
            <p>Pored toga koliko brzo trčite potršnja kalorija zavisi i od spoljnih faktora kao što je nadmorska visina,
                temperatura nagib staze i sl.
                Brojke izrečene ovdje su okvirnog karaktera i predstavljaju prosječne vrijednosti za trčanje po ravnom terenu.</p>
        </div>
    </div>
    <div id="kalkulator-kalorija">
        <div class="form-group">
            <label>Težina</label>
            <input class="form-control" type="number" id="kalkulator_kalorija_tezina" required placeholder="kg"/>
        </div>
        <div class="form-group">
            <label>Dužina</label>
            <input class="form-control" type="number" id="kalkulator_kalorija_duzina" required placeholder="km"/>
        </div>
        <div class="form-group vrijeme">
            <label>Vrijeme</label>
            <input type="number" class="form-control" id="kalkulator_kalorija_vrijeme_h" max="23" placeholder="h"/>
            <input type="number" class="form-control" id="kalkulator_kalorija_vrijeme_m" max="59" placeholder="m"/>
            <input type="number" class="form-control" id="kalkulator_kalorija_vrijeme_s" max="59" placeholder="s"/>
        </div>
        <div class="form-group" style="text-align: center;">
            <span class="btn btn-theme" id="kalkulator_trcananja_racunaj">Izračunaj</span>
        </div>
        <div id="ccm-kalkulator-kalorija-rezulati">
            <label>Rezultat</label>
            <h3> <span id="kalkulator_trcanja_kalorije"></span> kcal</h3>
            <h3> <span id="kalkulator_trcanja_pokm"></span> kcal/km</h3>
            <h3><span id="kalkulator_trcanja_poh"></span> kcal/h</h3>
        </div>
    </div>
    <div class="row">


        <div class="col-sm-6 col-md-offset-1">

        </div>
    </div>

<style>
    #ccm-kalkulator-kalorija-rezulati{
        display: none;

    }
   #ccm-kalkulator-kalorija-rezulati h3{
       text-align: center;
       font-weight:700;
       color: orange;
    }
    .ccm-kalkulator-trcanja-forma label,.ccm-kalkulator-trcanja-forma input,.ccm-kalkulator-trcanja-forma span{
        font-size: 18px !important;
    }
    #kalkulator-kalorija{
        max-width:500px;
        margin-left: auto;
        margin-right: auto;
        padding: 1rem;
        border:1px solid lightgrey;
        border-radius: 3px;
        margin-top:3rem;
        margin-bottom:3rem;
    }
    #kalkulator-kalorija input{
        width:6em;
        display: inline-block;
    }
    #kalkulator-kalorija .vrijeme input{

        width:4.5em;
    }
    #kalkulator-kalorija .form-group label{
        width: 30%;
    }
    @media (max-width: 500px) {
        #kalkulator-kalorija label,#kalkulator-kalorija input, #kalkulator-kalorija span{
            font-size:12px;
        }
        #kalkulator-kalorija .form-group label{
            width: 20%;
        }
        #ccm-kalkulator-kalorija-rezulati h3 span{
            font-size:24px;
        }
    }

</style>
<script>
    (function () {
        $('#kalkulator_trcananja_racunaj').click(function () {
            var tezina = parseFloat($('#kalkulator_kalorija_tezina').val());
            var duzina = parseFloat($('#kalkulator_kalorija_duzina').val());
            var vrijemeH = $('#kalkulator_kalorija_vrijeme_h').val();
            var vrijemeM = $('#kalkulator_kalorija_vrijeme_m').val();
            var vrijemeS = $('#kalkulator_kalorija_vrijeme_s').val();
            var h = 0,m=0,s=0;

            var vrijemeRegex = new RegExp("[0-9]{1,2}");
            if(vrijemeRegex.test(vrijemeH)){
                h = parseFloat(vrijemeH);
            }
            if(vrijemeRegex.test(vrijemeM)){
                m = parseFloat(vrijemeM);
            }
            if(vrijemeRegex.test(vrijemeS)){
                s = parseFloat(vrijemeS);
            }
            var vrijemeMinuti  = h*60 + m + s/60;
            if(tezina > 0 && duzina > 0 && vrijemeMinuti > 0){
                    $('#ccm-kalkulator-kalorija-rezulati').css('display','block');
                    $('#kalkulator_trcanja_kalorije').text(Math.round((duzina * tezina * 1.036)));
                    $('#kalkulator_trcanja_pokm').text(Math.round(tezina * 1.036));
                    $('#kalkulator_trcanja_poh').text(Math.round((duzina * tezina * 1.036*(60/vrijemeMinuti))));

            }
        });

    })();
</script>

