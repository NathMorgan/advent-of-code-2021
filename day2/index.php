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
        $horizontal = 0;
        $depth = 0;

        for ($x = 0; $x <= count($this->csvValues)-1; $x++) {
            $directions = explode(' ', $this->csvValues[$x]);

            if ($directions[0] === 'forward') {
                $horizontal += $directions[1];
            } else if ($directions[0] === 'down') {
                $depth += $directions[1];
            } else if ($directions[0] === 'up') {
                $depth -= $directions[1];
            }
        }

        print("\n");
        print('Depth: ' . $depth);
        print("\n");
        print('Horizontal: ' . $horizontal);
        print("\n");
        print('Horizontal x Depth: ' . $horizontal * $depth);
        print("\n");
    }

    public function partTwo()
    {
        $horizontal = 0;
        $depth = 0;
        $aim = 0;

        for ($x = 0; $x <= count($this->csvValues)-1; $x++) {
            $directions = explode(' ', $this->csvValues[$x]);

            if ($directions[0] === 'forward') {
                $horizontal += $directions[1];
                $depth += $aim * $directions[1];
            } else if ($directions[0] === 'down') {
                $aim += $directions[1];
            } else if ($directions[0] === 'up') {
                $aim -= $directions[1];
            }
        }

        print("\n");
        print('Depth: ' . $depth);
        print("\n");
        print('Horizontal: ' . $horizontal);
        print("\n");
        print('Aim: ' . $aim);
        print("\n");
        print('Horizontal x Depth: ' . $horizontal * $depth);
        print("\n");
    }
}

$index = new Index();
$index->partOne();
$index->partTwo();