<?php

namespace App\Controller\Api;

use App\Service\ContactMessageService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/api/contact', name: 'api_contact_')]
class ContactController extends AbstractController
{
    private ContactMessageService $contactMessageService;

    public function __construct(ContactMessageService $contactMessageService)
    {
        $this->contactMessageService = $contactMessageService;
    }

    #[Route('', name: 'submit', methods: ['POST'])]
    public function submit(Request $request, ValidatorInterface $validator): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $contactMessage = $this->contactMessageService->createFromArray($data);

        // Walidacja danych
        $errors = $validator->validate($contactMessage);

        if (count($errors) > 0) {
            $errorsArray = [];

            foreach ($errors as $error) {
                $errorsArray[$error->getPropertyPath()] = $error->getMessage();
            }

            return new JsonResponse(['errors' => $errorsArray], 400);
        }

        // Zapis do bazy danych
        $this->contactMessageService->save($contactMessage);

        return new JsonResponse(['status' => 'success', 'data' => $this->contactMessageService->toArray($contactMessage)], 200);
    }

    #[Route('/messages', name: 'messages', methods: ['GET'])]
    public function getMessages(): JsonResponse
    {
        $messages = $this->contactMessageService->getAll();

        return new JsonResponse($messages);
    }
}
