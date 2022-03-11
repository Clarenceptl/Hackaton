<?php

namespace App\Controller;

use App\Entity\Blog;
use App\Form\BlogType;
use App\Repository\BlogRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Mailer\MailerInterface;

class BlogController extends AbstractController
{

    // ---------------ADD BLOG ---------------
    // ---------------------------------------
    #[Route('/blog/add', name: 'blog_add')]
    public function index(EntityManagerInterface $em, Request $request): Response
    {

        $blog = new Blog();
        $form = $this->createForm(BlogType::class, $blog);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $blog = $form->getData();
            $blog->setIsSent(true);
            
            $em->persist($blog);
            // dd($blog);
            $em->flush();

            return $this->redirectToRoute('blog_add');
        }
        
        
        return $this->render('blog/addblog.html.twig', [
            'controller_name' => 'BlogController',
            'form' => $form->createView(),
        ]);
    }
    // ---------------FIN ADD BLOG ---------------


    // ---------------DISPLAY BLOG ---------------
    // -------------------------------------------

    #[Route('/blog', name: 'blog')]
    public function blogDisplay(BlogRepository $blog): Response
    {
        $blogs = $blog->findBlog();

        // // generate a URL with no route arguments
        // $blogUrl = $this->generateUrl('sign_up');

        // // generate a URL with route arguments
        // $urlPage = $this->generateUrl('user_profile', [
        //     'username' => $blog->getUserIdentifier(),
        // ]);

        // // generated URLs are "absolute paths" by default. Pass a third optional
        // // argument to generate different URLs (e.g. an "absolute URL")
        // $blogUrl = $this->generateUrl('sign_up', [], UrlGeneratorInterface::ABSOLUTE_URL);

        // // when a route is localized, Symfony uses by default the current request locale
        // // pass a different '_locale' value if you want to set the locale explicitly
        // $blogUrlInDutch = $this->generateUrl('sign_up', ['_locale' => 'nl']);

        return $this->render('blog/blog.html.twig', [
            'controller_name' => 'BlogController',
            'blog' => $blogs,
        ]);
    }
    // ---------------FIN DISPLAY BLOG ---------------


    // ---------------EDIT BLOG ---------------
    // ----------------------------------------

    #[Route('/blog/edit/{id}', name: 'blog_edit')]
    public function blogEdit(Blog $blog, Request $request, EntityManagerInterface $em ): Response
    {
        $form = $this->createForm(BlogType::class, $blog);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){

            $em->persist($blog);
            $em->flush();

            return $this->redirectToRoute('blog');
        }

        return $this->render('blog/addblog.html.twig', [
            'controller_name' => 'BlogController',
            'form' => $form->createView(),
        ]);
    }

    // ---------------FIN EDIT BLOG ---------------


    // ---------------DELETE BLOG ---------------
    // ----------------------------------------

    #[Route('/blog/delete/{id}', name: 'blog_delete')]
    // #[Security("is_granted('ROLE_ADMIN')")]
    public function blogDelete(EntityManagerInterface $em, Blog $blog)
    {
            $em->remove($blog);
            $em->flush();

            return $this->redirectToRoute('blog');

    }

    // ---------------FIN EDIT BLOG ---------------


    // ---------------NEWSLETTER ---------------
    // -----------------------------------------



    #[Route('/blog/newsletter/{id}', name: 'newsletter')]
    public function send(Blog $blog, MailerInterface $mailer): Response
    {
        $user = $blog->getCategories()->getUsers();

        foreach($user as $user){
                $email = (new TemplatedEmail())
                    ->from('valee.victor@gmail.com')
                    ->to($user->getEmail())
                    ->subject($blog->getTitre())
                    ->htmlTemplate('front/default/home.html.twig')
                    ->context(compact('blog', 'user'))
                    ;
                    $mailer->send($email);
                    dd($email);
                    return $this->redirectToRoute('blog');
            
        }
    }


}
