<?php


function isRectangle(){
    if (isset($_POST) && ! empty($_POST)){
        $application=new App($_POST);
        if ($application->validate()){
            $application->prepareThePoints();
            if ($application->checkIfThereIsEqualPoints() === false){
                if ($application->checkIfTheTwoParallelSidesIsEqual()){
                    if ($application->checkIfTheNextLinesAreColumnar()){
                    // echo 'valid rectangle';
                    $application->result='valid rectangle';
                    return [true,$application];
                    }else{
                     // echo 'invalid rectangle';
                     $application->result='in valid rectangle';
                     return [false,$application];
                    }
                }else{
                 //echo 'Cant Form Rectangle As The Parallel Sides Not Equal';
                 return [false,$application];
                }
            }else{
               //echo 'Cant Form Rectangle As There Is Equal Points';
                $application->result='Cant Form Rectangle As There Is Equal Points';
                return [false,$application];
            }
    
        }else{
    //        echo 'validation error';
    //        var_dump($application->errors);
    //        exit();
                $application->result='Validation Error';
                return [false,$application];
        }
    }
}

$response=isRectangle();
if($response[0] === true){
    $_SESSION['old']=$response[1]->old;
    $_SESSION['errors']=$response[1]->errors;
    $_SESSION['result']=$response[1]->result;
    $_SESSION['inputs']=$response[1]->inputs;
    $_SESSION['status']='success';
    header('location:index.php');
}else{
    $_SESSION['old']=$response[1]->old;
    $_SESSION['errors']=$response[1]->errors;
    $_SESSION['result']=$response[1]->result;
    $_SESSION['inputs']=$response[1]->inputs;
    $_SESSION['status']='danger';
    header('location:index.php');
}