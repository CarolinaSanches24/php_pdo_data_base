<?php

namespace Carolinasanches24\PhpPdo\Domain\Model;

class Student
{
    public function __construct(
        private string $name,
        private \DateTimeImmutable $birthDate,
        private int|null $id)
    {
        $this->id = $id;
        $this->name = $name;
        $this->birthDate = $birthDate;
    }

    public function id(): int|null
    {
        return $this->id ?? null;
    }

    public function name(): string
    {
        return $this->name;
    }
    public function changeName(string $newName):void{
        $this->name = $newName;
    }

    public function birthDate(): \DateTimeInterface
    {
        return $this->birthDate;
    }

    public function age(): int //função retorna um tipo inteiro
    {
        return $this->birthDate
            ->diff(new \DateTimeImmutable()) //diferença entre a data de nasc e a data e hora atuais.
            ->y; //representa a diferença em anos.
    }
}
