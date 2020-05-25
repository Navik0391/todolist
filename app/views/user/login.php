<div class="d-flex justify-content-center my-5">
    <form action="/user/login/" method="post" class="needs-validation shadow-sm p-3" id="authForm" novalidate>
        <h2 class="text-center text-info">Авторизация</h2>
        <div class="form-row">
            <div class="col mb-3">
                <label for="username"><i class="fa fa-user" aria-hidden="true"></i>
                    Имя пользователя</label>
                <input type="text" name="username" class="form-control" id="username" onchange="checkUsername(); false;" required>
                <div class="invalid-feedback">
                    Пожалуйста, введите имя пользователя
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col mb-3">
                <label for="password"><i class="fa fa-key" aria-hidden="true"></i>
                    Пароль</label>
                <input type="password" name="password" class="form-control" id="password" onchange="checkPassword(); false;" required>
                <div class="invalid-feedback">
                    Пожалуйста, введите пароль
                </div>
            </div>
        </div>
        <button class="btn btn-primary" type="submit">Войти</button>
    </form>
</div>

<!--<script>
    let form = document.getElementById('authForm');
    let username = document.getElementById('username');
    let password = document.getElementById('password');

    form.onsubmit = function (ev) {
        ev.preventDefault();
        if ( checkUsername() === true && checkPassword() === true ) {
            this.submit();
        }else {
            checkUsername();
            checkPassword();
        }
    };

    function checkUsername() {
        if ( username.value == "" ) {
            username.classList.add('is-invalid'); return false;
        }else username.classList.remove('is-invalid');
        return true;
    }
    function checkPassword() {
        if ( password.value == "" ) {
            password.classList.add('is-invalid'); return false;
        }else password.classList.remove('is-invalid');
        return true;
    }
</script>-->