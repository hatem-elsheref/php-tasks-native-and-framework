<?php
session_start();
require_once 'Point.php';

/*
 * 1-----------2
 * |           |
 * |           |
 * 3-----------4
 * */
class App{

    public array $errors;
    public array $points;
    public array $inputs;
    public array $old;
    public string $result;
    const UN_KNOWN='Y_AXIS';
    const KNOWN='X_AXIS';

    public function __construct($inputs){
        $this->inputs=$inputs;
        $this->points=[];
        $this->errors=[];
        $this->old=$inputs;
        $this->result='';

    }

    public function validate(){
        foreach ($this->inputs as $inputName => $inputValue){
           if (empty($inputValue) || is_null($inputValue) || !is_numeric($inputValue) and $inputValue !==0){
               array_push($this->errors,'invalid Point in '.$inputName);
           }
        }
        return (count($this->errors) == 0);
    }

    public function prepareThePoints(){
        for ($i=1 ; $i<=4 ; $i++){
            $x=$this->inputs['point'.$i.'_x'];
            $y=$this->inputs['point'.$i.'_y'];
            $tmpPoint=new Point($x,$y,$i);
            array_push($this->points,$tmpPoint);
        }
    }

    public function checkIfThereIsEqualPoints(){
        for ($i=1 ; $i<=4 ; $i++){
            $currentPoint=$this->points[$i-1];
            $restPoints=$this->points;
            $newPoints=[];
            unset($restPoints[$i-1]);
            foreach ($restPoints as $point)
                array_push($newPoints,$point);


            $restPoints=$newPoints;

            if ($currentPoint->getX() == $restPoints[0]->getX() && $currentPoint->getY() == $restPoints[0]->getY()){
                return true;
            }
            if ($currentPoint->getX() == $restPoints[1]->getX() && $currentPoint->getY() == $restPoints[1]->getY()){
                return true;
            }
            if ($currentPoint->getX() == $restPoints[2]->getX() && $currentPoint->getY() == $restPoints[2]->getY()){
                return true;
            }
        }

        return  false;
    }

    public function calculateTheDistance($pointOne,$pointTwo){
        return sqrt(pow($pointTwo->getX()-$pointOne->getX(),2)+pow($pointTwo->getY()-$pointOne->getY(),2));
    }

    public function checkIfTheTwoParallelSidesIsEqual(){

        $point_1=$this->points[0];
        $point_2=$this->points[1];
        $point_3=$this->points[2];
        $point_4=$this->points[3];

        $distance_1_2=$this->calculateTheDistance($point_1,$point_2);
        $distance_3_4=$this->calculateTheDistance($point_3,$point_4);
        if ($distance_1_2 != $distance_3_4){
            $this->result='Cant Form Rectangle As The Parallel Sides Not Equal';
            return  false;
        }

        $distance_2_4=$this->calculateTheDistance($point_2,$point_4);
        $distance_1_3=$this->calculateTheDistance($point_1,$point_3);
        if ($distance_2_4 != $distance_1_3){
            $this->result='Cant Form Rectangle As The Parallel Sides Not Equal';
            return  false;
        }

        return true;
    }

    public function calculateLineSlope($pointOne,$pointTwo){
        $yDifference=$pointTwo->getY()-$pointOne->getY();
        $xDifference=$pointTwo->getX()-$pointOne->getX();
        if ($yDifference == 0 && $xDifference==0)
            return  -1;
        if ($xDifference==0 && $yDifference!=0)
            return self::UN_KNOWN;
        if ($yDifference==0 && $xDifference!=0)
            return self::KNOWN;
        return ($yDifference)/($xDifference);
    }

    public function checkIfTheNextLinesAreColumnar(){
        $point_1=$this->points[0];
        $point_2=$this->points[1];
        $point_3=$this->points[2];
        $point_4=$this->points[3];
        $slope1=$this->calculateLineSlope($point_1,$point_2);
        $slope2=$this->calculateLineSlope($point_2,$point_4);
        if (($slope1==self::KNOWN && $slope2== self::KNOWN) ||  ($slope1==self::UN_KNOWN && $slope2== self::UN_KNOWN))
            return false;
        if (($slope1==self::KNOWN && $slope2== self::UN_KNOWN) ||  ($slope1==self::UN_KNOWN && $slope2== self::KNOWN))
            return true;

        $line_1_2_to_line_2_4=$slope1*$slope2;
        if ($line_1_2_to_line_2_4 != -1){
            $this->result='Cant Form Rectangle As The Two Next Lines Are Not Vertical';
            return  false;
        }


        $line_1_3_to_line_3_4=$this->calculateLineSlope($point_1,$point_3)*$this->calculateLineSlope($point_3,$point_4);
        if ($line_1_3_to_line_3_4 != -1){
            $this->result='Cant Form Rectangle As The Two Next Lines Are Not Vertical';
            return  false;
        }
        return true;
    }

    public function checkTheDiagonal(){
        $point_1=$this->points[0];
        $point_2=$this->points[1];
        $point_3=$this->points[2];
        $point_4=$this->points[3];

        $distance_1_2=$this->calculateTheDistance($point_1,$point_2);
        $distance_2_4=$this->calculateTheDistance($point_2,$point_4);
        $distance_1_4=$this->calculateTheDistance($point_1,$point_4);
        if (sqrt(pow($distance_1_2,2)+pow($distance_2_4,2)) != $distance_1_4){
            return false;
        }


        $distance_1_3=$this->calculateTheDistance($point_1,$point_3);
        $distance_3_4=$this->calculateTheDistance($point_3,$point_4);

        if (sqrt(pow($distance_1_3,2)+pow($distance_3_4,2)) != $distance_1_4){
            return false;
        }
        return true;
    }
}




require_once 'run.php';
