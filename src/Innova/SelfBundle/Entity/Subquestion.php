<?php

namespace Innova\SelfBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Subquestion
 *
 * @ORM\Table("subquestion")
 * @ORM\Entity
 */
class Subquestion
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
    * @ORM\ManyToOne(targetEntity="Typology", inversedBy="subquestions")
    */
    protected $typology;

    /**
    * @ORM\ManyToOne(targetEntity="Innova\SelfBundle\Entity\Level")
    */
    protected $level;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    private $title;

    /**
    * @ORM\ManyToOne(targetEntity="Innova\SelfBundle\Entity\Media\Media")
    */
    protected $media;

    /**
    * @ORM\ManyToOne(targetEntity="Innova\SelfBundle\Entity\Media\Media")
    */
    protected $mediaAmorce;

    /**
    * @ORM\ManyToOne(targetEntity="Question", inversedBy="subquestions")
    */
    protected $question;

    /**
    * @ORM\OneToMany(targetEntity="Proposition", mappedBy="subquestion", cascade={"persist", "remove"})
    */
    protected $propositions;

    /**
    * @ORM\ManyToOne(targetEntity="Clue", cascade={"persist"})
    */
    protected $clue;

    /**
    * @ORM\ManyToOne(targetEntity="Innova\SelfBundle\Entity\Media\Media")
    */
    protected $mediaSyllable;

    /**
    * @ORM\OneToMany(targetEntity="Answer", mappedBy="subquestion")
    */
    protected $answers;

    /**
    * @ORM\ManyToMany(targetEntity="Innova\SelfBundle\Entity\QuestionnaireIdentity\Focus", inversedBy="subquestions")
    * @ORM\JoinTable(name="subquestion_focuses")
    */
    protected $focuses;

    /**
    * @ORM\ManyToMany(targetEntity="Innova\SelfBundle\Entity\QuestionnaireIdentity\CognitiveOperation", inversedBy="subquestionsMain")
    * @ORM\JoinTable(name="subquestion_cognitiveOpsMain")
    */
    protected $cognitiveOpsMain;

    /**
    * @ORM\ManyToMany(targetEntity="Innova\SelfBundle\Entity\QuestionnaireIdentity\CognitiveOperation", inversedBy="subquestionsSecondary")
    * @ORM\JoinTable(name="subquestion_cognitiveOpsSecondary")
    */
    protected $cognitiveOpsSecondary;

    /**
     * @var string
     *
     * @ORM\Column(name="difficultyIndex", type="string", length=255, nullable=true)
     */
    private $difficultyIndex;

    /**
     * @var string
     *
     * @ORM\Column(name="discriminationIndex", type="string", length=255, nullable=true)
     */
    private $discriminationIndex;

    /**
     *
     * @ORM\Column(name="displayAnswer", type="boolean")
     */
    private $displayAnswer;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->propositions = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set title
     *
     * @param  string      $title
     * @return Subquestion
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set typology
     *
     * @param  \Innova\SelfBundle\Entity\Typology $typology
     * @return Subquestion
     */
    public function setTypology(\Innova\SelfBundle\Entity\Typology $typology = null)
    {
        $this->typology = $typology;

        return $this;
    }

    /**
     * Get typology
     *
     * @return \Innova\SelfBundle\Entity\Typology
     */
    public function getTypology()
    {
        return $this->typology;
    }

    /**
     * Set media
     *
     * @param  \Innova\SelfBundle\Entity\Media\Media $media
     * @return Subquestion
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

    /**
     * Set question
     *
     * @param  \Innova\SelfBundle\Entity\Question $question
     * @return Subquestion
     */
    public function setQuestion(\Innova\SelfBundle\Entity\Question $question = null)
    {
        $this->question = $question;

        return $this;
    }

    /**
     * Get question
     *
     * @return \Innova\SelfBundle\Entity\Question
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * Add propositions
     *
     * @param  \Innova\SelfBundle\Entity\Proposition $propositions
     * @return Subquestion
     */
    public function addProposition(\Innova\SelfBundle\Entity\Proposition $propositions)
    {
        $this->propositions[] = $propositions;

        return $this;
    }

    /**
     * Remove propositions
     *
     * @param \Innova\SelfBundle\Entity\Proposition $propositions
     */
    public function removeProposition(\Innova\SelfBundle\Entity\Proposition $propositions)
    {
        $this->propositions->removeElement($propositions);
    }

    /**
     * Get propositions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPropositions()
    {
        return $this->propositions;
    }

    /**
     * Set mediaAmorce
     *
     * @param  \Innova\SelfBundle\Entity\Media\Media $mediaAmorce
     * @return Subquestion
     */
    public function setMediaAmorce(\Innova\SelfBundle\Entity\Media\Media $mediaAmorce = null)
    {
        $this->mediaAmorce = $mediaAmorce;

        return $this;
    }

    /**
     * Get mediaAmorce
     *
     * @return \Innova\SelfBundle\Entity\Media\Media
     */
    public function getMediaAmorce()
    {
        return $this->mediaAmorce;
    }

    /**
     * Add answers
     *
     * @param  \Innova\SelfBundle\Entity\Answer $answers
     * @return Subquestion
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
     * @return Answer[]
     */
    public function getAnswers()
    {
        return $this->answers;
    }

    /**
     * Set mediaSyllable
     *
     * @param  \Innova\SelfBundle\Entity\Media\Media $mediaSyllable
     * @return Subquestion
     */
    public function setMediaSyllable(\Innova\SelfBundle\Entity\Media\Media $mediaSyllable = null)
    {
        $this->mediaSyllable = $mediaSyllable;

        return $this;
    }

    /**
     * Get mediaSyllable
     *
     * @return \Innova\SelfBundle\Entity\Media\Media
     */
    public function getMediaSyllable()
    {
        return $this->mediaSyllable;
    }

    /**
     * Set clue
     *
     * @param  \Innova\SelfBundle\Entity\Clue $clue
     * @return Subquestion
     */
    public function setClue(\Innova\SelfBundle\Entity\Clue $clue = null)
    {
        $this->clue = $clue;

        return $this;
    }

    /**
     * Get clue
     *
     * @return \Innova\SelfBundle\Entity\Clue
     */
    public function getClue()
    {
        return $this->clue;
    }

    /**
     * Set displayAnswer
     *
     * @param  boolean     $displayAnswer
     * @return Subquestion
     */
    public function setDisplayAnswer($displayAnswer)
    {
        $this->displayAnswer = $displayAnswer;

        return $this;
    }

    /**
     * Get displayAnswer
     *
     * @return boolean
     */
    public function getDisplayAnswer()
    {
        return $this->displayAnswer;
    }

    /**
     * Add focuses
     *
     * @param  \Innova\SelfBundle\Entity\QuestionnaireIdentity\Focus $focuses
     * @return Subquestion
     */
    public function addFocuse(\Innova\SelfBundle\Entity\QuestionnaireIdentity\Focus $focuses)
    {
        $this->focuses[] = $focuses;

        return $this;
    }

    /**
     * Add focuses collection
     * @param QuestionnaireIdentity\Focus[] $focuses
     */
    public function addFocuses($focuses)
    {
        foreach ($focuses as $focus) {
            $this->focuses[] = $focus;
        }

        return $this;
    }

    /**
     * Remove focuses
     *
     * @param \Innova\SelfBundle\Entity\QuestionnaireIdentity\Focus $focuses
     */
    public function removeFocuse(\Innova\SelfBundle\Entity\QuestionnaireIdentity\Focus $focuses)
    {
        $this->focuses->removeElement($focuses);
    }

    /**
     * Get focuses
     *
     * @return QuestionnaireIdentity\Focus[]
     */
    public function getFocuses()
    {
        return $this->focuses;
    }

    /**
     * Add cognitiveOpsMain
     *
     * @param  \Innova\SelfBundle\Entity\QuestionnaireIdentity\CognitiveOperation $cognitiveOpsMain
     * @return Subquestion
     */
    public function addCognitiveOpsMain(\Innova\SelfBundle\Entity\QuestionnaireIdentity\CognitiveOperation $cognitiveOpsMain)
    {
        $this->cognitiveOpsMain[] = $cognitiveOpsMain;

        return $this;
    }

    /**
     * Add cognitiveOpsMain collection
     * @param QuestionnaireIdentity\CognitiveOperation[] $cognitiveOpsMain
     */
    public function addCognitiveOpsMains($cognitiveOpsMain)
    {
        foreach ($cognitiveOpsMain as $cognitiveOpMain) {
            $this->cognitiveOpsMain[] = $cognitiveOpMain;
        }

        return $this;
    }

    /**
     * Remove cognitiveOpsMain
     *
     * @param \Innova\SelfBundle\Entity\QuestionnaireIdentity\CognitiveOperation $cognitiveOpsMain
     */
    public function removeCognitiveOpsMain(\Innova\SelfBundle\Entity\QuestionnaireIdentity\CognitiveOperation $cognitiveOpsMain)
    {
        $this->cognitiveOpsMain->removeElement($cognitiveOpsMain);
    }

    /**
     * Get cognitiveOpsMain
     *
     * @return QuestionnaireIdentity\CognitiveOperation[]
     */
    public function getCognitiveOpsMain()
    {
        return $this->cognitiveOpsMain;
    }

    /**
     * Add cognitiveOpsSecondary
     *
     * @param  \Innova\SelfBundle\Entity\QuestionnaireIdentity\CognitiveOperation $cognitiveOpsSecondary
     * @return Subquestion
     */
    public function addCognitiveOpsSecondary(\Innova\SelfBundle\Entity\QuestionnaireIdentity\CognitiveOperation $cognitiveOpsSecondary)
    {
        $this->cognitiveOpsSecondary[] = $cognitiveOpsSecondary;

        return $this;
    }

    /**
     * Add cognitiveOpsSecondary collection
     * @param QuestionnaireIdentity\CognitiveOperation[] $cognitiveOpsSecondary
     */
    public function addCognitiveOpsSecondarys($cognitiveOpsSecondary)
    {
        foreach ($cognitiveOpsSecondary as $cognitiveOpSecondary) {
            $this->cognitiveOpsSecondary[] = $cognitiveOpSecondary;
        }

        return $this;
    }

    /**
     * Remove cognitiveOpsSecondary
     *
     * @param \Innova\SelfBundle\Entity\QuestionnaireIdentity\CognitiveOperation $cognitiveOpsSecondary
     */
    public function removeCognitiveOpsSecondary(\Innova\SelfBundle\Entity\QuestionnaireIdentity\CognitiveOperation $cognitiveOpsSecondary)
    {
        $this->cognitiveOpsSecondary->removeElement($cognitiveOpsSecondary);
    }

    /**
     * Get cognitiveOpsSecondary
     *
     * @return QuestionnaireIdentity\CognitiveOperation[]
     */
    public function getCognitiveOpsSecondary()
    {
        return $this->cognitiveOpsSecondary;
    }

    /**
     * Set level
     *
     * @param \Innova\SelfBundle\Entity\Level $level
     *
     * @return Subquestion
     */
    public function setLevel(\Innova\SelfBundle\Entity\Level $level = null)
    {
        $this->level = $level;

        return $this;
    }

    /**
     * Get level
     *
     * @return \Innova\SelfBundle\Entity\Level
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * Add focus
     *
     * @param \Innova\SelfBundle\Entity\QuestionnaireIdentity\Focus $focus
     *
     * @return Subquestion
     */
    public function addFocus(\Innova\SelfBundle\Entity\QuestionnaireIdentity\Focus $focus)
    {
        $this->focuses[] = $focus;

        return $this;
    }

    /**
     * Remove focus
     *
     * @param \Innova\SelfBundle\Entity\QuestionnaireIdentity\Focus $focus
     */
    public function removeFocus(\Innova\SelfBundle\Entity\QuestionnaireIdentity\Focus $focus)
    {
        $this->focuses->removeElement($focus);
    }

    /**
     * Set difficultyIndex
     *
     * @param string $difficultyIndex
     *
     * @return Subquestion
     */
    public function setDifficultyIndex($difficultyIndex)
    {
        $this->difficultyIndex = $difficultyIndex;

        return $this;
    }

    /**
     * Get difficultyIndex
     *
     * @return string
     */
    public function getDifficultyIndex()
    {
        return $this->difficultyIndex;
    }

    /**
     * Set discriminationIndex
     *
     * @param string $discriminationIndex
     *
     * @return Subquestion
     */
    public function setDiscriminationIndex($discriminationIndex)
    {
        $this->discriminationIndex = $discriminationIndex;

        return $this;
    }

    /**
     * Get discriminationIndex
     *
     * @return string
     */
    public function getDiscriminationIndex()
    {
        return $this->discriminationIndex;
    }
}
