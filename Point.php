<?php

class Point{

    private int $X;
    private int $Y;
    private string $name;

    public function __construct($xPoint,$yPoint,$name=null){
        $this->X=$xPoint;
        $this->Y=$yPoint;
        $this->name=$name;
    }
    public function getX(){
        return $this->X;
    }
    public function getY(){
        return $this->Y;
    }
    public function setX($x){
        $this->X=$x;
    }
    public function setY($y){
        $this->Y=$y;
    }
    public function setName($name){
        $this->name=$name;
    }
    public function getName(){
        return $this->name;
    }


}