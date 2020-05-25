<!doctype html>
<html lang="ru">
<head>
    <base href="/">
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <?=$this->getMeta()?>
    <link rel="stylesheet" href="/public/css/font-awesome.min.css">
    <link rel="stylesheet" href="/public/css/bootstrap.min.css">
    <link rel="stylesheet" href="/public/css/style.css">
</head>
<body>
<div class="wrapper">
    <div class="container">

        <header>
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="#"><img src="/public/img/beejee_small.png" width="30" height="30" alt="" loading="lazy"></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <a class="nav-item nav-link" href="/"><i class="fa fa-home" aria-hidden="true"></i> На главную |</a>
                        <?php if( !isset($_SESSION['user']) ):?>
                        <a class="nav-item nav-link active" href="?r=user/login">Войти <i class="fa fa-sign-in" aria-hidden="true"></i><span class="sr-only">(current)</span></a>
                        <?php else:?>
                        <a class="nav-item nav-link"><i class="fa fa-user-circle" aria-hidden="true"></i> <?= $_SESSION['user']['login']; ?>!</a>
                        <a class="nav-item nav-link active" href="?r=user/logout">Выйти <i class="fa fa-sign-out" aria-hidden="true"></i><span class="sr-only">(current)</span></a>
                        <?php endif; ?>
                    </div>
                </div>
            </nav>
        </header>

        <div class="content">
            <!-- Вывод сообщений -->
            <div class="errors my-3" role="alert">
                <?php if ( isset($_SESSION['error']) ): ?>
                    <ul class="list-group alert alert-danger p-0">
                        <?php echo '<li class="list-group-item">' . $_SESSION['error'] . '</li>'; unset($_SESSION['error']); ?>
                    </ul>
                <?php endif; ?>
                <?php if ( isset($_SESSION['success']) ): ?>
                    <ul class="list-group alert alert-success p-0">
                        <?php echo '<li class="list-group-item">' . $_SESSION['success'] . '</li>'; unset($_SESSION['success']); ?>
                    </ul>
                <?php endif; ?>
            </div>
            <!-- Вывод сообщений -->

            <?= $content; ?>

        </div>

        <footer></footer>
    </div>

</div>
<script type="text/javascript" src="/public/js/script.js"></script>
</body>
</html>