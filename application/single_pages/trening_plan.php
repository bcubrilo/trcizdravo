<?php defined('C5_EXECUTE') or die("Access Denied.");
$entity = Express::getObjectByHandle('trening_plan');
$list = new Concrete\Core\Express\EntryList($entity);
$listaPlanova = $list->getResults();
$treningPlanTreninziJson = array();
?>

<?php
$i=0;
foreach ($listaPlanova as $trening_plan){
    $i++;
    $treninziJson = array();
    $treninzi = $trening_plan->getTreningPlanTreninzi();
    if(count($treninzi)){
        foreach ($treninzi as $trening) {
            $treninziJson[$trening->getID()] = array(
                'sedmica' => $trening->getTreningPlanTreningSedmica()
                ,'dan' => $trening->getTreningPlanTreningDan()
                ,'opis' => $trening->getTreningPlanTreningOpis());

        }
    }
    if(count($treninziJson)>0){
        $treningPlanTreninziJson[$trening_plan->getID()] = $treninziJson;
    }
    ?>
    <div class="row">
        <div class="col-xs-12">
            <div class="training-plan-wrapper box-shadow-wrapper">
                <div>
                    <h1>
                        21.1
                    </h1>
                    <p><?php echo $trening_plan->getTreningPlanNaziv();?> </p>
                    <p><?php echo $trening_plan->getTreningPlanNivo();?> </p>
                    <p><?php echo $trening_plan->getTreningBrojSedmica();?> </p>
                    <a class="btn btn-blue pregledaj-trening-plan" data-value="<?php echo $trening_plan->getID();?>">Pregledaj</a>
                    <a href="#" class="btn btn-green odaberi-trening-plan" data-value="<?php echo $trening_plan->getID();?>">Odaberi</a>
                </div>
                <div class="trening-plan-treninzi-lista">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <td>Sedmica</td>
                                    <td>Dan</td>
                                    <td>Opis</td>
                                    <td>KM</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $treninzi = $trening_plan->getTreningPlanTreninzi();
                                if(count($treninzi)>0){
                                    foreach ($treninzi as $trening){

                                        ?>
                                    <tr>
                                        <td><?php echo $trening->getTreningPlanTreningSedmica();?></td>
                                        <td><?php echo $trening->getTreningPlanTreningDan();?></td>
                                        <td><?php echo $trening->getTreningPlanTreningOpis();?></td>
                                        <td><?php echo $trening->getTreningPlanTreningKm();?></td>
                                    </tr>
                                <?php
                                    }
                                }?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <div style="display: none;">
        <div data-dialog="odaberi-trening-plan" class="ccm-ui">

            <form data-dialog-form="odaberi-trening-plan" action="<?php echo $view->action('odaberiPlan'); ?>">
                <div class="form-group">
                    <label class="control-label">Datum početka plana</label>
                    <input class="form-control" type="date" name="datumPocetkaPlana"/>
                    <input type="hidden" name="treningPlanId" value=""/>
                </div>
                <div class="dialog-buttons">
                    <button class="btn btn-default pull-left" data-dialog-action="cancel">Otkaži</button>
                    <button type="button" data-dialog-action="submit" class="btn btn-primary pull-right">Potvrdi</button>
                </div>
            </form>

        </div>
    </div>



<?php

}?>
<style>
    .trening-plan-treninzi-lista{
        display: none;
    }
    .trening-plan-treninzi-lista.displayed{
        display: block;
        animation-name: fadeInDown;
    }
</style>
<script>
    (function () {
        $('.pregledaj-trening-plan').click(function () {
            $('.trening-plan-treninzi-lista.displayed').removeClass('displayed');

            $(this).closest('.training-plan-wrapper').find('.trening-plan-treninzi-lista').addClass('displayed');

        });
        $('.odaberi-trening-plan').click(function () {
            console.log('Otvaram dialog');
            $.fn.dialog.open({
                   element : 'div[data-dialog=odaberi-trening-plan]',
                   title: 'Odaberi trening plan',
                   width: '200',
                   height:'200',
                   modal: true,
                   close: function () {
                       $('input[name="treningPlanId"]').val('');
                   }
           });
           $('input[name="treningPlanId"]').val($(this).attr('data-value'));
           return false;
        });
    })();
</script>
