<?php

namespace Carolinasanches24\PhpPdo\Domain\Model;
class Phone{
    public function __construct(private ?int $id, private string $area_code , private string $number_phone){
        $this->id = $id;
        $this->area_code = $area_code;
        $this->number_phone = $number_phone;
    }
    public function formattedPhone():string{
        return "($this->area_code) . $this->number_phone";
    }
}
