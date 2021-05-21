<?php
namespace Application\Block\Zanimljivosti;

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
class Controller extends BlockController
{
    protected $btTable = 'btZanimljivosti';
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
        return t("Prikazuje zanimljivosti.");
    }

    public function getBlockTypeName()
    {
        return t("Zanimljivosti");
    }

    public function view()
    {
        $entity = Express::getObjectByHandle('zanimljivost');
        $list = new \Concrete\Core\Express\EntryList($entity);

        $zanimljivosti = $list->getResults();

        usort($zanimljivosti, function($a, $b)
        {
            return $a->getID() < $b->getID();
        });

        $zanimljivostiTop5 = array_slice($zanimljivosti,0,5);
        $this->set('zanimljivosti',$zanimljivostiTop5);
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


}
