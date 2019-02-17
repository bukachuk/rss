<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class RssController extends Controller
{
    const URL = 'https://www.delfi.lv/rss/?channel=delfi';

    /**
     * @Route("/rss", name="rss")
     */
    public function indexAction(Request $request)
    {
        $feedIo = $this->container->get('feedio');
        $feed = $feedIo->read(self::URL)->getFeed();

        return $this->render('Rss/index.html.twig', ['feed' => $feed]);
    }
}

