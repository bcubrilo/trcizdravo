<?php
namespace Application\Controller\SinglePage\Dashboard\Express;

use Concrete\Controller\Element\Dashboard\Express\Entries\Header;
use Concrete\Controller\SinglePage\Dashboard\System\Express;
use Concrete\Core\Entity\Express\Entity;
use Concrete\Core\Entity\Express\Entry;
use Concrete\Core\Express\EntryList;
use Concrete\Core\Page\Controller\DashboardExpressEntityPageController;
use Concrete\Core\Page\Controller\DashboardPageController;
use Concrete\Core\Search\Result\Result;
use Concrete\Core\Tree\Node\Node;

class PlanTreninga extends DashboardPageController
{

    /**
     * @var $entity Entity
     */
    protected $entity;

    public function getEntity()
    {
        return $this->entity;
    }


    public function getEntities($entity){
        if($entity){

        }
    }

    public function view($entityID = false)
    {
//        $results = null;
//        if($entityID == false){
//            $entity = Express::getObjectByHandle('trening_plan');
//            $list = new \Concrete\Core\Express\EntryList($entity);
//            $results = $list->getResults();
//        }else{
//            $entity = Express::getObjectByID($entityID);
//            if($entity){
//
//            }
//        }
//        $this->set('results',$results);
    }


}
