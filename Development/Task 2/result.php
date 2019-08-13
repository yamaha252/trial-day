<?php

$students = [
    new Student('Duncan', 'Green', [4, 5, 5]),
    new Student('Alison', 'Anderson', [3, 3, 3]),
    new Student('Jennifer', 'Hunter', [2, 4, 5]),
    new Student('Aaron', 'Ross', [4, 5, 4]),
    new Student('Reece', 'Gray', [3, 3, 4]),
    new Student('Theresa', 'Cooper', [4, 4, 3]),
    new Student('Patrick', 'Walker', [5, 5, 5]),
    new Student('Charlie', 'Palmer', [4, 3, 4]),
    new Student('Philip', 'Richardson', [3, 3, 3]),
    new Student('Helena', 'Jackson', [2, 5, 5]),
    new Student('Dominic', 'Palmer', [4, 4, 4]),
    new Student('Joel', 'Miller', [3, 5, 5]),
    new Student('Evie', 'Martin', [5, 5, 4]),
    new Student('Carmen', 'Rogers', [3, 2, 5]),
    new Student('Justine', 'Morris', [5, 5, 3]),
];

class Student
{
    /**
     * @var string
     */
    public $firstName;

    /**
     * @var string
     */
    public $lastName;

    /**
     * @var integer[]
     */
    public $grades;

    /**
     * Student constructor.
     * @param string $firstName
     * @param string $lastName
     * @param integer[] $grades
     */
    public function __construct(string $firstName, string $lastName, array $grades)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->grades = $grades;
    }

    /**
     * Average grade of the student
     * @return float
     */
    function getAverageGrade(): float
    {
        return array_sum($this->grades) / count($this->grades);
    }
}

class Education
{
    const CLASSES = [1, 2, 3];

    /**
     * @var Student[]
     */
    protected $students;

    public function __construct(Student ...$students)
    {
        $this->students = $students;
    }

    /**
     * The average grade of all students for each class
     * @return array
     */
    function getAverageGrades(): array
    {
        $averageGrades = [];
        foreach ($this->students as $student) {
            foreach (self::CLASSES as $classNum => $class) {
                if (!isset($averageGrades[$class])) {
                    $averageGrades[$class] = 0;
                }
                $averageGrades[$class] += $student->grades[$classNum];
            }
        }

        $result = [];
        $studentsCount = count($this->students);
        foreach (self::CLASSES as $class) {
            $result[] = [
                'class' => "Class #$class",
                'grade' => $averageGrades[$class] / $studentsCount,
            ];
        }
        return $result;
    }

    /**
     * The overall average grade
     * @return float
     */
    function getOverallAverageGrade(): float
    {
        $result = 0;
        foreach ($this->students as $student) {
            $result += array_sum($student->grades);
        }
        return $result / (count($this->students) * count(self::CLASSES));
    }
}


echo "A list of all students with their personal average grade\r\n";
$studentsList = array_map(function ($student) {
    /** @var Student $student */
    return "$student->firstName $student->lastName: " . round($student->getAverageGrade(), 2);
}, $students);

print_r($studentsList);


echo "The average grade of all students for each class\r\n";

$ed = new Education(...$students);

$classesList = array_map(function ($item) {
    return $item['class'] . ': ' . round($item['grade'], 2);
}, $ed->getAverageGrades());

print_r($classesList);

echo "The overall average grade: " . round($ed->getOverallAverageGrade(), 2) . "\r\n";
