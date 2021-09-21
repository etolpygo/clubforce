<?php

class Grade
{
    public function __construct(
        private string $name, 
        private int $grade
    ) {}

    public function getRoundedGrade(): int 
    {
        return (round($this->grade / 5) * 5);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function pass(): bool
    {
        return ($this->getRoundedGrade() >= 35);
    }

    public function to_array(): array
    {
        return array(
            'name' => $this->getName(), 
            'grade' => $this->getRoundedGrade(), 
            'pass' => $this->pass()
        );
    }

}