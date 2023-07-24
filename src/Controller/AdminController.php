<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_ADMIN')]
class AdminController extends AbstractController
{
    #[Route('/admin', name: 'app_admin')]
    public function index(CategoryRepository $categoryRepository, Request $request, EntityManagerInterface $em): Response
    {
        $categoryType = $this->createForm(CategoryType::class, new Category());
        $categories = $categoryRepository->findAll();

        $categoryType->handleRequest($request);
        if ($categoryType->isSubmitted() && $categoryType->isValid()) {

            $newCategory = $categoryType->getData();
            $em->persist($newCategory);
            $em->flush();

            return $this->redirectToRoute('app_admin');
        }
        
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
            'categoryForm' => $categoryType->createView(),
            'categories' => $categories
        ]);
    }
}
