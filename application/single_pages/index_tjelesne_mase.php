<div class="row">
    <div class="col-sm-12">
        <h1>Indeks tjelesne mase</h1>
        <p>Indeks tjelesne mase pokazuje odnos izmedju visine i težine osobe, u obzir ne uzima tjelesnu gradju pa ga treba uzeti sa rezervom.</p>
    </div>
    <div class="row">
        <div class="col-sm-4 ccm-kalkulator-trcanja-forma">
            <fieldset>
                <div class="form-group">
                    <label class="control-label">Težina(kg)</label>
                    <input class="form-control" type="number" id="bmi_kalkulator_tezina" required/>
                </div>
                <div class="form-group">
                    <label class="control-label">Visina (cm)</label>
                    <input class="form-control" type="number" id="bmi_kalkulator_visina" required/>
                </div>
                <div class="form-group">
                    <span class="btn btn-theme" id="bmi_kalkulator_racunaj">Izračunaj</span>
                </div>
            </fieldset>
        </div>
        <div class="col-sm-6 col-md-offset-1">
            <div id="bmi_kalkulator_rezultat">
                <h3>Indeks vaše tjelesne mase je <span id="bmi_index"></span></h3>
            </div>

        </div>
    </div>
</div>
<script>
    (function () {
        $('#bmi_kalkulator_racunaj').click(function () {
           var tezina = parseFloat($('#bmi_kalkulator_tezina').val());
           var visina = parseFloat($('#bmi_kalkulator_visina').val());
           if(tezina > 0 && visina > 0){
               var bmi = tezina/((visina/100)*(visina/100));
               $('#bmi_index').val(bmi);
           }
        });
    })();
</script>