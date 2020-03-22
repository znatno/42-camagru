<div class="container">
    <h1 class="mt-4 mb-3">Edit Profile</h1>
    <div class="row">
        <div class="col-lg-8 mb-4">
            <form class="mt-2 mb-4" onsubmit="return editProfileHandler();" action="/account/profile" method="post" name="edit-profile" id="editProfileForm">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input value="<?=$_SESSION['user']['username']?>" type="text" class="form-control" name="username" id="username" minlength="3" autocomplete="username" required>
                    <p class="help-block"></p>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input value="<?=$_SESSION['user']['email']?>" type="email" class="form-control" name="email" id="email" minlength="6" required>
                    <p class="help-block"></p>
                </div>
                <h5 class="mt-4 mb-4">Change Password</h5>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input placeholder="Type new password" type="password" class="form-control" name="password" id="password" minlength="8" autocomplete="new-password">
                    <p class="help-block"></p>
                </div>
                <h5 class="mt-4 mb-4">Notifications</h5>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="notification" id="notification">
                    <label class="form-check-label" for="defaultCheck1">Receive notifications about new comments on email</label>
                    <p class="help-block"></p>
                </div>
                <hr />
                <div id="success"></div>
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </form>
        </div>
    </div>
</div>