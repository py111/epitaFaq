<?php

namespace Epita\EpitaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * category
 *
 * @ORM\Table(name="category")
 * @ORM\Entity(repositoryClass="Epita\EpitaBundle\Entity\categoryRepository")
 */
class category
{
    /**
     * @var ArrayCollection
     * 
     * @ORM\OneToMany(targetEntity="questionanswer", mappedBy="category")
     */
    private $questionanswer;
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     * @ORM\ManyToOne(targetEntity="admin", inversedBy="category")
     * @ORM\JoinColumn(name="admin_id", referencedColumnName="id")
     * 
     */
    private $adminId;

    /**
     * @var string
     *
     * @ORM\Column(name="category", type="string", length=30)
     */
    private $category;
    
    public function __construct() {
    $this->questionanswer = new ArrayCollection(); }


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set adminId
     *
     * @param integer $adminId
     *
     * @return category
     */
    public function setAdminId($adminId)
    {
        $this->adminId = $adminId;

        return $this;
    }

    /**
     * Get adminId
     *
     * @return integer
     */
    public function getAdminId()
    {
        return $this->adminId;
    }

    /**
     * Set category
     *
     * @param string $category
     *
     * @return category
     */
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return string
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Add questionanswer
     *
     * @param \Epita\EpitaBundle\Entity\questionanswer $questionanswer
     *
     * @return category
     */
    public function addQuestionanswer(\Epita\EpitaBundle\Entity\questionanswer $questionanswer)
    {
        $this->questionanswer[] = $questionanswer;

        return $this;
    }

    /**
     * Remove questionanswer
     *
     * @param \Epita\EpitaBundle\Entity\questionanswer $questionanswer
     */
    public function removeQuestionanswer(\Epita\EpitaBundle\Entity\questionanswer $questionanswer)
    {
        $this->questionanswer->removeElement($questionanswer);
    }

    /**
     * Get questionanswer
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getQuestionanswer()
    {
        return $this->questionanswer;
    }
    
        public function __toString() {
        return $this->getCategory();
    }
}
