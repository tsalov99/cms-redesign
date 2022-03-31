<form method="post" action="/posts/addComment/<?=$post['id']?>">
  <div class="form-group">
    <label>Name</label>
    <input name="name" type="text" class="form-control">
  </div>
  <div class="form-group">
    <label>Comment</label>
    <input name="content" type="text" class="form-control">
  </div>
  <div class="g-recaptcha" data-sitekey="6LfhQjIfAAAAAH96AU6YC7qoJtcPM3K31PdZ1pte"></div>
      <br/>
  <button type="submit" class="btn btn-dark">Submit</button>
</form>