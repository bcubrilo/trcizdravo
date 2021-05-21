<?php
namespace Application\Block\KalkulatorTrcanja;

use BlockType;
use CollectionAttributeKey;
use Concrete\Core\Block\BlockController;
use Concrete\Core\Page\Feed;
use Database;
use Page;
use Core;
use PageList;
use Concrete\Core\Attribute\Key\CollectionKey;
use Concrete\Core\Tree\Node\Type\Topic;
use Express;
use Symfony\Component\HttpFoundation\JsonResponse;
class Controller extends BlockController
{
    protected $btTable = 'btKalkulatorTrcanja';
    protected $btInterfaceWidth = "800";
    protected $btCacheBlockRecord = true;
    protected $btCacheBlockOutput = null;
    protected $btCacheBlockOutputOnPost = true;
    protected $btCacheBlockOutputLifetime = 300;

    /**
     * Used for localization. If we want to localize the name/description we have to include this.
     */
    public function getBlockTypeDescription()
    {
        return t("Izračunajte tempo kojim trčite.");
    }

    public function getBlockTypeName()
    {
        return t("Kalkulator trčanja");
    }

    public function view()
    {

    }

    public function add()
    {

    }

    public function edit()
    {

    }

    public function save($args)
    {
        parent::save($args);
    }

    public function action_predvidi($token,$bID, $d_m, $t_min){
        $vdot = 0;
        if(Core::make('token')->validate('kalkulator-trcanja', $token)){

            $c = -4.6 + .182258 * $d_m / $t_min + .000104 * $d_m * $d_m / $t_min / $t_min;
            $i = .8 + .1894393 * exp(-.012778 * $t_min) + .2989558 * exp(-.1932605 * $t_min);
            $vdot = round(1000 * $c / $i) / 1000;
        }
        $returnObject = new \stdClass();
        $returnObject->test = 'Test';
        $returnObject->vdot = $vdot;
        $discipline = [
            42195 => 'Maraton',
            21097.5 => 'Polumaraton',
            10000 => '10 km',
            5000 => '5 km',
            3000 => '3 km',
            1500 => '1.5 km'
        ];
        $predvidjeniRezultati = [];
        foreach ($discipline as $key=>$value) {
            $rezultat = $this->predvidiRezultat($vdot,$key);
            $predvidjeniRezultati[] = [
                'disciplina' => $value,
                'vrijeme' => $rezultat,
                'tempo' => $this->getTempo($rezultat,$key),
            ];
        }
        $lagano = (1000*2*0.000104)/(-0.182258+sqrt(pow(0.182258,2)-4*0.000104*(-4.6-0.67*$vdot)));
        $trening = [
            ['tip'=>'Lagano trčanje','tempo'=>$this->getTempoTreninga($vdot,0.67)],
            ['tip'=>'Tempo','tempo'=> $this->getTempoTreninga($vdot,0.9)],
            ['tip'=>'Intervali','tempo'=> $this->getTempoTreninga($vdot,0.99)],
            ['tip'=>'Dionice','tempo'=> $this->getTempoTreninga($vdot,1.072)],

        ];

        $returnObject->rezultati = $predvidjeniRezultati;
        $returnObject->trening = $trening;
        return new JsonResponse($returnObject);
    }
    private function  predvidiRezultat($vdot, $distanca){
        $c = 0;
        $i = 0;
        $e = 0;
        $dc = 0;
        $di = 0;
        $dt = 0;
        $n = 0;
        $t = 0;
        $t = $distanca * .004;
        $n=0;
        $e = 0;
        do
        {
            $c=-4.6+.182258*$distanca/$t + .000104*$distanca*$distanca/$t/$t;
            $i=.8+.1894393*exp(-.012778*$t)+ .2989558*exp(-.1932605*$t);
            $e=abs($c-$i*$vdot);
            $dc=-.182258*$distanca/$t/$t-2*.000104*$distanca*$distanca/$t/$t/$t;
            $di=-.012778*.1894393*exp(-.012778*$t)-.1932605*.2989558*exp(-.1932605*$t);
            $dt=($c-$i*$vdot)/($dc-$di*$vdot);
            $t-=$dt;
            $n++;
        }
        while($n<10 && $e>.1);
        $t = round($t,2);
        $h = floor($t / 60);
        $m =floor($t % 60);
        $s = round(60 * ($t - floor($t)));

        return ($h > 0 ? $h.':' : ''). ($m<10 ? '0'.$m : $m)  .':'. ($s<10 ? '0'.$s : $s);

        }

    private function getPace($vdot){
        return(1000*2*0.000104)/(-0.182258+sqrt(0.182258^2-4*0.000104*(-4.6-0.67*$vdot)));
    }
    private function getTempo($vrijeme,$duzina){
        $timeSlices = explode(':',$vrijeme);
        $timeSlices = array_reverse($timeSlices);
        $time = 0;

        for($i=0;$i<count($timeSlices);$i++){
            $time+=intval($timeSlices[$i])*pow(60,$i);
        }
        $tempo = $time/($duzina/1000);
        $m = intval($tempo/60);
        $s = ceil($tempo%60);
        return $m.':'.($s < 10 ? '0'.$s : $s);
    }
    private function getTempoTreninga($vdot,$procenat){
        $vrijeme = (1000*2*0.000104)/(-0.182258+sqrt(pow(0.182258,2)-4*0.000104*(-4.6-$procenat*$vdot)));
        $sekunde = intval(($vrijeme-intval($vrijeme))*60);
        return intval($vrijeme).':'.($sekunde < 10 ? '0'.$sekunde : $sekunde);

    }

}
