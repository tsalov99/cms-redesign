<form method="post" class="p-5 bg-light" action="/posts/addComment/<?=$post['id']?>">
  <div class="form-group">
    <label class="display-4">Leave a comment</label>
    <input name="name" type="text" class="form-control" placeholder="Name" required>
  </div>
  <div class="form-group">
    <input name="content" type="text" class="form-control" placeholder="Comment" required>
  </div>
  <div class="g-recaptcha" data-sitekey="6LfhQjIfAAAAAH96AU6YC7qoJtcPM3K31PdZ1pte"></div>
      <br/>
  <button type="submit" class="btn btn-dark">Submit</button>
</form>