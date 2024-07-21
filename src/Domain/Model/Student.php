<?php

namespace Carolinasanches24\PhpPdo\Domain\Model;

class Student
{
    private ?int $id;
    private string $name;
    private \DateTimeInterface $birthDate;

    public function __construct(?int $id, string $name, \DateTimeInterface $birthDate)
    {
        $this->id = $id;
        $this->name = $name;
        $this->birthDate = $birthDate;
    }

    public function id(): ?int
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
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
