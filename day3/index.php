<?php

class Index
{
    /**
     * @var array
     */
    private $csvValues;

    public function __construct()
    {
        $this->csvValues = array_map('rtrim', file('input/values.csv'));
    }

    public function partOne()
    {
        $rowValues = [];
        $gammaRateBinary = '';
        $epsilonRateBinary = '';
        
        for ($x = 0; $x <= count($this->csvValues)-1; $x++) {
            $values = str_split($this->csvValues[$x]);

            for ($y = 0; $y <= count($values)-1; $y++) {
                $rowValues[$y][] = $values[$y];
            }
        }

        foreach($rowValues as $rowValue) {
            $valueCounts = array_count_values($rowValue);

            $maxValue = array_search(max($valueCounts), $valueCounts);
            $minValue = array_search(min($valueCounts), $valueCounts);

            $gammaRateBinary = $gammaRateBinary . $maxValue;
            $epsilonRateBinary = $epsilonRateBinary . $minValue;
        }

        $gammaRate = bindec($gammaRateBinary);
        $epsilonRate = bindec($epsilonRateBinary);



        print("\n");
        print('Power Consumption: ' . $gammaRate * $epsilonRate);
        print("\n");
    }

    public function partTwo()
    {
        $binaryCharacterLength = strlen($this->csvValues[0])-1;
        $oxygenGeneratorRating = $this->getOxygenGeneratorRating($binaryCharacterLength);
        $c02ScrubberRating = $this->getC02ScrubberRating($binaryCharacterLength);

        print("\n");
        print('Life Support Rating: ' . $oxygenGeneratorRating * $c02ScrubberRating);
        print("\n");
    }

    private function getRowBinaryCommonDigit($binaryRows, $row, $matchType = 'max')
    {
        $commonDigits = [];

        for ($x = 0; $x <= count($binaryRows)-1; $x++) {
            $values = str_split($binaryRows[$x]);
            $commonDigits[] = $values[$row];
        }

        $valueCounts = array_count_values($commonDigits);
        $maxValue = array_search(max($valueCounts), $valueCounts);
        $minValue = array_search(min($valueCounts), $valueCounts);

        if ((int) $maxValue === (int) $minValue) {
            if ($matchType === 'max') {
                return 1;
            } else {
                return 0;
            }
        }
        
        if ($matchType === 'max') {
            return $maxValue;
        } else {
            return $minValue;
        }
    }

    private function getOxygenGeneratorRating($binaryCharacterLength)
    {
        $binaryValues = $this->csvValues;

        for ($x = 0; $x <= $binaryCharacterLength; $x++) {
            $sortedBinaryValues = [];
            $commonDigit = $this->getRowBinaryCommonDigit($binaryValues, $x, 'max');

            foreach ($binaryValues as $binaryValue) {
                $values = str_split($binaryValue);

                if ((int) $values[$x] === (int) $commonDigit) {
                    $sortedBinaryValues[] = $binaryValue;
                }
            }

            if ($sortedBinaryValues) {
                $binaryValues = $sortedBinaryValues;
            }

            if (count($binaryValues) === 1) {
                break;
            }
        }

        return bindec($binaryValues[0]);
    }

    private function getC02ScrubberRating($binaryCharacterLength)
    {
        $binaryValues = $this->csvValues;

        for ($x = 0; $x <= $binaryCharacterLength; $x++) {
            $sortedBinaryValues = [];
            $commonDigit = $this->getRowBinaryCommonDigit($binaryValues, $x, 'min');

            foreach ($binaryValues as $binaryValue) {
                $values = str_split($binaryValue);

                if ((int) $values[$x] === (int) $commonDigit) {
                    $sortedBinaryValues[] = $binaryValue;
                }
            }

            if ($sortedBinaryValues) {
                $binaryValues = $sortedBinaryValues;
            }

            if (count($binaryValues) === 1) {
                break;
            }
        }

        return bindec($binaryValues[0]);
    }
}

$index = new Index();
$index->partOne();
$index->partTwo();