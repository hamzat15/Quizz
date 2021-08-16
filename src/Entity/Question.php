<?php
 
namespace App\Entity;
 
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
 
/**
 * Question
 *
 * @ORM\Table(name="question")
 * @ORM\Entity
 */
class Question
{
 /**
 * @var int
 *
 * @ORM\Column(name="id", type="integer", nullable=false)
 * @ORM\Id
 * @ORM\GeneratedValue(strategy="IDENTITY")
 */
 private $id;
 
 /**
 * @var int|null
 *
 * @ORM\Column(name="id_categorie", type="integer", nullable=true)
 */
 private $idCategorie;
 
 /**
 * @var string|null
 *
 * @ORM\Column(name="question", type="string", length=255, nullable=true)
 */
 private $question;

    /**
     * @ORM\OneToMany(targetEntity=Reponse::class, mappedBy="question", orphanRemoval=true)
     */
    private $reponse;

    public function __construct()
    {
        $this->reponse = new ArrayCollection();
    }
 
 public function getId(): ?int
                   {
                   return $this->id;
                   }
 
 public function getIdCategorie(): ?int
                   {
                   return $this->idCategorie;
                   }
 
 public function setIdCategorie(?int $idCategorie): self
                   {
                   $this->idCategorie = $idCategorie;
                   
                   return $this;
                   }
 
 public function getQuestion(): ?string
                   {
                   return $this->question;
                   }
 
 public function setQuestion(?string $question): self
                   {
                   $this->question = $question;
                   
                   return $this;
                   }

    /**
     * @return Collection|Reponse[]
     */
    public function getReponse(): Collection
    {
        return $this->reponse;
    }

    public function addReponse(Reponse $reponse): self
    {
        if (!$this->reponse->contains($reponse)) {
            $this->reponse[] = $reponse;
            $reponse->setQuestion($this);
        }

        return $this;
    }

    public function removeReponse(Reponse $reponse): self
    {
        if ($this->reponse->removeElement($reponse)) {
            // set the owning side to null (unless already changed)
            if ($reponse->getQuestion() === $this) {
                $reponse->setQuestion(null);
            }
        }

        return $this;
    }
 
}