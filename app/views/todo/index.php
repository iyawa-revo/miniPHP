<?php

// display success or error messages in session
if(!empty(Session::get('success'))){
    var_dump(Session::get('success'));
    Session::set('success', null);
}else if(!empty(Session::get('error'))){
    var_dump(Session::get('error'));
    Session::set('error', null);
}
?>

<div class="todo_container">

<h2>TODO Application</h2>

<!-- in case of normal post request  -->
<form action= "<?= PUBLIC_ROOT . "Todo/create" ?>"  method="post">
    <label>Content <span class="text-danger">*</span></label>
    <textarea name="content" class="form-control" required placeholder="What are you thinking?"></textarea>
    <input type='hidden' name = "csrf_token" value = "<?= Session::generateCsrfToken(); ?>">
    <button type="submit" name="submit" value="submit" class="btn btn-success">Create</button>
</form>


<!-- in case of ajax request  
<form action= "#" id="form-create-todo" method="post">
    <label>Content <span class="text-danger">*</span></label>
    <textarea name="content" class="form-control" required placeholder="What are you thinking?"></textarea>
    <button type="submit" name="submit" value="submit" class="btn btn-success">Create</button>
</form>
-->

<br><br>

<ul id="todo-list">
<?php 
    $todoData = $this->controller->todo->getAll();
    foreach($todoData as $todo){ 
?>
        <li>
            <p> <?= $this->autoLinks($this->encodeHTMLWithBR($todo["content"])); ?></p>

            <!-- in case of normal post request -->
            <form action= "<?= PUBLIC_ROOT . "Todo/delete" ?>" method="post">
                <input type='hidden' name= "todo_id" value="<?= "todo-" . Encryption::encryptId($todo["id"]);?>">
                <input type='hidden' name = "csrf_token" value = "<?= Session::generateCsrfToken(); ?>">
                <button type="submit" name="submit" value="submit" class="btn btn-xs btn-danger">Delete</button>
            </form>


            <!-- in case of ajax request 
            <form action= "#"  method="post">
                <input type='hidden' name= "todo_id" value="<?= "todo-" . Encryption::encryptId($todo["id"]);?>">
                <button type="submit" name="submit" value="submit" class="btn btn-xs btn-danger">Delete</button>
            </form>
             -->
        </li>
    <?php } ?>
</ul>

</div>