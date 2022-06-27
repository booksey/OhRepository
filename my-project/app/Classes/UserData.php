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
        $this->setChosenSpecialization($exampleData['valasztott-szak']);
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
        $this->chosenSpecialization = implode(" ", [
            $chosenSpecialization['egyetem'],
            $chosenSpecialization['kar'],
            $chosenSpecialization['szak'],
        ]);
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
        /**
         * Lets calculate the standard points
         */
        $subjects = [
            'ELTE IK Programtervező informatikus' => [
                'mandatory' => ['matematika'],
                'non-mandatory' => ['biológia', 'fizika', 'informatika', 'kémia'],
            ],
        ];
        /**
         * Mindkét szakra ugyanaz a logika, csak 1 fajta szerepelt az inputban
         */
        $chosenSpecilization = $this->getChosenSpecialization();
        $mandatorySubjects = $subjects[$chosenSpecilization]['mandatory'];
        $nonMandatorySubjects = $subjects[$chosenSpecilization]['non-mandatory'];
        $graduationResults = $this->getGraduationResults();

        $mandatoryPoints = 0;
        $nonMandatoryPoints = 0;
        $calculatedExtraPoints = 0;

        foreach ($graduationResults as $result) {
            $intPoints = intval(str_replace("%", "", $result['eredmeny']));
            if (in_array($result['nev'], $mandatorySubjects)) {
                $mandatoryPoints = $intPoints;
            }
            if ($result['tipus'] == 'emelt' && $intPoints > 20) {
                $calculatedExtraPoints += $intPoints;
            }
            if (in_array($result['nev'], $nonMandatorySubjects)) {
                $newNonMandatoryPoints = intval(str_replace("%", "", $result['eredmeny']));
                if ($newNonMandatoryPoints > $nonMandatoryPoints) {
                    $nonMandatoryPoints = $newNonMandatoryPoints;
                }
            }
        }
        $this->calculatedStandardPoints = ($mandatoryPoints + $nonMandatoryPoints) * 2;

        /**
         * Let calculate extra points
         */
        $extraPointsFromExample = $this->getExtrapoints();
        $languageExams = [];
        foreach ($extraPointsFromExample as $subject) {
            if ($calculatedExtraPoints >= 100) continue;
            $type = $subject['tipus'];
            $language = $subject['nyelv'];
            if ($type == 'B2') $languageExams[$type . $language] = 28;
            if ($type == 'C1') $languageExams[$type . $language] = 40;
        }

        $calculatedExtraPoints = $calculatedExtraPoints += array_sum($languageExams);
        if ($calculatedExtraPoints > 100) $calculatedExtraPoints = 100;
        $this->calculatedExtraPoints = $calculatedExtraPoints;
    }

}
