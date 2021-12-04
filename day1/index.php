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
        $increasedCount = 0;
        $decreasedCount = 0;

        for ($x = 0; $x <= count($this->csvValues)-1; $x++) {
            if ($x === 0) {
                continue;
            }
            
            $currentValue = $this->csvValues[$x];
            $prevValue = $this->csvValues[$x-1];

            if ($currentValue < $prevValue) {
                $decreasedCount++;
            } else if ($currentValue > $prevValue) {
                $increasedCount++;
            }
        }

        print("\n");
        print('Increased Count: ' . $increasedCount);
        print("\n");
        print('Decreased Count: ' . $decreasedCount);
        print("\n");
    }

    public function partTwo()
    {
        $increasedCount = 0;
        $decreasedCount = 0;

        for ($x = 0; $x <= count($this->csvValues) - 1; $x++) {
            if ($x <= 2) {
                continue;
            }

            $prevTotalValue = $this->csvValues[$x - 1] + $this->csvValues[$x - 2] + $this->csvValues[$x - 3];
            $totalValue = $this->csvValues[$x] + $this->csvValues[$x - 1] + $this->csvValues[$x - 2];
            
            if ($totalValue < $prevTotalValue) {
                $decreasedCount++;
            } else if ($totalValue > $prevTotalValue) {
                $increasedCount++;
            }
        }

        print("\n");
        print('Increased Count: ' . $increasedCount);
        print("\n");
        print('Decreased Count: ' . $decreasedCount);
        print("\n");
    }
}

$index = new Index();
$index->partOne();
$index->partTwo();