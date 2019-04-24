<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Cv
 *
 * @ORM\Table(name="cv", indexes={@ORM\Index(name="id_order", columns={"id_order"}), @ORM\Index(name="id_working_license", columns={"id_working_license"}), @ORM\Index(name="id_department", columns={"id_department"}), @ORM\Index(name="id_type_cv", columns={"id_type_cv"}), @ORM\Index(name="id_country", columns={"id_country"})})
 * @ORM\Entity
 */
class Cv
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_cv", type="uuid", nullable=false)
     * @ORM\Id
     */
    private $idCv;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=45, nullable=false)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=45, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=45, nullable=false)
     */
    private $lastname;

    /**
     * @var string
     *
     * @ORM\Column(name="street", type="string", length=45, nullable=false)
     */
    private $street;

    /**
     * @var string
     *
     * @ORM\Column(name="street_number", type="string", length=45, nullable=false)
     */
    private $streetNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="locality", type="string", length=45, nullable=false)
     */
    private $locality;

    /**
     * @var string
     *
     * @ORM\Column(name="postal_code", type="string", length=45, nullable=false)
     */
    private $postalCode;

    /**
     * @var string
     *
     * @ORM\Column(name="mail", type="string", length=45, nullable=false)
     */
    private $mail;

    /**
     * @var string
     *
     * @ORM\Column(name="phone_number", type="string", length=45, nullable=false)
     */
    private $phoneNumber;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="anniversary", type="datetime", nullable=false)
     */
    private $anniversary;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="creation_date", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $creationDate;

    /**
     * @var string|null
     *
     * @ORM\Column(name="presentation", type="blob", length=65535, nullable=true)
     */
    private $presentation;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="published_at", type="datetime", nullable=true)
     */
    private $publishedAt;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="active", type="boolean", nullable=true)
     */
    private $active = '0';

    /**
     * @var \Orders
     *
     * @ORM\ManyToOne(targetEntity="Orders")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_order", referencedColumnName="id_order")
     * })
     */
    private $idOrder;

    /**
     * @var \WorkingLicense
     *
     * @ORM\ManyToOne(targetEntity="WorkingLicense")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_working_license", referencedColumnName="id_working_license")
     * })
     */
    private $idWorkingLicense;

    /**
     * @var \Departments
     *
     * @ORM\ManyToOne(targetEntity="Departments")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_department", referencedColumnName="id_department")
     * })
     */
    private $idDepartment;

    /**
     * @var \TypeCv
     *
     * @ORM\ManyToOne(targetEntity="TypeCv")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_type_cv", referencedColumnName="id_type_cv")
     * })
     */
    private $idTypeCv;

    /**
     * @var \Countries
     *
     * @ORM\ManyToOne(targetEntity="Countries")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_country", referencedColumnName="id_country")
     * })
     */
    private $idCountry;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="DriverSLicense", inversedBy="idCv")
     * @ORM\JoinTable(name="cv_driver_s_license",
     *   joinColumns={
     *     @ORM\JoinColumn(name="id_cv", referencedColumnName="id_cv")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="id_driver_s_license", referencedColumnName="id_driver_s_license")
     *   }
     * )
     */
    private $idDriverSLicense;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Experiences", inversedBy="idCv")
     * @ORM\JoinTable(name="cv_experiences",
     *   joinColumns={
     *     @ORM\JoinColumn(name="id_cv", referencedColumnName="id_cv")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="id_experience", referencedColumnName="id_experience")
     *   }
     * )
     */
    private $idExperience;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Hobbies", inversedBy="idCv")
     * @ORM\JoinTable(name="cv_hobbies",
     *   joinColumns={
     *     @ORM\JoinColumn(name="id_cv", referencedColumnName="id_cv")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="id_hobbie", referencedColumnName="id_hobbie")
     *   }
     * )
     */
    private $idHobbie;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Skills", inversedBy="idCv")
     * @ORM\JoinTable(name="cv_skills",
     *   joinColumns={
     *     @ORM\JoinColumn(name="id_cv", referencedColumnName="id_cv")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="id_skill", referencedColumnName="id_skill")
     *   }
     * )
     */
    private $idSkill;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Training", inversedBy="idCv")
     * @ORM\JoinTable(name="cv_training",
     *   joinColumns={
     *     @ORM\JoinColumn(name="id_cv", referencedColumnName="id_cv")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="id_training", referencedColumnName="id_training")
     *   }
     * )
     */
    private $idTraining;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Portfolios", mappedBy="idCv")
     */
    private $idPortfolio;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idDriverSLicense = new \Doctrine\Common\Collections\ArrayCollection();
        $this->idExperience = new \Doctrine\Common\Collections\ArrayCollection();
        $this->idHobbie = new \Doctrine\Common\Collections\ArrayCollection();
        $this->idSkill = new \Doctrine\Common\Collections\ArrayCollection();
        $this->idTraining = new \Doctrine\Common\Collections\ArrayCollection();
        $this->idPortfolio = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getIdCv()
    {
        return $this->idCv;
    }

    public function setIdCv($id)
    {
        $this->idCv = $id;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function setStreet(string $street): self
    {
        $this->street = $street;

        return $this;
    }

    public function getStreetNumber(): ?string
    {
        return $this->streetNumber;
    }

    public function setStreetNumber(string $streetNumber): self
    {
        $this->streetNumber = $streetNumber;

        return $this;
    }

    public function getLocality(): ?string
    {
        return $this->locality;
    }

    public function setLocality(string $locality): self
    {
        $this->locality = $locality;

        return $this;
    }

    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }

    public function setPostalCode(string $postalCode): self
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(string $phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    public function getAnniversary(): ?\DateTimeInterface
    {
        return $this->anniversary;
    }

    public function setAnniversary(\DateTimeInterface $anniversary): self
    {
        $this->anniversary = $anniversary;

        return $this;
    }

    public function getCreationDate(): ?\DateTimeInterface
    {
        $date = new \DateTime('@'.strtotime('00:00:00'));//insert current timestamp      
        return $date;
    }

    public function setCreationDate(\DateTimeInterface $creationDate): self
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    public function getPresentation()
    {
        return $this->presentation;
    }

    public function setPresentation($presentation): self
    {
        $this->presentation = $presentation;

        return $this;
    }

    public function getPublishedAt(): ?\DateTimeInterface
    {
        return $this->publishedAt;
    }

    public function setPublishedAt(?\DateTimeInterface $publishedAt): self
    {
        $this->publishedAt = $publishedAt;

        return $this;
    }

    public function getActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(?bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    public function getIdOrder(): ?Orders
    {
        return $this->idOrder;
    }

    public function setIdOrder(?Orders $idOrder): self
    {
        $this->idOrder = $idOrder;

        return $this;
    }

    public function getIdWorkingLicense(): ?WorkingLicense
    {
        return $this->idWorkingLicense;
    }

    public function setIdWorkingLicense(?WorkingLicense $idWorkingLicense): self
    {
        $this->idWorkingLicense = $idWorkingLicense;

        return $this;
    }

    public function getIdDepartment(): ?Departments
    {
        return $this->idDepartment;
    }

    public function setIdDepartment(?Departments $idDepartment): self
    {
        $this->idDepartment = $idDepartment;

        return $this;
    }

    public function getIdTypeCv(): ?TypeCv
    {
        return $this->idTypeCv;
    }

    public function setIdTypeCv(?TypeCv $idTypeCv): self
    {
        $this->idTypeCv = $idTypeCv;

        return $this;
    }

    public function getIdCountry(): ?Countries
    {
        return $this->idCountry;
    }

    public function setIdCountry(?Countries $idCountry): self
    {
        $this->idCountry = $idCountry;

        return $this;
    }

    /**
     * @return Collection|DriverSLicense[]
     */
    public function getIdDriverSLicense(): Collection
    {
        return $this->idDriverSLicense;
    }

    public function addIdDriverSLicense(DriverSLicense $idDriverSLicense): self
    {
        if (!$this->idDriverSLicense->contains($idDriverSLicense)) {
            $this->idDriverSLicense[] = $idDriverSLicense;
        }

        return $this;
    }

    public function removeIdDriverSLicense(DriverSLicense $idDriverSLicense): self
    {
        if ($this->idDriverSLicense->contains($idDriverSLicense)) {
            $this->idDriverSLicense->removeElement($idDriverSLicense);
        }

        return $this;
    }

    /**
     * @return Collection|Experiences[]
     */
    public function getIdExperience(): Collection
    {
        return $this->idExperience;
    }

    public function addIdExperience(Experiences $idExperience): self
    {
        if (!$this->idExperience->contains($idExperience)) {
            $this->idExperience[] = $idExperience;
        }

        return $this;
    }

    public function removeIdExperience(Experiences $idExperience): self
    {
        if ($this->idExperience->contains($idExperience)) {
            $this->idExperience->removeElement($idExperience);
        }

        return $this;
    }

    /**
     * @return Collection|Hobbies[]
     */
    public function getIdHobbie(): Collection
    {
        return $this->idHobbie;
    }

    public function addIdHobbie(Hobbies $idHobbie): self
    {
        if (!$this->idHobbie->contains($idHobbie)) {
            $this->idHobbie[] = $idHobbie;
        }

        return $this;
    }

    public function removeIdHobbie(Hobbies $idHobbie): self
    {
        if ($this->idHobbie->contains($idHobbie)) {
            $this->idHobbie->removeElement($idHobbie);
        }

        return $this;
    }

    /**
     * @return Collection|Skills[]
     */
    public function getIdSkill(): Collection
    {
        return $this->idSkill;
    }

    public function addIdSkill(Skills $idSkill): self
    {
        if (!$this->idSkill->contains($idSkill)) {
            $this->idSkill[] = $idSkill;
        }

        return $this;
    }

    public function removeIdSkill(Skills $idSkill): self
    {
        if ($this->idSkill->contains($idSkill)) {
            $this->idSkill->removeElement($idSkill);
        }

        return $this;
    }

    /**
     * @return Collection|Training[]
     */
    public function getIdTraining(): Collection
    {
        return $this->idTraining;
    }

    public function addIdTraining(Training $idTraining): self
    {
        if (!$this->idTraining->contains($idTraining)) {
            $this->idTraining[] = $idTraining;
        }

        return $this;
    }

    public function removeIdTraining(Training $idTraining): self
    {
        if ($this->idTraining->contains($idTraining)) {
            $this->idTraining->removeElement($idTraining);
        }

        return $this;
    }

    /**
     * @return Collection|Portfolios[]
     */
    public function getIdPortfolio(): Collection
    {
        return $this->idPortfolio;
    }

    public function addIdPortfolio(Portfolios $idPortfolio): self
    {
        if (!$this->idPortfolio->contains($idPortfolio)) {
            $this->idPortfolio[] = $idPortfolio;
            $idPortfolio->addIdCv($this);
        }

        return $this;
    }

    public function removeIdPortfolio(Portfolios $idPortfolio): self
    {
        if ($this->idPortfolio->contains($idPortfolio)) {
            $this->idPortfolio->removeElement($idPortfolio);
            $idPortfolio->removeIdCv($this);
        }

        return $this;
    }

    public function __toString()
    {
        return $this->getName();
    }

}
