<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="form-container">
            <h2 class="text-center">Login</h2>
            <p class="text-center">Please fill in your credentials to log in</p>
            <form action="<?php echo URLROOT; ?>/login" method="post">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control <?php echo (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['email']; ?>">
                    <span class="invalid-feedback"><?php echo $data['email_err']; ?></span>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control <?php echo (!empty($data['password_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['password']; ?>">
                    <span class="invalid-feedback"><?php echo $data['password_err']; ?></span>
                </div>
                <div class="row">
                    <div class="col">
                        <input type="submit" value="Login" class="btn btn-primary btn-block">
                    </div>
                </div>
            </form>
            <div class="text-center mt-3">
                <p>No account yet? Register as:</p>
                <a href="<?php echo URLROOT; ?>/volunteers/register" class="btn btn-outline-primary mr-2">Volunteer</a>
                <a href="<?php echo URLROOT; ?>/organizations/register" class="btn btn-outline-success">Organization</a>
            </div>
        </div>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>