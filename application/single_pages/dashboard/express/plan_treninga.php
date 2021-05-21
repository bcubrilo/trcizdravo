<?php defined('C5_EXECUTE') or die("Access Denied.");
$entity = \Express::getObjectByHandle('trening_plan');
$list = new Concrete\Core\Express\EntryList($entity);
$listaPlanova = $list->getResults();
?>

<div class="row">
    <div class="col-xs-4">
        <ul>
            <?php
            $treningPlanTreninziJson = array();
            foreach ($listaPlanova as $trening_plan){
                $treninzi = $trening_plan->getTreningPlanTreninzi();
                $treninziJson = array();

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
                <li class="trening-plan" data-value="<?php echo $trening_plan->getID();?>"><?php echo $trening_plan->getTreningPlanNaziv();?></li>
            <?php }?>
        </ul>

    </div>
    <div class="col-xs-8">
        <div class="table-responsive">
            <table class="table trening-plan-treninzi">
                <thead>
                    <tr>
                        <td>Sedmica</td>
                        <td>Dan</td>
                        <td>Opis</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>


    </div>

    <script>
        (function () {
            var entitesUrl = '<?php echo URL::to('/dashboard/express/entries/view_entry')?>';
            var treninzi =<?php echo json_encode($treningPlanTreninziJson,JSON_PRETTY_PRINT);?>;
            $('.trening-plan').click(function () {
                $('.trening-plan-treninzi tbody').empty();
                var planId = $(this).attr('data-value');
                var planTreninzi = treninzi[planId];
                if(planTreninzi != undefined) {
                    var i = 1;
                    $.each(planTreninzi, function (key, value) {
                        $('.trening-plan-treninzi').append('<tr><td>' + value.sedmica + '</td><td>'
                            + value.dan + '</td><td>' + value.opis + '</td><td>'
                            +'<a target="_blank" href="'+ entitesUrl + '/' + key + '"><i class="fa fa-pencil" aria-hidden="true"></i></a>'
                            +'</tr>');
                        if(i%7 == 0){
                            $('.trening-plan-treninzi').append('<tr><td>--</td><td>--</td><td>--</td></tr>');
                        }
                        i++;
                    });
                }
            });
        })();
    </script>
</div>
