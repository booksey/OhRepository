<?php

namespace App\Classes;

class UserData
{

    protected $chosenSpecialization;
    protected $graduationResults;
    protected $extraPoints;
    protected $calculatedStandardPoints;
    protected $calculatedExtraPoints;
    protected $calculateError;

    public function __construct($exampleData)
    {
        $this->setChosenSpecialization($exampleData);
        $this->setGraduationResults($exampleData);
        $this->setExtraPoints($exampleData);
        $this->calculateError = null;
    }

    /**
     * Gets chosenSpecializaton property (in example data: valasztott-szak)
     * @return mixed
     */
    public function getChosenSpecialization()
    {
        return $this->chosenSpecialization;
    }

    /**
     * Sets chosenSpecializaton property (in example data: valasztott-szak)
     */
    public function setChosenSpecialization($chosenSpecialization)
    {
        $this->chosenSpecialization = (object) $chosenSpecialization['valasztott-szak'];
    }

    /**
     * Gets graduationResults property (in example data: erettsegi-eredmenyek)
     * @return mixed
     */
    public function getGraduationResults()
    {
        return $this->graduationResults;
    }

    /**
     * Sets graduationResults property (in example data: erettsegi-eredmenyek)
     */
    public function setGraduationResults($graduationResults)
    {
        $this->graduationResults = (object) $graduationResults['erettsegi-eredmenyek'];
    }

    /**
     * Gets extrapoints property (in example data: tobbletpontok)
     * @return mixed
     */
    public function getExtrapoints()
    {
        return $this->extraPoints;
    }

    /**
     * Sets extraPoints property (in example data: tobbletpontok)
     */
    public function setExtraPoints($extraPoints)
    {
        $this->extraPoints = (object) $extraPoints['tobbletpontok'];
    }

    /**
     * Returns the calculated standard points or error array
     * @return mixed
     */
    public function getCalculatedStandardPoints()
    {
        return $this->calculatedStandardPoints;
    }

    /**
     * Returns the calculated extra points or error array
     * @return mixed
     */
    public function getCalculatedExtraPoints()
    {
        return $this->calculatedExtraPoints;
    }

    /**
     * Calculates standard and extra points for user
     * @return void
     */
    public function calculate()
    {
        $this->calculatedStandardPoints = 0;
        $this->calculatedExtraPoints = 0;
    }

}
