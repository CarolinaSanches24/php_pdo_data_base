<?php

use Carolinasanches24\PhpPdo\Domain\Model\Student;

require_once 'vendor/autoload.php';

$student = new Student(
    null,
    'Carol Sanches',
    new \DateTimeImmutable('1998-09-17')
);

echo $student->age();
