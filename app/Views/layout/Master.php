<!DOCTYPE html>
<html lang="cs">
<head>
    <title>EventFusion</title>
    <link type="text/css" rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css'); ?>">
    <link type="text/css" rel="stylesheet" href="<?= base_url('assets/css/custom.css'); ?>">
    <link type="text/css" rel="stylesheet" href="<?= base_url('assets/css/bootstrap-duallistbox.min.css'); ?>">
    <link rel="icon" href="<?= base_url('/eventfussion.png'); ?>">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link rel="stylesheet" type="text/css" href="<?= base_url('/assets/dist/bootstrap-duallistbox.css'); ?>">

    <script src="<?= base_url('/assets/js/jquery.js'); ?>"></script>
    <script src="<?= base_url('/assets/js/fullcalendar.io.js?v=1'); ?>"></script>


    <style>
        .barvicka {
            background-color: blue;
        }
    </style>
    <?php if (\App\Helpers\User::isLoggedIn()) : ?>
        <script>
            var userId = "<?= \App\Helpers\User::user()->id; ?>";
            var first = "<?= \App\Helpers\User::user()->first_name; ?>";
            var last = "<?= \App\Helpers\User::user()->last_name; ?>";
        </script>
    <?php endif; ?>

</head>

<body>
    <?= $this->include('layout/navbar'); ?>

    <main>
        <div class="container-fluid">
            <?php if (session()->get('flash-error')) : ?>
                <div class="container">
                    <div class="alert alert-danger alert-dismissible text-center mt-1" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">x</span>
                        </button>
                        <?= session()->get('flash-error'); ?>
                    </div>
                </div>
            <?php endif; ?>
            <?php if (session()->get('flash-success')) : ?>
                <div class="container">
                    <div class="alert alert-success alert-dismissible text-center mt-1" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <?= session()->get('flash-success'); ?>
                    </div>
                </div>
            <?php endif; ?>
            <!--Area for dynamic content -->
            <?= $this->renderSection("content"); ?>
        </div>
    </main>

 
    <script src="<?= base_url('/assets/js/popper.min.js'); ?>"></script>
    <script src="<?= base_url('/assets/js/bootstrap.min.js'); ?>"></script>
    <script src="<?= base_url('/assets/js/jquery.validate.min.js'); ?>"></script>
    <script src="<?= base_url('/assets/js/leaflat.js'); ?>"></script>
    <script src="<?= base_url('/assets/js/login.js'); ?>"></script>
    <script src="<?= base_url('/assets/js/moment.js'); ?>"></script>
    <script src="<?= base_url('/assets/js/flatpickr.cs.js'); ?>"></script>
    <script src="<?= base_url('/assets/js/duallistbox.cs.js'); ?>"></script>
    <script src="<?= base_url('/assets/js/custom.js'); ?>"></script>

    

<body>
</html>