<?php
namespace Application\Controller\SinglePage;
use Concrete\Core\Page\Controller\PageController;
use Concrete\Core\Support\Facade\Express;
use Core;
use Page;
use Symfony\Component\HttpFoundation\JsonResponse;
use Concrete\Core\Editor\LinkAbstractor;
use View;
class KalendarTrka extends PageController{
    public function view($id = false){
        $this->addHeaderItem('<meta property="og:image" content="https://www.trcizdravo.com/packages/theme_trcizdravo/themes/trcizdravo/assets/calendar-159098_640.png"/>');
    }
}