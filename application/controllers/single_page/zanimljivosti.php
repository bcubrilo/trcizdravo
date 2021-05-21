<?php

namespace Application\Controller\SinglePage;

use Concrete\Core\Page\Controller\PageController;
use Concrete\Core\Support\Facade\Express;
use Core;
use Page;
use Symfony\Component\HttpFoundation\JsonResponse;
use Concrete\Core\Editor\LinkAbstractor;

class Zanimljivosti extends PageController
{
  public function view($id = false)
  {
    $zanimljivostiSortiranePoId = [];
    $nh = Core::make('helper/navigation');
    $ih = Core::make('helper/image');
    $keywords = ' trcanje zanimljivosti maraton aktivnost zdravlje ';
    if ($id) {
      $odabranaZanimljivost = Express::getEntry($id);

      $currentPageUrl = $nh->getLinkToCollection(Page::getByPath('/zanimljivosti'));
      $slika = false;
      try {
        $slika = $odabranaZanimljivost->getZanimljivostSlika();
      } catch (Exception $ex) {
      }

      $sadrzaj = LinkAbstractor::translateFrom($odabranaZanimljivost->getZanimljivostSadrzaj());
      if (strlen($sadrzaj) > 70) {
        $sadrzaj = substr($sadrzaj, 0, strpos($sadrzaj, ' ', 70));


      }
      $sadrzaj = strip_tags($sadrzaj);
      $imgSrc = '';
      if ($slika) {
        $thumb = $ih->getThumbnail($odabranaZanimljivost->getZanimljivostSlika(), 600, 400, true);

        if ($thumb) {
          $imgSrc = $thumb->src;
        }
      }
      $keywords .= $odabranaZanimljivost->getZanimljivostKljucneRijeci();
      $this->set('odabranaZanimljivost', $odabranaZanimljivost);

      $seo = Core::make('helper/seo');
      $seo->addTitleSegment($odabranaZanimljivost->getZanimljivostNaslov());
      $this->addHeaderItem('<meta property="og:title" content="' . $odabranaZanimljivost->getZanimljivostNaslov() . '"/>');
      $this->addHeaderItem('<meta property="og:url" content="' . $currentPageUrl . '/' . $odabranaZanimljivost->getID() . '"/>');
      $this->addHeaderItem('<meta property="og:image" content="' . $imgSrc . '"/>');
      $this->addHeaderItem('<meta property="og:description" content="' . $sadrzaj . '..."/>');
      $this->addHeaderItem('<meta property="og:app_id" content="656651701184819" />');


      $this->addHeaderItem('<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                                        <script>
                                            (adsbygoogle = window.adsbygoogle || []).push({
                                                google_ad_client: "ca-pub-8787290704403325",
                                                enable_page_level_ads: true
                                            });
                                        </script>');
    }
    $this->addHeaderItem('<meta name="keywords" content="' . $keywords . '"/>');
    $entity = Express::getObjectByHandle('zanimljivost');
    $list = new \Concrete\Core\Express\EntryList($entity);


    $list->getQueryObject()->orderBy('e.exEntryID', 'desc')->setMaxResults(2);


    $zanimljivosti = $list->getResults();

    $this->set('zanimljivosti', $zanimljivosti);

  }

  public function ucitajZanimljivosti($maxId)
  {
    $returnValue = [];
    $nh = Core::make('helper/navigation');
    $ih = Core::make('helper/image');

    $currentPageUrl = $nh->getLinkToCollection(Page::getByPath('/zanimljivosti'));

    $entity = Express::getObjectByHandle('zanimljivost');
    $list = new \Concrete\Core\Express\EntryList($entity);
    $list->getQueryObject()->andWhere('e.exEntryID < :zanimljivostId')
      ->setParameter('zanimljivostId', $maxId)
//            ->andWhere('e.exEntryID <> :preskociId')
//            ->setParameter('preskociId',102)
      ->orderBy('e.exEntryID', 'desc')
      ->setMaxResults(2);
    $zanimljivosti = $list->getResults();

    if (count($zanimljivosti) > 0) {
      foreach ($zanimljivosti as $zanimljivost) {
        $naslov = $zanimljivost->getZanimljivostNaslov();
        $slika = false;
        try{
          $slika = $zanimljivost->getZanimljivostSlika();
        }catch (\Exception $ex){}

        $sadrzaj = LinkAbstractor::translateFrom($zanimljivost->getZanimljivostSadrzaj());
        $id = $zanimljivost->getID();
        $url = $currentPageUrl . '/' . $id;

//                $sadrzaj = strip_tags($sadrzaj);
        $imgSrc = '';
        if ($slika) {
          $thumb = $ih->getThumbnail($zanimljivost->getZanimljivostSlika(), 600, 400, true);

          if ($thumb) {
            $imgSrc = $thumb->src;
          }
        }

        $returnValue[] = ['id' => $id, 'url' => $url, 'naslov' => $naslov, 'sadrzaj' => stripslashes($sadrzaj), 'slikaSrc' => $imgSrc];
      }
    }
    $returnObject = new \stdClass();
    $returnObject->zanimljivosti = $returnValue;
    return new JsonResponse($returnObject);
  }
}