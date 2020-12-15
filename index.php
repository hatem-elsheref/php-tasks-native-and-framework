<?php session_start(); ?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <title>Rectangle Checker</title>
</head>
<body>
<div class="container">
        <div class="col-sm-12  mb-5">
            <div class="row">
                <div class="col-sm-6 mt-5 "
                <span class="text-danger">* Follow This Sequence</span>
                <br>
                <span class="text-danger">--------------------</span><br>
                Point(1)-----------Point(2)
                <br><br><br>
                Point(3)-----------Point(4)
                <br>
                <span class="text-danger">--------------------</span><br>
            </div>
            <h1 class="m-auto text-center">Rectangle Checker</h1>
            <?php if (isset($_SESSION['status']) and !empty($_SESSION['status'])):?>
                <div class="alert mt-5 alert-<?=$_SESSION['status']?>">
                <?=$_SESSION['result']?> With Poinst <br>
                <?php for ($i=1;$i<=4;$i++):?>
                    <?='point'.$i.'('.$_SESSION['inputs']['point'.$i.'_x'].','.$_SESSION['inputs']['point'.$i.'_y'].'),'?>
            <?php endfor;?>
                </div>
             
            <?php endif;?>

            <?php if (!empty($_SESSION['errors'])):?>
            <?php foreach ($_SESSION['errors'] as $error):?>
                    <div class="alert  alert-danger"><?=$error?></div>
            <?php endforeach;?>
            <?php endif;?>

        </div>
        <div class="col-sm-12">
            <form class="row g-3" method="post" action="App.php">
                        <!--      Point One          -->
                <div class="col-md-6">
                    <label for="point1_x" class="form-label">Point 1 (X)</label>
                    <input type="number" class="form-control" id="point1_x" name="point1_x" value="<?=$_SESSION['old']['point1_x']??''?>" required>
                    <div class="invalid-feedback">
                        Looks good!
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="point1_y" class="form-label">Point 1 (Y)</label>
                    <input type="number" class="form-control" id="point1_y" name="point1_y" value="<?=$_SESSION['old']['point1_y']??''?>" required>
                    <div class="invalid-feedback">
                        Looks good!
                    </div>
                </div>
                <!--      Point Two          -->
                <div class="col-md-6">
                    <label for="point2_x" class="form-label">Point 2 (X)</label>
                    <input type="number" class="form-control" id="point2_x" name="point2_x"  value="<?=$_SESSION['old']['point2_x']??''?>" required>
                    <div class="invalid-feedback">
                        Looks good!
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="point2_y" class="form-label">Point 2 (Y)</label>
                    <input type="number" class="form-control" id="point2_y" name="point2_y" value="<?=$_SESSION['old']['point2_y']??''?>" required>
                    <div class="invalid-feedback">
                        Looks good!
                    </div>
                </div>
                <!--      Point Three          -->
                <div class="col-md-6">
                    <label for="point3_x" class="form-label">Point 3 (X)</label>
                    <input type="number" class="form-control" id="point3_x" name="point3_x" value="<?=$_SESSION['old']['point3_x']??''?>" required>
                    <div class="invalid-feedback">
                        Looks good!
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="point3_y" class="form-label">Point 3 (Y)</label>
                    <input type="number" class="form-control" id="point3_y" name="point3_y" value="<?=$_SESSION['old']['point3_y']??''?>" required>
                    <div class="invalid-feedback">
                        Looks good!
                    </div>
                </div>
                <!--      Point Four          -->
                <div class="col-md-6">
                    <label for="point4_x" class="form-label">Point 4 (X)</label>
                    <input type="number" class="form-control" id="point4_x" name="point4_x" value="<?=$_SESSION['old']['point4_x']??''?>" required>
                    <div class="invalid-feedback">
                        Looks good!
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="point4_y" class="form-label">Point 4 (Y)</label>
                    <input type="number" class="form-control" id="point4_y" name="point4_y" value="<?=$_SESSION['old']['point4_y']??''?>" required>
                    <div class="invalid-feedback">
                        Looks good!
                    </div>
                </div>



                <div class="col-12">
                    <button class="btn btn-primary" type="submit">Check</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
session_unset();
?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>
</html>