<div class="container">
  <h1 class="mt-4 mb-3">Forgot Password</h1>
  <div class="row">
    <div class="col-lg-8 mb-4">
      <form onsubmit="return forgotHandler();" action="/account/forgot-sent" method="post" name="forgot" id="forgotForm">
        <div class="control-group form-group">
          <div class="controls">
            <label for="email">Email:</label>
            <input type="email" class="form-control" name="email" id="email">
            <p class="help-block"></p>
          </div>
        </div>
        <div id="success"></div>
        <button type="submit" class="btn btn-primary">Reset Password</button>
      </form>
    </div>
  </div>
</div>