<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Igredient;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class HomePageController extends Controller
{

    /**
     * @Route("/welcome")
     * @Template()
     */
    public function welcomeAction(Request $request)
    {
        $igredients = $request->get('find', []);

        return ['igredients' => $igredients];
    }

}
