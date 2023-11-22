<?php

namespace App\Controller;

use App\Entity\Matiere;
use App\Form\MatiereType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class MatiereController extends AbstractController
{
    public function __construct(private EntityManagerInterface $em)
    {
    }
    #[Route('/matieres', name: 'app_matiere')]
    public function index(Request $request,  TranslatorInterface $translator): Response
    {
        $matiere = new Matiere();
        $form = $this->createForm(MatiereType::class, $matiere);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $this->em->persist($matiere);
            $this->em->flush();
            $this->addFlash('success', $translator->trans('matiere.form_success'));
        }
        else if ($form->isSubmitted() && !$form->isValid()){
            $this->addFlash('danger', $translator->trans('matiere.form_error'));
        }
        return $this->render('matiere/index.html.twig', [
            'controller_name' => 'MatiereController',
            'matieres' => $this->em->getRepository(Matiere::class)->findAll(),
            'form' => $form->createView()
        ]);
    }
    #[Route('/matiere/{id}', name: 'matiere_detail')]
    public function detail(Matiere $matiere): Response
    {
        return $this->render('matiere/detail.html.twig', [
            'matiere' => $matiere
        ]);
    }
    #[Route('/matiere-edit/{id}', name: 'edit_matiere')]
    public function edit(Matiere $matiere, Request $request, TranslatorInterface $translator): Response
    {
        $form = $this->createForm(MatiereType::class, $matiere);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $this->em->flush();
            $this->addFlash('success', $translator->trans('matiere.form_modif_success'));
            return $this->redirectToRoute('app_matiere');
        }
        else if ($form->isSubmitted() && !$form->isValid()){
            $this->addFlash('danger', $translator->trans('matiere.form_modif_error'));
        }
        return $this->render('matiere/edit.html.twig', [
            'matiere' => $matiere,
            'form' => $form->createView()
        ]);
    }
    #[Route('/matiere-delete/{id}', name: 'delete_matiere')]
    public function delete(Matiere $matiere,  TranslatorInterface $translator ): Response
    {
        $this->em->remove($matiere);
        $this->em->flush();
        $this->addFlash('warning', $translator->trans('matiere.form_warning'));
        return $this->redirectToRoute('app_matiere');
    }

}

