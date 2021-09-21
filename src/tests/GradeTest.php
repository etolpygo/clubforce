<?php 
declare(strict_types=1);

require 'models/Grade.php';

use PHPUnit\Framework\TestCase;

final class GradeTest extends TestCase
{
    public function testGetRoundedGrade(): void
    {
        $grade1 = new Grade("John", 53);
        $grade2 = new Grade("Jane", 68);
        $grade3 = new Grade("Emma", 32);
        $grade4 = new Grade("Sophia", 39);

        $this->assertEquals(
            55,
            $grade1->getRoundedGrade()
        );

        $this->assertEquals(
            70,
            $grade2->getRoundedGrade()
        );

        $this->assertEquals(
            30,
            $grade3->getRoundedGrade()
        );

        $this->assertEquals(
            40,
            $grade4->getRoundedGrade()
        );

    }

}
