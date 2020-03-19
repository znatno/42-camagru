<div class="container">
    <h1 class="mt-4 mb-3">Reset Password</h1>
    <div class="row">
        <div class="col-lg-8 mb-4">
            <form onsubmit="return resetHandler();" action="/account/reset-password-done" method="post" name="reset" id="resetForm">
                <div class="control-group form-group">
                    <div class="controls">
                        <label for="password">New Password:</label>
                        <input placeholder="" type="password" class="form-control" name="password" id="password" minlength="8" required>
                        <p class="help-block"></p>
                    </div>
                </div>
                <div id="success"></div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
</div>
