<div class="container">
    <h1 class="mt-4 mb-5">Login</h1>
    <div class="row">
        <div class="col-lg-8 mb-4">
            <form action="/account/register">
                <div class="control-group form-group">
                    <div class="controls">
                        <label for="username">Username:</label>
                        <input placeholder="Choose username" type="text" class="form-control" name="username" id="username">
                        <p class="help-block"></p>
                    </div>
                </div>
                <div class="control-group form-group">
                    <div class="controls">
                        <label for="email">Email:</label>
                        <input placeholder="Enter email" type="email" class="form-control" name="email" id="email">
                        <p class="help-block"></p>
                    </div>
                </div>
                <div class="control-group form-group">
                    <div class="controls">
                        <label for="password">Password:</label>
                        <input placeholder="Choose password" type="text" class="form-control" name="password" id="password">
                        <p class="help-block"></p>
                    </div>
                </div>
                <div class="control-group form-group">
                    <div class="controls">
                        <label for="repassword">Confirm Password:</label>
                        <input placeholder="Repeat password" type="text" class="form-control" name="repassword" id="repassword">
                        <p class="help-block"></p>
                    </div>
                </div>
                <div id="success"></div>
                <button type="submit" class="btn btn-primary">Sign Up</button>
            </form>
        </div>
    </div>
</div>

<!-- OLD FORM
<div style="margin: 20px">
    <h2>Sign Up</h2>
    <br>
    <form action="/account/register" method="post">
        <p>Username</p>
        <p><input type="text" placeholder="Choose username" name="username">
        <p>Email</p>
        <p><input type="text" placeholder="Enter email" name="email">
        <p>Password</p>
        <p><input type="text" placeholder="Choose password" name="password">
        <p>Re-Password</p>
        <p><input type="text" placeholder="Repeat password" name="repassword">
            <br />
            <b><button style="margin-top: 10px" type="submit" value="Submit">Sign Up</button></b>
    </form>
</div>
-->

<?php
