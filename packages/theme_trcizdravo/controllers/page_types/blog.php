<?php
namespace Concrete\Packages\ThemeTrcizdravo\Controller\PageType;

use Concrete\Core\Page\Controller\PageTypeController;
use Page;
use Database;
class Blog extends PageTypeController
{

    public function view()
    {
        $this->redirect('https://documentation.concrete5.org/developers/working-with-pages/controllers-for-page-types');
        $c = $this->getPageObject();
        if($c){
            $db = Database::get();
            $counter = $db->GetOne('SELECT * FROM MostPopularPages WHERE cID = ?',array($c->cID));
            if($counter){
                $db->Execute('UPDATE MostPopularPages SET counter = counter + 1 WHERE cID = ?',array($c->cID));
            }else{
                $db->Execute('INSERT INTO MostPopularPages VALUES (?,?)',array($c->cID,1));
            }
        }
    }
}
?>