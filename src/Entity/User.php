<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $login = null;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $avatar_file = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $created_at = null;

    /**
     * @var Collection<int, Messenger>
     */
    #[ORM\OneToMany(targetEntity: Messenger::class, mappedBy: 'sender', orphanRemoval: true)]
    private Collection $senders;

    /**
     * @var Collection<int, Messenger>
     */
    #[ORM\OneToMany(targetEntity: Messenger::class, mappedBy: 'recipient', orphanRemoval: true)]
    private Collection $recipients;

    /**
     * @var Collection<int, Subscriber>
     */
    #[ORM\OneToMany(targetEntity: Subscriber::class, mappedBy: 'subscriber', orphanRemoval: true)]
    private Collection $subscribers;

    /**
     * @var Collection<int, Subscriber>
     */
    #[ORM\OneToMany(targetEntity: Subscriber::class, mappedBy: 'subscribed')]
    private Collection $subscribeds;

    public function __construct()
    {
        $this->senders = new ArrayCollection();
        $this->recipients = new ArrayCollection();
        $this->subscribers = new ArrayCollection();
        $this->subscribeds = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(string $login): static
    {
        $this->login = $login;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function getAvatarFile(): ?string
    {
        return $this->avatar_file;
    }

    public function setAvatarFile(?string $avatar_file): static
    {
        $this->avatar_file = $avatar_file;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): static
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * @return Collection<int, Messenger>
     */
    public function getSenders(): Collection
    {
        return $this->senders;
    }

    public function addSender(Messenger $sender): static
    {
        if (!$this->senders->contains($sender)) {
            $this->senders->add($sender);
            $sender->setSender($this);
        }

        return $this;
    }

    public function removeSender(Messenger $sender): static
    {
        if ($this->senders->removeElement($sender)) {
            // set the owning side to null (unless already changed)
            if ($sender->getSender() === $this) {
                $sender->setSender(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Messenger>
     */
    public function getRecipients(): Collection
    {
        return $this->recipients;
    }

    public function addRecipient(Messenger $recipient): static
    {
        if (!$this->recipients->contains($recipient)) {
            $this->recipients->add($recipient);
            $recipient->setRecipient($this);
        }

        return $this;
    }

    public function removeRecipient(Messenger $recipient): static
    {
        if ($this->recipients->removeElement($recipient)) {
            // set the owning side to null (unless already changed)
            if ($recipient->getRecipient() === $this) {
                $recipient->setRecipient(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Subscriber>
     */
    public function getSubscribers(): Collection
    {
        return $this->subscribers;
    }

    public function addSubscriber(Subscriber $subscriber): static
    {
        if (!$this->subscribers->contains($subscriber)) {
            $this->subscribers->add($subscriber);
            $subscriber->setSubscriber($this);
        }

        return $this;
    }

    public function removeSubscriber(Subscriber $subscriber): static
    {
        if ($this->subscribers->removeElement($subscriber)) {
            // set the owning side to null (unless already changed)
            if ($subscriber->getSubscriber() === $this) {
                $subscriber->setSubscriber(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Subscriber>
     */
    public function getSubscribeds(): Collection
    {
        return $this->subscribeds;
    }

    public function addSubscribed(Subscriber $subscribed): static
    {
        if (!$this->subscribeds->contains($subscribed)) {
            $this->subscribeds->add($subscribed);
            $subscribed->setSubscribed($this);
        }

        return $this;
    }

    public function removeSubscribed(Subscriber $subscribed): static
    {
        if ($this->subscribeds->removeElement($subscribed)) {
            // set the owning side to null (unless already changed)
            if ($subscribed->getSubscribed() === $this) {
                $subscribed->setSubscribed(null);
            }
        }

        return $this;
    }
}
