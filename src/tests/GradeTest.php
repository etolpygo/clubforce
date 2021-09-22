<?php 
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class GradeTest extends TestCase
{   
    private $grade1, $grade2, $grade3, $grade4;

    protected function setUp(): void
    {
        $this->grade1 = new Grade("John", 53);
        $this->grade2 = new Grade("Jane", 68);
        $this->grade3 = new Grade("Emma", 32);
        $this->grade4 = new Grade("Sophia", 39);
    }

    /**
     * @covers Grade::getRoundedGrade
     */
    public function testGetRoundedGrade(): void
    {   

        $this->assertEquals(
            55,
            $this->grade1->getRoundedGrade()
        );

        $this->assertEquals(
            70,
            $this->grade2->getRoundedGrade()
        );

        $this->assertEquals(
            30,
            $this->grade3->getRoundedGrade()
        );

        $this->assertEquals(
            40,
            $this->grade4->getRoundedGrade()
        );

    }

    /**
     * @covers Grade::pass
     */
    public function testPass(): void
    {   

        $this->assertTrue($this->grade1->pass());

        $this->assertTrue($this->grade2->pass());

        $this->assertFalse($this->grade3->pass());

        $this->assertTrue($this->grade4->pass());

    }

}
