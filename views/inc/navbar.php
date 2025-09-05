<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-3">
    <div class="container">
        <a class="navbar-brand" href="<?php echo URLROOT; ?>"><?php echo SITENAME; ?></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item <?php echo (isActiveUrl('')) ? 'active' : ''; ?>">
                    <a class="nav-link" href="<?php echo URLROOT; ?>">Home</a>
                </li>
                <li class="nav-item <?php echo (isActiveUrl('about')) ? 'active' : ''; ?>">
                    <a class="nav-link" href="<?php echo URLROOT; ?>/about">About</a>
                </li>
                <li class="nav-item <?php echo (isActiveUrl('events')) ? 'active' : ''; ?>">
                    <a class="nav-link" href="<?php echo URLROOT; ?>/events">Events</a>
                </li>
            </ul>
            
            <ul class="navbar-nav ml-auto">
                <?php if(isLoggedIn()) : ?>
                    <?php if(isAdmin()) : ?>
                        <li class="nav-item <?php echo (isActiveUrl('admin')) ? 'active' : ''; ?>">
                            <a class="nav-link" href="<?php echo URLROOT; ?>/admin">Admin Dashboard</a>
                        </li>
                    <?php endif; ?>
                    
                    <?php if(isVolunteer() && isHired()) : ?>
                        <li class="nav-item <?php echo (isActiveUrl('events/myEvents')) ? 'active' : ''; ?>">
                            <a class="nav-link" href="<?php echo URLROOT; ?>/events/myEvents">My Events</a>
                        </li>
                    <?php endif; ?>
                    
                    <?php if(isOrganization()) : ?>
                        <li class="nav-item <?php echo (isActiveUrl('events/create')) ? 'active' : ''; ?>">
                            <a class="nav-link" href="<?php echo URLROOT; ?>/events/create">Create Event</a>
                        </li>
                        <li class="nav-item <?php echo (isActiveUrl('events/organizationEvents')) ? 'active' : ''; ?>">
                            <a class="nav-link" href="<?php echo URLROOT; ?>/events/organizationEvents">My Events</a>
                        </li>
                    <?php endif; ?>
                    
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Welcome, <?php echo $_SESSION['user_name']; ?>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="<?php echo URLROOT; ?>/profile">Profile</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="<?php echo URLROOT; ?>/logout">Logout</a>
                        </div>
                    </li>
                <?php else : ?>
                    <li class="nav-item <?php echo (isActiveUrl('login')) ? 'active' : ''; ?>">
                        <a class="nav-link" href="<?php echo URLROOT; ?>/login">Login</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle <?php echo (isActiveUrl('volunteers/register') || isActiveUrl('organizations/register')) ? 'active' : ''; ?>" href="#" id="registerDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Register
                        </a>
                        <div class="dropdown-menu" aria-labelledby="registerDropdown">
                            <a class="dropdown-item" href="<?php echo URLROOT; ?>/volunteers/register">As Volunteer</a>
                            <a class="dropdown-item" href="<?php echo URLROOT; ?>/organizations/register">As Organization</a>
                        </div>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>