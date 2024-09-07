<?php

use Carolinasanches24\PhpPdo\Infra\Persistence\ConnectionCreator;
use Carolinasanches24\PhpPdo\Infra\Persistence\DbSchemaManager;
use Carolinasanches24\PhpPdo\Infra\Repository\InjectionDependence;

require_once 'vendor/autoload.php';

$connection = ConnectionCreator::createConnection();
$schemaManager = new DbSchemaManager($connection);
$schemaManager->createTables(__DIR__ . '/src/Infra/schemas/schemas.sql');

$studentRepository = new InjectionDependence($connection);

$studentList = $studentRepository->getStudentsWithPhones();


foreach ($studentList as $student) {
    echo "Student: " . $student->name() . "<br>";

    // Iterar sobre os telefones do estudante
    $phones = $student->getPhones();
    if (!empty($phones)) {
        foreach ($phones as $phone) {
            echo "Phone: " . $phone->formattedPhone() . "<br>";
        }
    } else {
        echo "No phones available for this student.<br>";
    }
    
    echo "<br>";
}

var_dump($studentList);



