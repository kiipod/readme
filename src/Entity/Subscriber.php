<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\SubscriberRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SubscriberRepository::class)]
class Subscriber
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'subscribers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $subscriber = null;

    #[ORM\ManyToOne(inversedBy: 'subscribeds')]
    private ?User $subscribed = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSubscriber(): ?User
    {
        return $this->subscriber;
    }

    public function setSubscriber(?User $subscriber): static
    {
        $this->subscriber = $subscriber;

        return $this;
    }

    public function getSubscribed(): ?User
    {
        return $this->subscribed;
    }

    public function setSubscribed(?User $subscribed): static
    {
        $this->subscribed = $subscribed;

        return $this;
    }
}
