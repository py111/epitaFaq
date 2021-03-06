<?php

namespace Epita\EpitaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * resource
 *
 * @ORM\Table(name="resource")
 * @ORM\Entity(repositoryClass="Epita\EpitaBundle\Entity\resourceRepository")
 */
class resource
{
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
     * @ORM\ManyToOne(targetEntity="questionanswer", inversedBy="resource")
     * @ORM\JoinColumn(name="que_id", referencedColumnName="id")
     */
    private $queId;

    /**
     * @var Array Collection
     *
     * @ORM\Column(name="resource", type="string", length=1000)
     */
    private $resource;


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
     * Set queId
     *
     * @param integer $queId
     *
     * @return resource
     */
    public function setQueId($queId)
    {
        $this->queId = $queId;

        return $this;
    }

    /**
     * Get queId
     *
     * @return integer
     */
    public function getQueId()
    {
        return $this->queId;
    }

    /**
     * Set resource
     *
     * @param string $resource
     *
     * @return resource
     */
    public function setResource($resource)
    {
        $this->resource = $resource;

        return $this;
    }

    /**
     * Get resource
     *
     * @return string
     */
    public function getResource()
    {
        return $this->resource;
    }
    
    public function __toString() {
        return $this->getResource();
    }
}
