<?php

namespace TDN\QuizBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TDN\QuizBundle\Entity\QuestionQuiz
 */
class QuestionQuiz
{
    /**
     * @var integer $ordre
     */
    private $ordre;

    /**
     * @var string $question
     */
    private $question;

    /**
     * @var string $setReponses
     */
    private $setReponses;

    /**
     * @var integer $illustration
     */
    private $illustration;

    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var TDN\QuizBundle\Entity\Quiz
     */
    private $lnQuiz;


    /**
     * Set ordre
     *
     * @param integer $ordre
     * @return QuestionQuiz
     */
    public function setOrdre($ordre)
    {
        $this->ordre = $ordre;
    
        return $this;
    }

    /**
     * Get ordre
     *
     * @return integer 
     */
    public function getOrdre()
    {
        return $this->ordre;
    }

    /**
     * Set question
     *
     * @param string $question
     * @return QuestionQuiz
     */
    public function setQuestion($question)
    {
        $this->question = $question;
    
        return $this;
    }

    /**
     * Get question
     *
     * @return string 
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * Set setReponses
     *
     * @param string $setReponses
     * @return QuestionQuiz
     */
    public function setSetReponses($setReponses)
    {
        $this->setReponses = $setReponses;
    
        return $this;
    }

    /**
     * Get setReponses
     *
     * @return string 
     */
    public function getSetReponses()
    {
        return $this->setReponses;
    }

    /**
     * Set illustration
     *
     * @param integer $illustration
     * @return QuestionQuiz
     */
    public function setIllustration($illustration)
    {
        $this->illustration = $illustration;
    
        return $this;
    }

    /**
     * Get illustration
     *
     * @return integer 
     */
    public function getIllustration()
    {
        return $this->illustration;
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
     * Set lnQuiz
     *
     * @param TDN\QuizBundle\Entity\Quiz $lnQuiz
     * @return QuestionQuiz
     */
    public function setLnQuiz(\TDN\QuizBundle\Entity\Quiz $lnQuiz = null)
    {
        $this->lnQuiz = $lnQuiz;
    
        return $this;
    }

    /**
     * Get lnQuiz
     *
     * @return TDN\QuizBundle\Entity\Quiz 
     */
    public function getLnQuiz()
    {
        return $this->lnQuiz;
    }
}
