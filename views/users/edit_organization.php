<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="container">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="form-container">
                <h2>Edit Organization Profile</h2>
                <form action="<?php echo URLROOT; ?>/organizations/edit" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name">Organization Name</label>
                        <input type="text" name="name" class="form-control <?php echo (!empty($data['name_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['name']; ?>">
                        <span class="invalid-feedback"><?php echo $data['name_err']; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control <?php echo (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['email']; ?>" readonly>
                        <span class="invalid-feedback"><?php echo $data['email_err']; ?></span>
                        <small class="form-text text-muted">Email cannot be changed</small>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" name="phone" class="form-control <?php echo (!empty($data['phone_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['phone']; ?>">
                        <span class="invalid-feedback"><?php echo $data['phone_err']; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="website">Website</label>
                        <input type="text" name="website" class="form-control <?php echo (!empty($data['website_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['website']; ?>">
                        <span class="invalid-feedback"><?php echo $data['website_err']; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" name="address" class="form-control <?php echo (!empty($data['address_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['address']; ?>">
                        <span class="invalid-feedback"><?php echo $data['address_err']; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" class="form-control <?php echo (!empty($data['description_err'])) ? 'is-invalid' : ''; ?>" rows="5"><?php echo $data['description']; ?></textarea>
                        <span class="invalid-feedback"><?php echo $data['description_err']; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="logo">Organization Logo</label>
                        <?php if(!empty($data['logo'])) : ?>
                            <div class="mb-2">
                                <img src="<?php echo URLROOT; ?>/public/img/organizations/<?php echo $data['logo']; ?>" alt="Current Logo" class="img-thumbnail" style="max-width: 200px;">
                                <p>Current logo</p>
                            </div>
                        <?php endif; ?>
                        <input type="file" name="logo" class="form-control-file <?php echo (!empty($data['logo_err'])) ? 'is-invalid' : ''; ?>">
                        <span class="invalid-feedback"><?php echo $data['logo_err']; ?></span>
                        <small class="form-text text-muted">Accepted formats: jpg, jpeg, png, gif (Max size: 2MB)</small>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Update Profile" class="btn btn-success">
                        <a href="<?php echo URLROOT; ?>/organizations/profile/<?php echo $_SESSION['user_id']; ?>" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>