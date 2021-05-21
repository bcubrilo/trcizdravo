<?php
namespace Application\Block\Popup;

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
    protected $btTable = 'btPopup';
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
        return t("Shows popup window.");
    }

    public function getBlockTypeName()
    {
        return t("Popup");
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

}
