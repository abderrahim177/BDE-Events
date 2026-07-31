<?php

namespace App;

class Salle
{
    /**
     * Create a new class instance.
     */
    public function __construct(private string $name , private int $capacity)
    {
        //
    }
   public function peutAccueillir(int $nombre): bool 
   {
       return $nombre <= $this->capacity;
   } 
}
