<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\PostRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PostRepository::class)]
class Post
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    private ?string $slug = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $text = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $video_link = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $author_quote = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $link = null;

    #[ORM\Column(type: Types::BIGINT)]
    private ?int $view_stats = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $created_at = null;

    /**
     * @var Collection<int, Comment>
     */
    #[ORM\OneToMany(targetEntity: Comment::class, mappedBy: 'post', orphanRemoval: true)]
    private Collection $comments;

    /**
     * @var Collection<int, PostLike>
     */
    #[ORM\OneToMany(targetEntity: PostLike::class, mappedBy: 'post')]
    private Collection $postLikes;

    /**
     * @var Collection<int, PostHashtag>
     */
    #[ORM\OneToMany(targetEntity: PostHashtag::class, mappedBy: 'post')]
    private Collection $postHashtags;

    #[ORM\ManyToOne(inversedBy: 'creators')]
    private ?User $creator = null;

    /**
     * @var Collection<int, Repost>
     */
    #[ORM\OneToMany(targetEntity: Repost::class, mappedBy: 'post')]
    private Collection $reposts;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?TypePost $type = null;

    public function __construct()
    {
        $this->comments = new ArrayCollection();
        $this->postLikes = new ArrayCollection();
        $this->postHashtags = new ArrayCollection();
        $this->reposts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): static
    {
        $this->slug = $slug;

        return $this;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): static
    {
        $this->text = $text;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getVideoLink(): ?string
    {
        return $this->video_link;
    }

    public function setVideoLink(?string $video_link): static
    {
        $this->video_link = $video_link;

        return $this;
    }

    public function getAuthorQuote(): ?string
    {
        return $this->author_quote;
    }

    public function setAuthorQuote(?string $author_quote): static
    {
        $this->author_quote = $author_quote;

        return $this;
    }

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function setLink(?string $link): static
    {
        $this->link = $link;

        return $this;
    }

    public function getViewStats(): ?string
    {
        return $this->view_stats;
    }

    public function setViewStats(int $view_stats): static
    {
        $this->view_stats = $view_stats;

        return $this;
    }

    public function getType(): ?TypePost
    {
        return $this->type;
    }

    public function setType(TypePost $type): static
    {
        $this->type = $type;

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
            $comment->setPost($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): static
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getPost() === $this) {
                $comment->setPost(null);
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
            $postLike->setPost($this);
        }

        return $this;
    }

    public function removePostLike(PostLike $postLike): static
    {
        if ($this->postLikes->removeElement($postLike)) {
            // set the owning side to null (unless already changed)
            if ($postLike->getPost() === $this) {
                $postLike->setPost(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, PostHashtag>
     */
    public function getPostHashtags(): Collection
    {
        return $this->postHashtags;
    }

    public function addPostHashtag(PostHashtag $postHashtag): static
    {
        if (!$this->postHashtags->contains($postHashtag)) {
            $this->postHashtags->add($postHashtag);
            $postHashtag->setPost($this);
        }

        return $this;
    }

    public function removePostHashtag(PostHashtag $postHashtag): static
    {
        if ($this->postHashtags->removeElement($postHashtag)) {
            // set the owning side to null (unless already changed)
            if ($postHashtag->getPost() === $this) {
                $postHashtag->setPost(null);
            }
        }

        return $this;
    }

    public function getCreator(): ?User
    {
        return $this->creator;
    }

    public function setCreator(?User $creator): static
    {
        $this->creator = $creator;

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
            $repost->setPost($this);
        }

        return $this;
    }

    public function removeRepost(Repost $repost): static
    {
        if ($this->reposts->removeElement($repost)) {
            // set the owning side to null (unless already changed)
            if ($repost->getPost() === $this) {
                $repost->setPost(null);
            }
        }

        return $this;
    }
}
