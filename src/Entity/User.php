<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: 'users')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
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

    #[ORM\Column(nullable: true)]
    private ?array $roles = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $created_at = null;

    /**
     * @var Collection<int, Chat>
     */
    #[ORM\OneToMany(targetEntity: Chat::class, mappedBy: 'sender', orphanRemoval: true)]
    private Collection $senders;

    /**
     * @var Collection<int, Chat>
     */
    #[ORM\OneToMany(targetEntity: Chat::class, mappedBy: 'recipient', orphanRemoval: true)]
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

    /**
     * @var Collection<int, PostLike>
     */
    #[ORM\OneToMany(targetEntity: PostLike::class, mappedBy: 'likeUser')]
    private Collection $postLikes;

    /**
     * @var Collection<int, Comment>
     */
    #[ORM\OneToMany(targetEntity: Comment::class, mappedBy: 'commentator')]
    private Collection $comments;

    /**
     * @var Collection<int, Post>
     */
    #[ORM\OneToMany(targetEntity: Post::class, mappedBy: 'creator')]
    private Collection $creators;

    /**
     * @var Collection<int, Repost>
     */
    #[ORM\OneToMany(targetEntity: Repost::class, mappedBy: 'repostUser')]
    private Collection $reposts;

    public function __construct()
    {
        $this->senders = new ArrayCollection();
        $this->recipients = new ArrayCollection();
        $this->subscribers = new ArrayCollection();
        $this->subscribeds = new ArrayCollection();
        $this->postLikes = new ArrayCollection();
        $this->comments = new ArrayCollection();
        $this->creators = new ArrayCollection();
        $this->reposts = new ArrayCollection();
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

    public function getRoles(): array
    {
        $roles = $this->roles;
        // гарантировать, что у каждого пользователя есть хотя бы ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function getUserIdentifier(): string
    {
        return (string) $this->email;
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
     * @return Collection<int, Chat>
     */
    public function getSenders(): Collection
    {
        return $this->senders;
    }

    public function addSender(Chat $sender): static
    {
        if (!$this->senders->contains($sender)) {
            $this->senders->add($sender);
            $sender->setSender($this);
        }

        return $this;
    }

    public function removeSender(Chat $sender): static
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
     * @return Collection<int, Chat>
     */
    public function getRecipients(): Collection
    {
        return $this->recipients;
    }

    public function addRecipient(Chat $recipient): static
    {
        if (!$this->recipients->contains($recipient)) {
            $this->recipients->add($recipient);
            $recipient->setRecipient($this);
        }

        return $this;
    }

    public function removeRecipient(Chat $recipient): static
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

    /**
     * @return Collection<int, PostLike>
     */
    public function getPostLikes(): Collection
    {
        return $this->postLikes;
    }

    public function addPostLike(PostLike $postLike): static
    {
        if (!$this->postLikes->contains($postLike)) {
            $this->postLikes->add($postLike);
            $postLike->setLikeUser($this);
        }

        return $this;
    }

    public function removePostLike(PostLike $postLike): static
    {
        if ($this->postLikes->removeElement($postLike)) {
            // set the owning side to null (unless already changed)
            if ($postLike->getLikeUser() === $this) {
                $postLike->setLikeUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Comment>
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): static
    {
        if (!$this->comments->contains($comment)) {
            $this->comments->add($comment);
            $comment->setCommentator($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): static
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getCommentator() === $this) {
                $comment->setCommentator(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Post>
     */
    public function getCreators(): Collection
    {
        return $this->creators;
    }

    public function addCreator(Post $creator): static
    {
        if (!$this->creators->contains($creator)) {
            $this->creators->add($creator);
            $creator->setCreator($this);
        }

        return $this;
    }

    public function removeCreator(Post $creator): static
    {
        if ($this->creators->removeElement($creator)) {
            // set the owning side to null (unless already changed)
            if ($creator->getCreator() === $this) {
                $creator->setCreator(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Repost>
     */
    public function getReposts(): Collection
    {
        return $this->reposts;
    }

    public function addRepost(Repost $repost): static
    {
        if (!$this->reposts->contains($repost)) {
            $this->reposts->add($repost);
            $repost->setRepostUser($this);
        }

        return $this;
    }

    public function removeRepost(Repost $repost): static
    {
        if ($this->reposts->removeElement($repost)) {
            // set the owning side to null (unless already changed)
            if ($repost->getRepostUser() === $this) {
                $repost->setRepostUser(null);
            }
        }

        return $this;
    }
}
