<?php

namespace App;

class Salle
{
    /**
     * Create a new class instance.
     */
    public function __construct(string $name , int $capacity)
    {
        //
    }
   public function peutAccueillir(int $nombre): bool 
   {
        if($nombre < $capacity;){
            return true;
        }
        else{
            return false;
        }
   } 
}
