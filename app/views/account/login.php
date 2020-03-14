<div class="container">
    <h1 class="mt-4 mb-3">Login</h1>
    <div class="row">
        <div class="col-lg-8 mb-4">
            <form action="/account/login" method="post">
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
            </form>
        </div>
    </div>
</div>

<!-- OLD FORM
<div style="margin: 20px">
    <h2>Sign In</h2>
    <br>
    <form action="/account/login" method="post">
        <label>Username
            <br>
            <input type="text" name="username">
        </label>
        <br>
        <label>Password
            <br>
            <input type="text" name="password">
        </label>
        <br>
        <button type="submit" name="enter">Login</button></b>
    </form>
</div>
-->

<?php
