<?php require(LAYOUT_PATH . 'top.php');?>

<?php require(LAYOUT_PATH . 'navigation.php');?>

<form action="<?=URL_BASE . "posts/save/" . $post['id'];?>" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label>Title</label>
        <input  type="text" name="title" value="<?= isset($post['title']) ? $post['title'] : '';?>">
        <?= isset($errors['title']) ? $errors['title'] : '' ;?>

        <label>Short description</label>
        <input type="text" name="short_description" value="<?= isset($post['short_description']) ? $post['short_description'] : '';?>"> <br>
        <?= isset($errors['short_description']) ? $errors['short_description'] : '' ;?>

        <label>Content</label>
        <textarea name="content" id="tiny" value=""><?= isset($post['content']) ? $post['content'] : '';?></textarea>
        <?= isset($errors['content']) ? $errors['content'] : '' ;?>

        <label>Slug</label>
        <input type="text" name="slug" value="<?= isset($post['slug']) ? $post['slug'] : '';?>"> <br>
        <?= isset($errors['slug']) ? $errors['slug'] : '' ;?>

        <label>Date created</label>
        <input type="datetime-local" name="created" value="<?= isset($post['created']) ? $post['created'] : ""; ?>"> <br>

        <!--
        <label>Post image:</label> <br>
        <input type="file" name="imgUpload[]" multiple> <br>
        //-->

        <label>Active</label>
        <input type="radio" name="active" value=1 checked>
        <label>Hidden</label>
        <input type="radio" name="active" value=0>
        <br>

        <input type="submit" value="Update post">
    </div>
</form>



<?php require(LAYOUT_PATH . 'bottom.php');?>