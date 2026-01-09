<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class FeedController extends AbstractController
{
    /**
     * @return Response
     */
    #[Route('/feed', name: 'feed')]
    public function index(): Response
    {
        return $this->render('feed/index.html.twig');
    }
}
