<h3 class="h3 text-info px-3">Редактирование задачи</h3>
<form action="/task/edit/?id=<?= $data['task_ID'] ?>" method="post" class="needs-validation shadow-sm p-3" id="authForm" novalidate>
    <div class="form-group">
        <label for="username">Имя</label>
        <input type="text" class="form-control" value="<?= $data['username'] ?>" disabled>
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" value="<?= $data['email'] ?>" disabled>
    </div>
    <div class="form-group">
        <label for="text">Текст</label>
        <textarea name="text" class="form-control" id="text" rows="3"><?= $data['text'] ?></textarea>
    </div>
    <button type="submit" class="btn btn-primary mb-2">Редактировать задачу</button>
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