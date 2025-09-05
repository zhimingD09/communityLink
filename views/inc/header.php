<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITENAME; ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/style.css">
</head>
<body>
    <?php require APPROOT . '/views/inc/navbar.php'; ?>
    <div class="container">
        <?php flash('login_required'); ?>
        <?php flash('access_denied'); ?>
        <?php flash('register_success'); ?>
        <?php flash('login_error'); ?>
        <?php flash('profile_success'); ?>
        <?php flash('admin_success'); ?>
        <?php flash('admin_error'); ?>
        <?php flash('event_success'); ?>
        <?php flash('event_error'); ?>