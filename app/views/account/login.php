<div class="container">
    <h1 class="mt-4 mb-3">Login</h1>
    <div class="row">
        <div class="col-lg-8 mb-4">
            <form action="/account/login" method="post" name="login">
                <div class="control-group form-group">
                    <div class="controls">
                        <label for="username">Username:</label>
                        <input type="text" class="form-control" name="username" id="username">
                        <p class="help-block"></p>
                    </div>
                </div>
                <div class="control-group form-group">
                    <div class="controls">
                        <label for="password">Password:</label>
                        <input type="text" class="form-control" name="password" id="password">
                        <p class="help-block"></p>
                    </div>
                </div>
                <div id="success"></div>
                <button type="submit" class="btn btn-primary">Login</button>
                <a href="/account/forgot" class="btn btn-link">Forgot Password</a>
            </form>
        </div>
    </div>
</div>
