<?php
session_start();
define('APP_URL','http://127.0.0.1:2020/');
define('CART','cart');
define('FLASH','flash_messages');

$products = [
    17=> [
        'name'      => 'First Product',
        'vendor'    => 'First Vendor',
        'price'     => 190,
        'discount'  => 5,
        'image'     => 'images/10.jpg'
    ],
    25=> [
        'name'      => 'Second Product',
        'vendor'    => 'Second Vendor',
        'price'     => 88,
        'discount'  => 12,
        'image'     => 'images/10.jpg'
    ],
    36=> [
        'name'      => 'Third Product',
        'vendor'    => 'Third Vendor',
        'price'     => 605,
        'discount'  => 7,
        'image'     => 'images/10.jpg'
    ],
];

//emptyCart();
function initializingTheCart(){
    if (!isset($_SESSION[CART]['items']) || empty($_SESSION[CART]['items'])){
        $_SESSION[CART]['items'] = [];
        $_SESSION[CART]['qty'] = 0;
    }
}

function redirectFromHere(){
    function redirectFromHere(){
    $path = trim($_SERVER['SCRIPT_NAME'],'/');
    $path = explode('/',$path);
    $currentFileName =  end($path);

    if (str_replace('.php','',$currentFileName) == pathinfo(__FILE__,PATHINFO_FILENAME))
        header('location:'.APP_URL.'index.php');
}
}

function emptyCart(){
    $_SESSION[CART]['items'] = [];
    $_SESSION[CART]['qty'] = 0;
}

function addFlashMessage($key,$value){
    $_SESSION[FLASH][$key] = $value;
}

function getFlashMessage($key){
    $message = $_SESSION[FLASH][$key] ?? null;
    unset($_SESSION[FLASH][$key]);
    return $message;
}

function addToCart($id){
    global $products;
    if (in_array($id,array_keys($products))){
        if (in_array($id,array_keys($_SESSION[CART]['items']))){
            $_SESSION[CART]['items'][$id]['product_amount']+= 1;
        }else{
            $_SESSION[CART]['items'][$id]['product_amount'] = 1;
        }
        $_SESSION[CART]['qty']+= 1;
        addFlashMessage('message',['type'=>'success','body'=>'Product Added To Cart Successfully']);
    }else{
      addFlashMessage('message',['type'=>'danger','body'=>'This Product Not Found']);
    }
}

function getCart(){
    global $products;
    $data = [];
    foreach ($_SESSION[CART]['items'] as $id => $amount){
        $data[$id]=$products[$id];
        $data[$id]['amount'] =$amount['product_amount'];
    }
    return $data;
}

function updateCart($newAmounts){

    global $products;
    $oldCart = $_SESSION[CART]['items'];
    $_SESSION[CART]['items'] = [];
    foreach ($oldCart as $id => $oldAmountValue){
        foreach ($newAmounts as $newAmountId => $newAmountValue){
            if (in_array($newAmountId,array_keys($products))){
                    if (in_array($id,array_keys($newAmounts))){
                        if ($newAmountValue > 0){
                            $_SESSION[CART]['items'][$newAmountId]['product_amount']= $newAmountValue;

                        }
                }
            }
        }

    }

    $_SESSION[CART]['qty'] = array_sum(array_map(fn($product)=> $product['product_amount'],$_SESSION[CART]['items']));
    addFlashMessage('message',['type'=>'success','body'=>'Cart Updated Successfully']);
}

redirectFromHere();

initializingTheCart();



