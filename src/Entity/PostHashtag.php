<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\PostHashtagRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PostHashtagRepository::class)]
class PostHashtag
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'postHashtags')]
    private ?Post $post = null;

    #[ORM\ManyToOne(inversedBy: 'postHashtags')]
    private ?Hashtag $hashtag = null;

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

    public function getHashtag(): ?Hashtag
    {
        return $this->hashtag;
    }

    public function setHashtag(?Hashtag $hashtag): static
    {
        $this->hashtag = $hashtag;

        return $this;
    }
}
