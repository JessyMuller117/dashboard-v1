<?php

namespace App\Controller;

use App\Entity\MessageCM;
use App\Form\MessageCMType;
use App\Repository\MessageCMRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/client/message/cm')]
class MessageCMController extends AbstractController
{
    #[Route('/', name: 'app_message_cm_index', methods: ['GET'])]
    public function index(MessageCMRepository $messageCMRepository): Response
    {
        return $this->render('message_cm/index.html.twig', [
            'message_cms' => $messageCMRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_message_cm_new', methods: ['GET', 'POST'])]
    public function new(Request $request, MessageCMRepository $messageCMRepository): Response
    {
        $messageCM = new MessageCM();
        $form = $this->createForm(MessageCMType::class, $messageCM);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $messageCMRepository->add($messageCM);
            return $this->redirectToRoute('app_message_cm_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('message_cm/new.html.twig', [
            'message_cm' => $messageCM,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_message_cm_show', methods: ['GET'])]
    public function show(MessageCM $messageCM): Response
    {
        return $this->render('message_cm/show.html.twig', [
            'message_cm' => $messageCM,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_message_cm_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, MessageCM $messageCM, MessageCMRepository $messageCMRepository): Response
    {
        $form = $this->createForm(MessageCMType::class, $messageCM);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $messageCMRepository->add($messageCM);
            return $this->redirectToRoute('app_message_cm_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('message_cm/edit.html.twig', [
            'message_cm' => $messageCM,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_message_cm_delete', methods: ['POST'])]
    public function delete(Request $request, MessageCM $messageCM, MessageCMRepository $messageCMRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$messageCM->getId(), $request->request->get('_token'))) {
            $messageCMRepository->remove($messageCM);
        }

        return $this->redirectToRoute('app_message_cm_index', [], Response::HTTP_SEE_OTHER);
    }
}
