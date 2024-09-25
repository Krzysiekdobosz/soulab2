<?php

namespace App\Service;

use App\Entity\ContactMessage;
use App\Repository\ContactMessageRepository;
use Doctrine\ORM\EntityManagerInterface;

class ContactMessageService
{
    private EntityManagerInterface $em;
    private ContactMessageRepository $repository;

    public function __construct(EntityManagerInterface $em, ContactMessageRepository $repository)
    {
        $this->em = $em;
        $this->repository = $repository;
    }

    public function createFromArray(array $data): ContactMessage
    {
        $contactMessage = new ContactMessage();
        $contactMessage->setFirstName($data['firstName'] ?? null);
        $contactMessage->setLastName($data['lastName'] ?? null);
        $contactMessage->setEmail($data['email'] ?? null);
        $contactMessage->setMessage($data['message'] ?? null);
        $contactMessage->setCreatedAt(new \DateTime());

        return $contactMessage;
    }

    public function save(ContactMessage $contactMessage): void
    {
        $this->em->persist($contactMessage);
        $this->em->flush();
    }

    public function getAll(): array
    {
        $messages = $this->repository->findAll();

        return array_map([$this, 'toArray'], $messages);
    }

    public function toArray(ContactMessage $contactMessage): array
    {
        return [
            'firstName' => $contactMessage->getFirstName(),
            'lastName' => $contactMessage->getLastName(),
            'email' => $contactMessage->getEmail(),
            'message' => $contactMessage->getMessage(),
            'createdAt' => $contactMessage->getCreatedAt()->format('Y-m-d H:i:s'),
        ];
    }
}
