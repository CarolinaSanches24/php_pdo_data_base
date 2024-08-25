<?php
namespace Carolinasanches24\PhpPdo\Domain\Repository;

use Carolinasanches24\PhpPdo\Domain\Model\Student;

interface StudentRepo{
    public function getAllStudents():array;
    public function getStudentById(int $id):?Student;
    public function studentBirthAt(\DateTimeInterface $birthDate):array;
    public function save(Student $student):bool;
    public function remove(Student $student):bool;
    
}