<div class="container">
  <h1 class="mt-4 mb-3">Reset Password</h1>
  <div class="row">
    <div class="col-lg-8 mb-4">
      <form onsubmit="return resetPasswordHandler();" action="/account/reset-password-success" method="post" name="reset" id="resetForm">
        <div class="form-group">
          <label for="username">Username:</label>
          <input name=username" id="username" type="text" class="form-control" value="<?=$_SESSION['resetPassword']['username']?>" autocomplete="" readonly>
        </div>
        <div class="form-group">
          <label for="password">New Password:</label>
          <input placeholder="" type="password" class="form-control" name="password" id="password" minlength="8" autocomplete="new-password" required>
          <p class="help-block"></p>
        </div>
        <div id="success"></div>
        <button type="submit" class="btn btn-primary">Save</button>
      </form>
    </div>
  </div>
</div>
