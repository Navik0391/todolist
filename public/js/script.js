// Изменение статуса. Принимает ID записи
function changeStatus(id) {
    var form = document.getElementById('form-change-status-'+id);
    var chkbox = document.getElementById('status-'+id);
    form.submit();
}

function editTaskText(id) {
    var td_editText = document.getElementById('edit-text-'+id);
    td_editText.getElementsByClassName('tasks-text-field')[0].classList.add('d-none');
    td_editText.getElementsByClassName('form-tasks-text-edit')[0].classList.add('d-block');

    var teditcancel = td_editText.getElementsByClassName('task-edit-cancel')[0];
    teditcancel.addEventListener("click", function () {
        td_editText.getElementsByClassName('tasks-text-field')[0].classList.remove('d-none');
        td_editText.getElementsByClassName('form-tasks-text-edit')[0].classList.remove('d-block');
    });
}