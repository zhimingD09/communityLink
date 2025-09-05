<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="container about-container">
    <div class="row">
        <div class="col-md-8 mx-auto text-center">
            <h1 class="about-title">About CommunityLink</h1>
            <div class="about-content">
                <p class="lead">Connecting volunteers with meaningful opportunities to serve the community.</p>
            </div>
        </div>
    </div>
    
    <div class="row mt-5">
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-body text-center">
                    <i class="fas fa-hands-helping fa-4x mb-3 text-primary"></i>
                    <h3>Our Mission</h3>
                    <p>CommunityLink is dedicated to fostering community engagement by connecting passionate volunteers with organizations that make a difference. We believe in the power of collective action to create positive change.</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-body text-center">
                    <i class="fas fa-users fa-4x mb-3 text-primary"></i>
                    <h3>Who We Are</h3>
                    <p>Founded in 2023, CommunityLink has grown into a vibrant platform that brings together individuals and organizations committed to community service. Our team is passionate about creating meaningful connections.</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-body text-center">
                    <i class="fas fa-handshake fa-4x mb-3 text-primary"></i>
                    <h3>How It Works</h3>
                    <p>Volunteers sign up and get approved by our admin team. Organizations post events and opportunities. We facilitate the connection, making it easy for volunteers to find meaningful ways to contribute.</p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row mt-5">
        <div class="col-md-8 mx-auto">
            <div class="card">
                <div class="card-header text-center">
                    <h3>Get Involved</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="text-center">
                                <i class="fas fa-user-plus fa-3x mb-3 text-success"></i>
                                <h4>Become a Volunteer</h4>
                                <p>Join our community of dedicated volunteers making a difference. Sign up today to browse and register for upcoming events.</p>
                                <a href="<?php echo URLROOT; ?>/volunteers/register" class="btn btn-success">Sign Up as Volunteer</a>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="text-center">
                                <i class="fas fa-building fa-3x mb-3 text-info"></i>
                                <h4>Partner with Us</h4>
                                <p>Are you an organization looking for volunteers? Partner with CommunityLink to post events and find dedicated volunteers.</p>
                                <a href="<?php echo URLROOT; ?>/organizations/register" class="btn btn-info">Register Organization</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row mt-5 mb-5">
        <div class="col-md-8 mx-auto text-center">
            <h3>Contact Us</h3>
            <p>Have questions or feedback? We'd love to hear from you!</p>
            <p><i class="fas fa-envelope"></i> Email: info@communitylink.org</p>
            <p><i class="fas fa-phone"></i> Phone: (123) 456-7890</p>
            <div class="social-icons mt-3">
                <a href="#" class="social-icon"><i class="fab fa-facebook fa-2x"></i></a>
                <a href="#" class="social-icon"><i class="fab fa-twitter fa-2x"></i></a>
                <a href="#" class="social-icon"><i class="fab fa-instagram fa-2x"></i></a>
                <a href="#" class="social-icon"><i class="fab fa-linkedin fa-2x"></i></a>
            </div>
        </div>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>