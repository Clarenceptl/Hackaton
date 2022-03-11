<?php

namespace App\Controller\Front;

use App\Service\PdfService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserBackOffice extends AbstractController{
    #[IsGranted('ROLE_USER')]
    #[Route('/pdf-test', name: 'test-pdf')]
    public function testPdf(PdfService $pdf)
    {
        $html = $this->render('Pdf/default.html.twig');
        $pdf->showPdf($html);
    }
    #[IsGranted('ROLE_USER')]
    #[Route('/espace-perso', name: 'espace-perso')]
    public function espacePerso()
    {
        return $this->render('backoffice/user/backoffice.html.twig',[
            'mail'=> $this->getUser()->getEmail()
        ]);
    }
}