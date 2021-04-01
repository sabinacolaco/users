<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>
            <?= (!empty($page_title)) ? $page_title : 'Users';?>
        </title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">    <link rel="stylesheet" href="assets/css/style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
        <div class="container-full">
            <header class="header">
                <h3>Users</h3><br>
                <?php echo $this->session->userdata('authenticated') == TRUE ? '<a href="' . base_url() . 'dashboard"><button class="btn"><i class="fa fa-home"></i> Home</button></a>' : '<a href="' . base_url() . '"><button class="btn"><i class="fa fa-home"></i> Home</button></a>'; ?>
                <?php echo $this->session->userdata('authenticated') == TRUE ? '<a href="' . base_url() . 'logout"><button class="btn"><i class="fa fa-sign-out"></i> Logout</button></a>' : '<a href="' . base_url() . '"><button class="btn"><i class="fa fa-sign-in"></i> Login</button></a>'; ?>
            </header>