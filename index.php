<?php require_once 'products.php'; ?>
<?php
if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST'){
    $operation = $_POST['operation'] ?? null;
    if ($operation =='add' || $operation == 'update' || $operation == 'remove'){
        switch ($operation){
            case 'remove':
                emptyCart();
                break;
            case 'add':
                addToCart($_POST['product_id']);
                break;
            case 'update':
                $cart_products = $_POST['products'];
                $amounts = [];
                $errors = [];
                foreach ($cart_products as $id => $newAmount){
                    if (!is_numeric($newAmount) || $newAmount < 0){
                        $errors[]=$id;
                    }else{
                        $amounts[$id] = $newAmount;
                    }
                }
                if (count($errors) == 0){
                    updateCart($amounts);
                }else{
                    $err = array_map(function ($id) use($products){
                        if (in_array($id,array_keys($products))){
                            return "invalid amount in product  [ ".$products[$id]['name'] ." ]<br>";
                        }
                    },$errors);
                    addFlashMessage('message',['type'=>'danger','body'=>ucwords(implode('  ',$err))]);
                }
                break;
        }
    }else{
        addFlashMessage('message',['type'=>'danger','body'=>'Invalid Operation operations must be [add,update]']);
    }
}
?>
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.79.0">
    <title>Producer Families</title>

    <!-- Bootstrap core CSS -->
    <link href="https://getbootstrap.com/docs/5.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <!-- Favicons -->
    <link rel="apple-touch-icon" href="https://getbootstrap.com/docs/5.0/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
    <link rel="icon" href="https://getbootstrap.com/docs/5.0/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="https://getbootstrap.com/docs/5.0/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
    <link rel="manifest" href="https://getbootstrap.com/docs/5.0/assets/img/favicons/manifest.json">
    <link rel="mask-icon" href="https://getbootstrap.com/docs/5.0/assets/img/favicons/safari-pinned-tab.svg" color="#7952b3">
    <link rel="icon" href="https://getbootstrap.com/docs/5.0/assets/img/favicons/favicon.ico">
    <meta name="theme-color" content="#7952b3">


    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

    </style>

</head>
<body>

<header>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?=APP_URL?>">Logo</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                    <li class="nav-item active">
                        <a class="nav-link" aria-current="page" href="<?=APP_URL?>">Home</a>
                    </li>
                </ul>
                <div class="d-flex">
                    <a class="btn btn-outline-danger">Cart <span class="badge rounded-pill bg-secondary"><?= $_SESSION[CART]['qty']?></span></a>
                </div>
            </div>
        </div>
    </nav>
</header>

<main>

    <div class="container">
        <div class="row mt-5">
            <?php if (!is_null($message = getFlashMessage('message'))):?>
            <div class="alert alert-<?=$message['type']?>"><?=$message['body']?></div>
            <?php endif; ?>
        </div>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            <?php foreach ($products as $id => $product):?>
            <div class="col mt-5">
                <div class="card shadow-sm">
                    <img class="bd-placeholder-img card-img-top" width="100%" height="225" src="<?= $product['image']?>">

                    <div class="card-body">
                        <p class="card-text text-center">
                        <h4><?= $product['name']?></h4>
                        <h5 class="badge bg-secondary"><?= $product['vendor']?></h5><br>
                        <h5 class="badge bg-danger"><?= $product['price']?> $</h5><br>

                        <div class="d-flex justify-content-between align-items-center">
                            <form action="<?=APP_URL.'index.php'?>" method="post">
                                <div class="btn-group">
                                    <input type="hidden" name="product_id" value="<?=$id?>">
                                    <button type="submit" name="operation" value="add" class="btn btn-sm btn-outline-primary mt-2">Add To Cart</button>
                                </div>
                            </form>
                            <small class="text-muted"><?= $product['discount']?> %</small>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 mt-5">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#ID</th>
                    <th scope="col">Image</th>
                    <th scope="col">Name</th>
                    <th scope="col">Vendor</th>
                    <th scope="col">Price</th>
                    <th scope="col">Before Discount</th>
                    <th scope="col">Discount</th>
                    <th scope="col">After Discount</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>
                <form action="<?=APP_URL.'index.php'?>" method="post">
                    <div class="col-12 " style="width: 100%;text-align: end">
                    <button type="submit" name="operation"  value="update" class="btn btn-sm btn-outline-success">Save</button>
                    <button type="submit" name="operation"  value="remove" class="btn btn-sm btn-outline-danger">Empty</button>
                    </div>
                    <?php foreach (getCart() as $id => $product):?>
                    <tr id="row-product-<?=$id?>">
                        <td><?=$id?></td>
                        <td><img src="<?=APP_URL.$product['image']?>" style="width: 50px;height: 50px"></td>
                        <th scope="row"><?= $product['name']?></th>
                        <th scope="row"><?= $product['vendor']?></th>
                        <th scope="row"><?= $product['price']?> $</th>
                        <th scope="row"><?= $product['amount'] * $product['price']?> $</th>
                        <th scope="row"><?= $product['discount']?> %</th>
                        <th scope="row"><?= ($product['amount'] * $product['price']) - (($product['amount'] * $product['price'] * $product['discount']) / 100 )?> $</th>
                        <th scope="row"><input type="number"  class="form-control" name="products[<?=$id?>]" min="0" step="1" value="<?=$product['amount']?>"></th>
                        <th scope="row">
                            <button id="remove_from_cart" onclick="removeFromCart('row-product-<?=$id?>')" class="btn btn-sm btn-outline-danger mt-2">X</button>
                        </th>
                    </tr>
                <?php endforeach; ?>
                </form>
                </tbody>
            </table>
        </div>

    </div>
</main>
</body>
<script>
    function removeFromCart(selector){
        document.getElementById(selector).remove();
    }
</script>
</html>
