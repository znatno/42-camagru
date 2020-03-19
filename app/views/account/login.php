<div class="container">
    <h1 class="mt-4 mb-3">Log In</h1>
    <div class="row">
        <div class="col-lg-8 mb-4">
            <form onsubmit="return logInHandler();" action="/account/login" method="post" name="login" id="logInForm">
                <div class="control-group form-group">
                    <div class="controls">
                        <label for="username">Username:</label>
                        <input placeholder="" type="text" class="form-control" name="username" id="username" minlength="3" required>
                        <p class="help-block"></p>
                    </div>
                </div>
                <div class="control-group form-group">
                    <div class="controls">
                        <label for="password">Password:</label>
                        <input placeholder="" type="password" class="form-control" name="password" id="password" minlength="8" required>
                        <p class="help-block"></p>
                    </div>
                </div>
                <div id="success"></div>
                <button type="submit" class="btn btn-primary">Log In</button>
                <a href="/account/forgot" class="btn btn-link">Forgot Password</a>
            </form>
        </div>
    </div>
</div>
