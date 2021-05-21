<?php defined('C5_EXECUTE') or die("Access Denied.");

?>
<div class="row">
    <?php
    $i=0;
    foreach ($listaPlanova as $trening_plan){
        $i++;
        ?>
        <div class="col-md-4 ">
            <div class="training-plan-wrapper box-shadow-wrapper">
                <h1>
                    21.1
                </h1>
                <p><?php echo $trening_plan->getTreningPlanNaziv();?> </p>
                <p><?php echo $trening_plan->getTreningPlanNivo();?> </p>
                <p><?php echo $trening_plan->getTreningBrojSedmica();?> </p>
                <a class="button btn-default">Pregledaj</a>
                <a class="button btn-default">Odaberi</a>
            </div>
        </div>

        <?php

    }?>

</div>
