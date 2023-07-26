<?php

namespace App\Controller;

use App\Entity\Nft;
use App\Form\NftType;
use App\Repository\NftRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\String\Slugger\SluggerInterface;

class NftController extends AbstractController
{
    #[Route('/nft', name: 'app_nft')]
    public function index(NftRepository $nftRepository): Response
    {
        $nfts = $nftRepository->findAll();
        return $this->render('nft/allnfts.html.twig', [
            'nfts' => $nfts,
        ]);
    }

    #[Route('/nft/account', name: 'app_nft_user')]
    #[IsGranted('ROLE_USER')]
    public function nftUserId(): Response
    {
        return $this->render('nft/index.html.twig', [
            'controller_name' => 'NftController',
        ]);
    }

    #[Route('/nft/add', name: 'app_nft_form')]
    #[IsGranted('ROLE_USER')]
    public function nftAjout(Request $request, SluggerInterface $slugger, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(NftType::class, new Nft());
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // On récupère l'image envoyé par le formulaire
            $image = $form->get('image')->getData();

            // Si une image n'est pas uploadé, on génère un message d'erreur
            if (is_null($image)) {
                $error = new FormError("Veuillez uploader une image");
                $form->get('image')->addError($error);
            } else {
                // On récupère le nom de l'image uploadé
                $originalFileName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                // On génère un nom de fichier unique avec le composant slugger
                $safeFileName = $slugger->slug($originalFileName);
                $newFileName = $safeFileName . '-' . uniqid() . '.' . $image->guessExtension();

                // On uploade le fichier sur le serveur
                try {
                    $image->move(
                        $this->getParameter('nft_image_directory'),
                        $newFileName
                    );
                } catch (FileException $e) {
                    dd($e);
                }

                // On enregistre le fichier uploadé sur la BDD
                $form = $form->getData();
                $form->setImage($newFileName);
                // L'utilisateur qui ajoute l'image est l'utilisateur connecté
                $form->setUserAdd($this->getUser());
                $em->persist($form);
                $em->flush();

                return $this->redirectToRoute('app_nft_user');
            }
        }
        return $this->render('nft/form.html.twig', [
            "form" => $form->createView()
        ]);
    }
}
