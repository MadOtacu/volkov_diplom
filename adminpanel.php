<?php
session_start();
if (!$_SESSION['user']) {
    header('Location: /');
}
?>

<!doctype html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Панель администратора</title>
        <link rel="stylesheet" href="assets/css/main.css">
       
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <!-- Bootstrap Bundle JS (jsDelivr CDN) -->
        <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <style>
            .line {
                border-left: 2px solid black; /* Линия слева от текста */
                
            }
        </style>
    </head>
    <body  >

        <!-- Профиль -->

        
           
        <div style="border: 4px double black;" class="container rounded bg-white mt-5 mb-5">
            <div class="row">
                <div class="col-md-3 border-right">
                    <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                        <img class="rounded-circle mt-5" width="150px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg">
                        <span class="font-weight-bold">Администратор</span>            
                        <span> </span>
                    </div>
                </div>
                <div class="col-md-5 border-right line" >
                    <div class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="text-right">Профиль</h4>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12"><label class="labels">ФИО</label><h4 class="form-control" style="margin: 10px 0; border-color: black;"><?= $_SESSION['user']['full_name'] ?></h4></div>
                            <div class="col-md-12"><label class="labels">Почта</label><h4 class="form-control" style="margin: 10px 0; border-color: black;"><?= $_SESSION['user']['email'] ?></h4></div>
                            <div class="col-md-12"><label class="labels">Логин</label><h4 class="form-control" style="margin: 10px 0; border-color: black;"><?= $_SESSION['user']['login'] ?></h4></div>
                            <div class="col-md-12"><label class="labels">Пароль</label><h4 class="form-control" style="margin: 10px 0; border-color: black;"><?= $_SESSION['user']['password'] ?></h4></div>

                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6"><label class="labels">Страна</label><h4 class="form-control" style="margin: 10px 0; border-color: black;">Россия</h4></div>
                            <div class="col-md-6"><label class="labels">Город</label><h4 class="form-control" style="margin: 10px 0; border-color: black;">Саратов</h4></div>
                        </div>
                        <div class="mt-5 text-center"><button type="button" onclick="window.location.href = 'vendor/logout.php';" class="btn btn-dark">Выход</button></div>
                        
                    </div>
                </div>
                <div class="col-md-4 line" style="margin: 45px 0;">
                    <h2 >Пользователи</h2>
                    <h3 style="margin: 50px 0;">Виталий Витальевич</h3>
                    <div class="row mt-3">
                            <div class="col-md-6"><label class="labels">Логин</label><h4 class="form-control" style="margin: 10px 0; border-color: black;">vital</h4></div>
                            <div class="col-md-6"><label class="labels">Пароль</label><h4 class="form-control" style="margin: 10px 0; border-color: black;">123</h4></div>
                        </div>
                    <h3 >Неподтвержденные заказы</h3>
                    <div id="cars" class="row mt-3">
                            <div class="col-md-12"><label class="labels">Пункт отпраки</label><h4 id = "case1" class="form-control" style="margin: 10px 0; border-color: black;"></h4></div>
                            <div class="col-md-12"><label class="labels">Пункт назначения</label><h4 id="case2" class="form-control" style="margin: 10px 0; border-color: black;"></h4></div>
                            <div class="col-md-12"><label class="labels">Длина маршрута</label><h4 id="case3" class="form-control" style="margin: 10px 0; border-color: black;"></h4></div>
                            <div class="col-md-12"><label class="labels">Машина</label><h4 id="case4" class="form-control" style="margin: 10px 0; border-color: black;"></h4></div>
                            <div class="col-md-12"><label class="labels">Цена доставки</label><h4 id="case5" class="form-control" style="margin: 10px 0; border-color: black;"></h4></div>
                            <div class="col-md-12"><label class="labels">Статус</label><h4 id="case6" class="form-control" style="margin: 10px 0; border-color: black;">Подтверждён</h4></div>
                            <div class="mt-5 text-center"><button type="submit" onclick="alerted();" class="btn btn-dark">Подтвердить отправку</button></div>
                    </div>
                </div>

            </div>
        </div>   

            


        


        <script src="adminPanelLogic.js" type="text/javascript"></script>
    </body>
</html>