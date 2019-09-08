<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Portfolios
 *
 * @ORM\Table(name="portfolios", indexes={@ORM\Index(name="id_header", columns={"id_header"}), @ORM\Index(name="id_navbar", columns={"id_navbar"}), @ORM\Index(name="id_menu_content", columns={"id_menu_content"}), @ORM\Index(name="id_widget", columns={"id_widget"}), @ORM\Index(name="id_content", columns={"id_content"}), @ORM\Index(name="id_footer", columns={"id_footer"}), @ORM\Index(name="id", columns={"id"})})
 * @ORM\Entity
 */
class Portfolios
{

    //user embed form for id

    /**
     * @Assert\Type(type="App\Entity\User")
     * @Assert\Valid
     */
    protected $user;


    public function getUser()
    {
        return $this->user;
    }

    public function setUser(User $user = null)
    {
        $this->user = $user;
    }

    // end user embed form for id

    //cv embed form for idCv

    /**
     * @Assert\Type(type="App\Entity\User")
     * @Assert\Valid
     */
    protected $cvs;


    public function getCvs()
    {
        return $this->cvs;
    }

    public function setCvs(Cv $cvs = null)
    {
        $this->cvs = $cvs;
    }

    // end cv embed form for idCv
    //cv embed form for idCv

    /**
     * @Assert\Type(type="App\Entity\User")
     * @Assert\Valid
     */
    protected $gallery;


    public function getGallery()
    {
        return $this->gallery;
    }

    public function setGallery(Galleries $gallery = null)
    {
        $this->cvs = $gallery;
    }

    // end cv embed form for idCv

