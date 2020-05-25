<h3 class="h3 text-info px-3">Новая задача</h3>
<form action="/task/add/" method="post" class="needs-validation shadow-sm p-3" id="authForm" novalidate>
    <div class="form-group">
        <label for="username">Имя</label>
        <input type="text" name="username" class="form-control" id="username">
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" class="form-control" id="email" placeholder="name@example.com">
    </div>
    <div class="form-group">
        <label for="text">Текст</label>
        <textarea name="text" class="form-control" id="text" rows="3"></textarea>
    </div>
    <button type="submit" class="btn btn-primary mb-2">Добавить задачу</button>
</form>

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