<?php

namespace App\Entity;

use App\Repository\FavoriteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FavoriteRepository::class)
 */
class Favorite
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $article_url;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, mappedBy="fav")
     */
    private $id_user;

    public function __construct()
    {
        $this->id_user = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getArticleUrl(): ?string
    {
        return $this->article_url;
    }

    public function setArticleUrl(string $article_url): self
    {
        $this->article_url = $article_url;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getIdUser(): Collection
    {
        return $this->id_user;
    }

    public function addIdUser(User $idUser): self
    {
        if (!$this->id_user->contains($idUser)) {
            $this->id_user[] = $idUser;
            $idUser->addFav($this);
        }

        return $this;
    }

    public function removeIdUser(User $idUser): self
    {
        if ($this->id_user->contains($idUser)) {
            $this->id_user->removeElement($idUser);
            $idUser->removeFav($this);
        }

        return $this;
    }
}