    /**
     * @var int
     *
     * @ORM\Column(name="id_portfolio", type="uuid", nullable=false)
     * @ORM\Id
     */
    private $idPortfolio;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=45, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=45, nullable=false)
     */
    private $slug;

    /**
     * @var string|null
     *
     * @ORM\Column(name="descn", type="blob", length=65535, nullable=true)
     */
    private $descn;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="creation_date", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $creationDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="published_at", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $publishedAt;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="active", type="boolean", nullable=true)
     */
    private $active = '0';

    /**
     * @var \Header
     *
     * @ORM\ManyToOne(targetEntity="Header")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_header", referencedColumnName="id_header")
     * })
     */
    private $idHeader;

    /**
     * @var \Navbar
     *
     * @ORM\ManyToOne(targetEntity="Navbar")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_navbar", referencedColumnName="id_navbar")
     * })
     */
    private $idNavbar;

    /**
     * @var \MenuContent
     *
     * @ORM\ManyToOne(targetEntity="MenuContent")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_menu_content", referencedColumnName="id_menu_content")
     * })
     */
    private $idMenuContent;

    /**
     * @var \Widget
     *
     * @ORM\ManyToOne(targetEntity="Widget")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_widget", referencedColumnName="id_widget")
     * })
     */
    private $idWidget;

    /**
     * @var \Content
     *
     * @ORM\ManyToOne(targetEntity="Content")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_content", referencedColumnName="id_content")
     * })
     */
    private $idContent;

    /**
     * @var \Footer
     *
     * @ORM\ManyToOne(targetEntity="Footer")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_footer", referencedColumnName="id_footer")
     * })
     */
    private $idFooter;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id", referencedColumnName="id")
     * })
     */
    private $id;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Applications", inversedBy="idPortfolio")
     * @ORM\JoinTable(name="portfolios_applications",
     *   joinColumns={
     *     @ORM\JoinColumn(name="id_portfolio", referencedColumnName="id_portfolio")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="id_app", referencedColumnName="id_app")
     *   }
     * )
     */
    private $idApp;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Cv", inversedBy="idPortfolio")
     * @ORM\JoinTable(name="portfolios_cv",
     *   joinColumns={
     *     @ORM\JoinColumn(name="id_portfolio", referencedColumnName="id_portfolio")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="id_cv", referencedColumnName="id_cv")
     *   }
     * )
     */
    private $idCv;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Galleries", inversedBy="idPortfolio")
     * @ORM\JoinTable(name="portfolios_galleries",
     *   joinColumns={
     *     @ORM\JoinColumn(name="id_portfolio", referencedColumnName="id_portfolio")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="id_gallery", referencedColumnName="id_gallery")
     *   }
     * )
     */
    private $idGallery;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Projects", inversedBy="idPortfolio")
     * @ORM\JoinTable(name="portfolios_projects",
     *   joinColumns={
     *     @ORM\JoinColumn(name="id_portfolio", referencedColumnName="id_portfolio")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="id_project", referencedColumnName="id_project")
     *   }
     * )
     */
    private $idProject;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Websites", inversedBy="idPortfolio")
     * @ORM\JoinTable(name="portfolios_websites",
     *   joinColumns={
     *     @ORM\JoinColumn(name="id_portfolio", referencedColumnName="id_portfolio")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="id_web", referencedColumnName="id_web")
     *   }
     * )
     */
    private $idWeb;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idApp = new \Doctrine\Common\Collections\ArrayCollection();
        $this->idCv = new \Doctrine\Common\Collections\ArrayCollection();
        $this->idGallery = new \Doctrine\Common\Collections\ArrayCollection();
        $this->idProject = new \Doctrine\Common\Collections\ArrayCollection();
        $this->idWeb = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getIdPortfolio()
    {
        return $this->idPortfolio;
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

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getDescn()
    {
        return $this->descn;
    }

    public function setDescn($descn): self
    {
        $this->descn = $descn;

        return $this;
    }

    public function setidPortfolio($idPortfolio): self
    {
        $this->idPortfolio = $idPortfolio;

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

    public function getPublishedAt(): ?\DateTimeInterface
    {
        return $this->publishedAt;
    }

    public function setPublishedAt(\DateTimeInterface $publishedAt): self
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

    public function getIdHeader(): ?Header
    {
        return $this->idHeader;
    }

    public function setIdHeader(?Header $idHeader): self
    {
        $this->idHeader = $idHeader;

        return $this;
    }

    public function getIdNavbar(): ?Navbar
    {
        return $this->idNavbar;
    }

    public function setIdNavbar(?Navbar $idNavbar): self
    {
        $this->idNavbar = $idNavbar;

        return $this;
    }

    public function getIdMenuContent(): ?MenuContent
    {
        return $this->idMenuContent;
    }

    public function setIdMenuContent(?MenuContent $idMenuContent): self
    {
        $this->idMenuContent = $idMenuContent;

        return $this;
    }

    public function getIdWidget(): ?Widget
    {
        return $this->idWidget;
    }

    public function setIdWidget(?Widget $idWidget): self
    {
        $this->idWidget = $idWidget;

        return $this;
    }

    public function getIdContent(): ?Content
    {
        return $this->idContent;
    }

    public function setIdContent(?Content $idContent): self
    {
        $this->idContent = $idContent;

        return $this;
    }

    public function getIdFooter(): ?Footer
    {
        return $this->idFooter;
    }

    public function setIdFooter(?Footer $idFooter): self
    {
        $this->idFooter = $idFooter;

        return $this;
    }

    public function getId(): ?User
    {
        return $this->id;
    }

    public function setId(?User $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return Collection|Applications[]
     */
    public function getIdApp(): Collection
    {
        return $this->idApp;
    }

    public function addIdApp(Applications $idApp): self
    {
        if (!$this->idApp->contains($idApp)) {
            $this->idApp[] = $idApp;
        }

        return $this;
    }

    public function removeIdApp(Applications $idApp): self
    {
        if ($this->idApp->contains($idApp)) {
            $this->idApp->removeElement($idApp);
        }

        return $this;
    }

    /**
     * @return Collection|Cv[]
     */
    public function getIdCv(): Collection
    {
        return $this->idCv;
    }

    public function addIdCv(Cv $idCv): self
    {
        if (!$this->idCv->contains($idCv)) {
            $this->idCv[] = $idCv;
        }

        return $this;
    }

    public function removeIdCv(Cv $idCv): self
    {
        if ($this->idCv->contains($idCv)) {
            $this->idCv->removeElement($idCv);
        }

        return $this;
    }

    /**
     * @return Collection|Galleries[]
     */
    public function getIdGallery(): Collection
    {
        return $this->idGallery;
    }

    public function addIdGallery(Galleries $idGallery): self
    {
        if (!$this->idGallery->contains($idGallery)) {
            $this->idGallery[] = $idGallery;
        }

        return $this;
    }

    public function removeIdGallery(Galleries $idGallery): self
    {
        if ($this->idGallery->contains($idGallery)) {
            $this->idGallery->removeElement($idGallery);
        }

        return $this;
    }

    /**
     * @return Collection|Projects[]
     */
    public function getIdProject(): Collection
    {
        return $this->idProject;
    }

    public function addIdProject(Projects $idProject): self
    {
        if (!$this->idProject->contains($idProject)) {
            $this->idProject[] = $idProject;
        }

        return $this;
    }

    public function removeIdProject(Projects $idProject): self
    {
        if ($this->idProject->contains($idProject)) {
            $this->idProject->removeElement($idProject);
        }

        return $this;
    }

    /**
     * @return Collection|Websites[]
     */
    public function getIdWeb(): Collection
    {
        return $this->idWeb;
    }

    public function addIdWeb(Websites $idWeb): self
    {
        if (!$this->idWeb->contains($idWeb)) {
            $this->idWeb[] = $idWeb;
        }

        return $this;
    }

    public function removeIdWeb(Websites $idWeb): self
    {
        if ($this->idWeb->contains($idWeb)) {
            $this->idWeb->removeElement($idWeb);
        }

        return $this;
    }

}
