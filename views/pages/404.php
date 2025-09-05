<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="container error-container text-center">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="error-content">
                <h1 class="display-1">404</h1>
                <h2 class="mb-4">Page Not Found</h2>
                <p class="lead">Sorry, the page you are looking for does not exist or has been moved.</p>
                <a href="<?php echo URLROOT; ?>" class="btn btn-primary mt-3">Go to Homepage</a>
            </div>
        </div>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>