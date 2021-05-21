<?php

namespace Concrete\Package\ThemeTrcizdravo;

use Concrete\Core\Block\BlockType\BlockType;
use \Concrete\Core\Package\Package;
use Concrete\Core\Page\Theme\Theme;
use Page;
use SinglePage;
defined('C5_EXECUTE') or die(_("Access Denied."));

class Controller extends Package
{

    protected $pkgHandle = 'theme_trcizdravo';
    protected $appVersionRequired = '5.7.0b1';
    protected $pkgVersion = '1.0';

    public function getPackageDescription()
    {
        return t("Trci zdravo template");
    }

    public function getPackageName()
    {
        return t("Trci zdravo");
    }

    public function install()
    {
        $pkg=parent::install();
        Theme::add('trcizdravo',$pkg);
        BlockType::installBlockType('page_list_slider',$pkg);
        BlockType::installBlockType('most_popular_pages',$pkg);
    }
}
?>