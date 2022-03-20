<?php require(LAYOUT_PATH . 'top.php');?>

<?php require(LAYOUT_PATH . 'navigation.php');?>



<form action="<?=URL_BASE . "posts/sav"?>" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label>Title</label>
        <input  type="text" name="title" value="<?= isset($_POST['title']) ? $_POST['title'] : '';?>"> 
        <?= isset($errors['title']) ? $errors['title'] : '' ;?> <br>

        <label>Short description</label>
        <input type="text" name="short_description" value="<?= isset($_POST['short_description']) ? $_POST['short_description'] : '';?>"> 
        <?= isset($errors['short_description']) ? $errors['short_description'] : '' ;?><br>

        <label>Content</label>
        <textarea name="content" id="tiny"><?= isset($_POST['content']) ? $_POST['content'] : '';?></textarea>
        <?= isset($errors['content']) ? $errors['content'] : '' ;?> <br>

        <label>Slug</label>
        <input type="text" name="slug" value="<?= isset($_POST['slug']) ? $_POST['slug'] : '';?>"> 
        <?= isset($errors['slug']) ? $errors['slug'] : '' ;?> <br>

        <label>Date created</label>
        <input type="datetime-local" name="created" value="<?= isset($_POST['created']) ? $post['created'] : date('Y-m-d\TH:i', time() + 2*60*60); ?>"> <br>

        <!--
        <label>Post image:</label> <br>
        <input type="file" name="imgUpload[]" multiple> <br>
        -->
        
        <label>Active</label>
        <input type="radio" name="active" value=1 checked>
        <label>Hidden</label>
        <input type="radio" name="active" value=0>
        <br>

        <input type="submit" value="Add post">
    </div>
</form>



<?php require(LAYOUT_PATH . 'bottom.php');?>