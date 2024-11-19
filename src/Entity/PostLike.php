<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\PostLikeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PostLikeRepository::class)]
#[ORM\Table(name: 'post_likes')]
class PostLike
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'postLikes')]
    private ?Post $post = null;

    #[ORM\ManyToOne(inversedBy: 'postLikes')]
    private ?User $likeUser = null;

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

    public function getLikeUser(): ?User
    {
        return $this->likeUser;
    }

    public function setLikeUser(?User $likeUser): static
    {
        $this->likeUser = $likeUser;

        return $this;
    }
}
