<?php

namespace App\Controller\Front;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

class DefaultController extends AbstractController
{
    public function __construct(private TranslatorInterface $translator){}

    #[Route('/{_locale}', name: 'default', requirements:[ "_locale"=>"en|fr|de"])]
    public function index(): Response
    {
        dd($this->translator->trans('road.home'));
        return $this->render('front/default/home.html.twig', [
            'controller_name' => 'FRONT'
        ]);
    }

    #[Route('/whatwedo', name: 'page_whatwedo')]
    public function showPageWhatWeDo(): Response
    {
        return $this->render('front/default/whatwedo.html.twig', [
            'controller_name' => 'FRONT',
        ]);
    }

    #[Route('/', name: 'page_whatweare')]
    public function showPageWhatWeAre(): Response
    {
        return $this->render('front/default/whatwedo.html.twig', [
            'controller_name' => 'FRONT',
        ]);
    }
}
