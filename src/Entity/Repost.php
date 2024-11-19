<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\RepostRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RepostRepository::class)]
#[ORM\Table(name: 'reposts')]
class Repost
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'reposts')]
    private ?Post $post = null;

    #[ORM\ManyToOne(inversedBy: 'reposts')]
    private ?User $repostUser = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPost(): ?Post
    {
        return $this->post;
    }

    public function setPost(?Post $post): static
    {
        $this->post = $post;

        return $this;
    }

    public function getRepostUser(): ?User
    {
        return $this->repostUser;
    }

    public function setRepostUser(?User $repostUser): static
    {
        $this->repostUser = $repostUser;

        return $this;
    }
}
