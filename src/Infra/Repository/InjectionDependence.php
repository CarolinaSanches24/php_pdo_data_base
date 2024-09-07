<?php

namespace Carolinasanches24\PhpPdo\Infra\Repository;

use Carolinasanches24\PhpPdo\Domain\Model\Student;
use Carolinasanches24\PhpPdo\Domain\Repository\StudentRepo;
use PDO;
class InjectionDependence implements StudentRepo{
    private PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;

    }
    public function getAllStudents():array{
        $sqlAllStudents = "SELECT * FROM students";
        $stmt = $this->connection->prepare($sqlAllStudents);
        $stmt->execute();
        return $this->hydrateStudentList($stmt);

    }
    public function getStudentById(int $id): ?Student
    {
        $sqlStudentById = "SELECT * FROM students WHERE id = ?";
        $stmt = $this->connection->prepare($sqlStudentById);
        $stmt->execute([$id]);

        $studentData = $stmt->fetch();

        if ($studentData === false) {
            return null;
        }

        return new Student(
            $studentData['id'],
            $studentData['name'],
            new \DateTimeImmutable($studentData['birth_date'])
        );
    }

    public function studentBirthAt(\DateTimeInterface $birthDate): array
    {
        $sqlStudentBirthAt = "SELECT * FROM students WHERE birth_date = ?";
        $stmt = $this->connection->prepare($sqlStudentBirthAt);
        $stmt->bindValue(1, $birthDate->format('Y-m-d'));
        $stmt->execute();

        return $this->hydrateStudentList($stmt);
    }

    private function hydrateStudentList(\PDOStatement $stmt): array
    {
        $studentDataList = $stmt->fetchAll();
        $studentList = [];

        foreach ($studentDataList as $studentData) {
            $studentList[] = new Student(
                $studentData['id'],
                $studentData['name'],
                new \DateTimeImmutable($studentData['birth_date'])
            );
        }

        return $studentList;
    }

    public function save(Student $student): bool
    {
        if ($student->id() === null) {
            return $this->insert($student);
        }
        return $this->update($student);
    }

    private function insert(Student $student): bool
    {
        $sqlInsertStudent = "INSERT INTO students (name, birth_date) VALUES (:name, :birth_date)";
        $stmt = $this->connection->prepare($sqlInsertStudent);
        //lançamento de exceção complexo
        if($stmt ===false){
            throw new \RuntimeException($this->connection->errorInfo()[2]);
        }
        $success = $stmt->execute([
            ':name' => $student->name(),
            ':birth_date' => $student->birthDate()->format('Y-m-d'),
        ]);

     $student = $this->connection->lastInsertId();
        return $success;
    }

    public function update(Student $student): bool
    {
        $updateQuery = 'UPDATE students SET name = :name, birth_date = :birth_date WHERE id = :id;';
        $stmt = $this->connection->prepare($updateQuery);
        $stmt->bindValue(':name', $student->name());
        $stmt->bindValue(':birth_date', $student->birthDate()->format('Y-m-d'));
        $stmt->bindValue(':id', $student->id(), PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function remove(Student $student): bool
    {
        $sqlDeleteStudent = "DELETE FROM students WHERE id = ?;";
        $stmt = $this->connection->prepare($sqlDeleteStudent);
        $stmt->bindValue(1, $student->id(), PDO::PARAM_INT);
        return $stmt->execute();
    }
}
