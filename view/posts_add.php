<?php require(LAYOUT_PATH . 'top.php');?>


<form action="<?=URL_BASE . "posts/save"?>" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label>Title</label>
        <input  type="text" name="title" value="<?= isset($_POST['title']) ? htmlspecialchars($_POST['title']) : '' ;?>">
        <label>Short description</label>
        <input type="text" name="short_description" value="<?= 'asd'?>"> <br>

        <label>Content</label>
        <textarea name="content" id="tiny" value=""></textarea>
        
        <label>Slug</label>
        <input type="text" name="slug" value=""> <br>

        <label>Date created</label>
        <input type="datetime-local" name="created"> <br>

        <label>Created:</label>

        <label>Post image:</label> <br>
        <input type="file" name="imgUpload[]" multiple> <br>

        <label>Active</label>
        <input type="radio" name="active" value=1 checked>
        <label>Hidden</label>
        <input type="radio" name="active" value=0>
        <br>

        <input type="submit" value="Add post">
    </div>
</form>



<?php require(LAYOUT_PATH . 'bottom.php');?>