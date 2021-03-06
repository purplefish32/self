<?php

namespace Innova\SelfBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Proposition
 *
 * @ORM\Table("proposition")
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="Innova\SelfBundle\Repository\PropositionRepository")
 */

class Proposition
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
    * @ORM\ManyToOne(targetEntity="Subquestion", inversedBy="propositions", cascade={"persist"})
    */
    protected $subquestion;

    /**
    * @ORM\OneToMany(targetEntity="Answer", mappedBy="proposition", cascade={"remove"})
    */
    protected $answers;

    /**
    * @ORM\ManyToOne(targetEntity="Innova\SelfBundle\Entity\Media\Media")
    */
    protected $media;

    /**
     * @var boolean
     *
     * @ORM\Column(name="rightAnswer", type="boolean")
     */
    private $rightAnswer;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->answers = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * Set rightAnswer
     *
     * @param  boolean     $rightAnswer
     * @return Proposition
     */
    public function setRightAnswer($rightAnswer)
    {
        $this->rightAnswer = $rightAnswer;

        return $this;
    }

    /**
     * Get rightAnswer
     *
     * @return boolean
     */
    public function getRightAnswer()
    {
        return $this->rightAnswer;
    }

    /**
     * Set subquestion
     *
     * @param  \Innova\SelfBundle\Entity\Subquestion $subquestion
     * @return Proposition
     */
    public function setSubquestion(\Innova\SelfBundle\Entity\Subquestion $subquestion = null)
    {
        $this->subquestion = $subquestion;

        return $this;
    }

    /**
     * Get subquestion
     *
     * @return \Innova\SelfBundle\Entity\Subquestion
     */
    public function getSubquestion()
    {
        return $this->subquestion;
    }

    /**
     * Add answers
     *
     * @param  \Innova\SelfBundle\Entity\Answer $answers
     * @return Proposition
     */
    public function addAnswer(\Innova\SelfBundle\Entity\Answer $answers)
    {
        $this->answers[] = $answers;

        return $this;
    }

    /**
     * Remove answers
     *
     * @param \Innova\SelfBundle\Entity\Answer $answers
     */
    public function removeAnswer(\Innova\SelfBundle\Entity\Answer $answers)
    {
        $this->answers->removeElement($answers);
    }

    /**
     * Get answers
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAnswers()
    {
        return $this->answers;
    }

    /**
     * Set media
     *
     * @param  \Innova\SelfBundle\Entity\Media\Media $media
     * @return Proposition
     */
    public function setMedia(\Innova\SelfBundle\Entity\Media\Media $media = null)
    {
        $this->media = $media;

        return $this;
    }

    /**
     * Get media
     *
     * @return \Innova\SelfBundle\Entity\Media\Media
     */
    public function getMedia()
    {
        return $this->media;
    }
}
