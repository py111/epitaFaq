<?php

namespace Epita\EpitaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * questionanswer
 *
 * @ORM\Table(name="questionanswer")
 * @ORM\Entity(repositoryClass="Epita\EpitaBundle\Entity\questionanswerRepository")
 */
class questionanswer {


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
     * @ORM\ManyToOne(targetEntity="category", inversedBy="questionanswer")
     * @ORM\JoinColumn(name="cat_id", referencedColumnName="id")
     * 
     *
     */
    private $catId;
    
    /**
     * @var integer
     * 
     * @ORM\OneToMany(targetEntity="resource", mappedBy="queId")
     */
    private $resource;

    /**
     * @var string
     *
     * @ORM\Column(name="question", type="string", length=1000)
     */
    private $question;

    /**
     * @var string
     *
     * @ORM\Column(name="answer", type="string", length=1000)
     */
    private $answer;

    public function __construct() {
        $this->resource = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set catId
     *
     * @param integer $catId
     *
     * @return questionanswer
     */
    public function setCatId($catId) {
        $this->catId = $catId;

        return $this;
    }

    /**
     * Get catId
     *
     * @return integer
     */
    public function getCatId() {
        return $this->catId;
    }

    /**
     * Set question
     *
     * @param string $question
     *
     * @return questionanswer
     */
    public function setQuestion($question) {
        $this->question = $question;

        return $this;
    }

    /**
     * Get question
     *
     * @return string
     */
    public function getQuestion() {
        return $this->question;
    }

    /**
     * Set answer
     *
     * @param string $answer
     *
     * @return questionanswer
     */
    public function setAnswer($answer) {
        $this->answer = $answer;

        return $this;
    }

    /**
     * Get answer
     *
     * @return string
     */
    public function getAnswer() {
        return $this->answer;
    }

    /**
     * Add resource
     *
     * @param \Epita\EpitaBundle\Entity\resource $resource
     *
     * @return questionanswer
     */
    public function addResource(\Epita\EpitaBundle\Entity\resource $resource) {
        $this->resource[] = $resource;

        return $this;
    }

    /**
     * Remove resource
     *
     * @param  $resource
     */
    public function removeResource(\Epita\EpitaBundle\Entity\resource $resource) {
        $this->resource->removeElement($resource);
    }

    /**
     * Get resource
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getResource() {
        return $this->resource->toArray();
    }

    public function __toString() {
        return $this->getQuestion();
    }

}
