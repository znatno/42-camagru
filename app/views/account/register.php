<div class="container">
    <h1 class="mt-4 mb-5">Sign Up</h1>
    <div class="row">
        <div class="col-lg-8 mb-4">
            <form onsubmit="return signUpHandler();" action="/account/confirm" method="post" name="register" id="signUpForm">
                <div class="control-group form-group">
                    <div class="controls">
                        <label for="username">Username:</label>
                        <input placeholder="Choose username" title="Username can consist only numbers and latin letters (from 3 to 24 symbols)" type="text" class="form-control" name="username" id="username" pattern="^[A-Za-z0-9]{3,24}$" minlength="3" maxlength="24" required>
                        <p class="help-block"></p>
                    </div>
                </div>
                <div class="control-group form-group">
                    <div class="controls">
                        <label for="email">Email:</label>
                        <input placeholder="Enter email" title="Invalid email address" type="email" class="form-control" name="email" id="email" pattern="[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+.[a-zA-Z]{2,4}" minlength="6" maxlength="100" required>
                        <p class="help-block"></p>
                    </div>
                </div>
                <div class="control-group form-group">
                    <div class="controls">
                        <label for="password">Password:</label>
                        <input placeholder="Choose password" type="password" class="form-control" name="password" id="password" minlength="8" maxlength="100" required>
                        <p class="help-block"></p>
                    </div>
                </div>
                <div id="success"></div>
                <button type="submit" class="btn btn-primary">Sign Up</button>
            </form>
        </div>
    </div>
</div>
