<?php
namespace Concrete\Package\ThemeTrcizdravo\Block\PageListSlider;

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

class Controller extends BlockController
{
    protected $btTable = '';
    protected $btInterfaceWidth = "800";
    protected $btInterfaceHeight = "350";
    protected $btCacheBlockRecord = true;
    protected $btCacheBlockOutput = null;
    protected $btCacheBlockOutputOnPost = true;
    protected $btCacheBlockOutputLifetime = 300;

    /**
     * Used for localization. If we want to localize the name/description we have to include this.
     */
    public function getBlockTypeDescription()
    {
        return t("List pages based on type, area.");
    }

    public function getBlockTypeName()
    {
        return t("Page List Slider");
    }

    public function getJavaScriptStrings()
    {
        return [
            'feed-name' => t('Please give your RSS Feed a name.'),
        ];
    }

    public function view()
    {
        $db = Database::get();
        $pages = $db->GetAll('SELECT 
                        p.*
                     FROM Pages p 
                     LEFT join PageTypes pt
                      on p.ptID = pt.ptID
                     LEFT JOIN Collections c
                       on p.cID = c.cID
                      WHERE pt.ptHandle = ? and cIsActive = 1 ORDER  by cDateAdded DESC limit 4;
                      ',array('blog'));
        $this->set('pages',$pages);
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
