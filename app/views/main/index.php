<?php
    if ($order == 'desc'):
    $fa_sort_icon = '<i class="fa fa-sort-desc" aria-hidden="true"></i>';
    else:
    $fa_sort_icon = '<i class="fa fa-sort-asc" aria-hidden="true"></i>';
    endif;
?>

<div class="container">
    <div class="row justify-content-between">
        <form action="/task/add/" method="post" class="needs-validation form-inline w-100 shadow-sm" id="authForm" novalidate>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">Имя</th>
                    <th scope="col">Email</th>
                    <th scope="col">Текст</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>
                        <div class="form-group">
                            <input type="text" name="username" class="form-control form-control-sm w-100" id="username" required>
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <input type="email" name="email" class="form-control form-control-sm w-100" id="email" placeholder="name@example.com" required>
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <input type="text" name="text" class="form-control form-control-sm w-100" id="text" required>
                        </div>
                    </td>
                    <td>
                        <button type="submit" class="btn btn-success btn-sm float-right">Добавить задачу <i class="fa fa-plus" aria-hidden="true"></i></button>
                    </td>
                </tr>
                </tbody>
            </table>
        </form>
    </div>
</div>

<table class="table table-striped">
    <thead>
    <tr>
        <th scope="col">Имя пользователя <a href="?sortby=username&order=<?= $order; ?><?php if ( isset($_GET['page']) ) echo '&page='.$_GET['page']; ?>">
                <?php if( @$_GET['sortby'] == 'username' ) echo $fa_sort_icon; else echo '<i class="fa fa-sort-desc" aria-hidden="true"></i>';?></a></th>
        <th scope="col">E-mail <a href="?sortby=email&order=<?= $order; ?><?php if ( isset($_GET['page']) ) echo '&page='.$_GET['page']; ?>">
                <?php if( @$_GET['sortby'] == 'email' ) echo $fa_sort_icon; else echo '<i class="fa fa-sort-desc" aria-hidden="true"></i>';?></a></th>
        <th scope="col">Текст задачи</th>
        <th scope="col">Статус<a href="?sortby=status&order=<?= $order; ?><?php if ( isset($_GET['page']) ) echo '&page='.$_GET['page']; ?>">
                <?php if( @$_GET['sortby'] == 'status' ) echo $fa_sort_icon; else echo '<i class="fa fa-sort-desc" aria-hidden="true"></i>';?></a></th>
    </tr>
    </thead>
    <tbody>
    <?php
    if ( !empty($task_list) ):
        foreach ( $task_list as $item ):
            ?>
            <tr>
                <td><?=$item->username?></td>
                <td><?=$item->email?></td>
                <?php if ( !isset($_SESSION['user']) ): ?>
                <td><?=$item->text?></td>
                <?php else: ?>
                <td id="edit-text-<?=$item->task_ID?>">
                    <div class="tasks-text-field">
                        <?=$item->text?><span class="float-right text-primary" style="cursor: pointer" onclick="editTaskText(<?=$item->task_ID?>);"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span>
                    </div>
                    <form method="post" action="/task/edit/?id=<?=$item->task_ID?>" class="form-tasks-text-edit">
                        <div class="form-group">
                            <input type="text" name="text" class="form-control form-control-sm w-100" id="text" value="<?=$item->text?>" required>
                        </div>
                        <button type="button" class="btn btn-outline-info btn-sm task-edit-cancel">Отмена</button>
                        <button type="submit" class="btn btn-success btn-sm float-right">Сохранить</button>
                    </form>
                </td>
                <?php endif; ?>
                <td>
                    <form method="post" action="/task/change-status" id="form-change-status-<?=$item->task_ID?>">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="status-<?=$item->task_ID?>" onchange="changeStatus(<?=$item->task_ID?>)" <?php if ( $item->status ) echo 'checked'?> >
                            <label class="custom-control-label" style="cursor: pointer" for="status-<?=$item->task_ID?>"><span class="<?php if ( $item->status ) echo 'text-primary'; else echo 'text-secondary'; ?>">Выполнено</span></label>
                            <input type="hidden" name="task_id" value="<?=$item->task_ID?>">
                        </div>
                    </form>
                    <?php if ( $item->edited == 1 ): ?>
                    <span class="text-info"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> Отредактировано администратором</span>
                    <?php endif; ?>
                </td>
                <td>
                    <a href="/task/delete/?id=<?=$item->task_ID;?>" class="text-danger" title="Удалить" onclick="return confirm('Вы действительно хотите удалить?');"><i class="fa fa-times" aria-hidden="true"></i></a>
                </td>
            </tr>
        <?php
        endforeach;
    endif;
    ?>
    </tbody>
</table>
<?php if( $pagination->countPages > 1): ?>
    <?= $pagination; ?>
<?php endif; ?>
<?php if ( empty($task_list) ): ?>
    <h4 class="text-info text-center">Задач пока нет.</h4>
<?php endif; ?>
