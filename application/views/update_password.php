<h1>Update Password</h1>
<?php echo form_open('user/update_password_process'); ?>
    <label for="old_password">Old Password:</label>
    <input type="password" name="old_password" required><br><br>
    <label for="new_password">New Password:</label>
    <input type="password" name="new_password" required><br><br>
    <label for="confirm_password">Confirm Password:</label>
    <input type="password" name="confirm_password" required><br><br>
    <input type="submit" value="Update Password">
</form>
