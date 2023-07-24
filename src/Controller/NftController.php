<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NftController extends AbstractController
{
    #[Route('/nft', name: 'app_nft')]
    public function index(): Response
    {
        return $this->render('nft/index.html.twig', [
            'controller_name' => 'NftController',
        ]);
    }

    #[Route('/nft/account', name: 'app_nft')]
    public function nftUserId(): Response
    {
        return $this->render('nft/index.html.twig', [
            'controller_name' => 'NftController',
        ]);
    }
}
