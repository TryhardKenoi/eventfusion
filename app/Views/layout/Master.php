<!DOCTYPE html>
<html>
<head>
    <title>Kenoi's website</title>
    <link type="text/css" rel="stylesheet" href="<?= base_url('assets/bootstrap/css/bootstrap.min.css'); ?>">
    <link type="text/css" rel="stylesheet" href="<?= base_url('assets/bootstrap/css/custom.css'); ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

    <!-- PLUGIN -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('/assets/dist/bootstrap-duallistbox.css'); ?>">
    <link rel="icon" href="<?= base_url('/eventfussion.png'); ?>">
    <script type="text/javascript" src="<?= base_url('/assets/bootstrap/js/jquery.js'); ?>"></script>

        

    <style>
    .barvicka {
            background-color: blue;
        }
    </style>
    <?php if(\App\Helpers\User::isLoggedIn()): ?>
        <script>
        var userId = "<?= \App\Helpers\User::user()->id; ?>";
        var first = "<?= \App\Helpers\User::user()->first_name; ?>";
        var last = "<?= \App\Helpers\User::user()->last_name; ?>";
    </script>
    <?php endif;?>

</head>
    <body>
        <?= $this->include('layout/navbar'); ?>
        <div class="container-fluid">
            <?php if(session()->get('flash-error')): ?>
                <div class="container">
                    <div class="alert alert-danger alert-dismissible text-center mt-1" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">x</span>
                        </button>
                        <?= session()->get('flash-error');?>
                    </div>
                </div>
            <?php endif;?>
            <?php if(session()->get('flash-success')): ?>
                <div class="container">
                    <div class="alert alert-success alert-dismissible text-center mt-1" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <?= session()->get('flash-success');?>
                    </div>
                </div>
            <?php endif;?>
            <!--Area for dynamic content -->
            <?= $this->renderSection("content"); ?>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
        <script src='https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@6.1.9/index.global.min.js'></script>
        <script type="text/javascript" src="<?= base_url('/assets/bootstrap/js/custom.js'); ?>"></script>
        <script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/core/locales/cs.js"></script>
        
        <script src="<?= base_url('/assets/dist/jquery.bootstrap-duallistbox.min.js'); ?>"></script>

    <body>
</html>
