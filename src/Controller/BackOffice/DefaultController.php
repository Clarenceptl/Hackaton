<?php

namespace App\Controller\BackOffice;

use App\Service\PdfService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'default')]
    public function index(): Response
    {
        return $this->render('backoffice/default/index.html.twig', [
            'controller_name' => 'BACK',
        ]);
    }
}
