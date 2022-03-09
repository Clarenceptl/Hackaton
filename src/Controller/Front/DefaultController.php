<?php

namespace App\Controller\Front;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DefaultController extends AbstractController
{
    public function __construct(private TranslatorInterface $translator){}

    public function index(Request $request): Response
    {
        // dd($this->translator->trans('road.home'));
        // dd($request->getLocale());

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
