<?php
namespace Application\Controller\PageType;

use Concrete\Core\Page\Controller\PageTypeController;
use Page;
use Database;
use User;
class Blog extends PageTypeController
{

    public function view()
    {
        $user = new User();
        if(!$user->isLoggedIn()){
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
}
?>