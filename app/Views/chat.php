<?= $this->extend('layout/Master') ?>
<?= $this->section('content'); ?>

<div class="container">
    <div class="row">
        <div class="col-12">
            <h1 class="text-bold text-center py-4"><?= $chat->nazev_eventu; ?></h1>
            <div class="chat border rounded p-3" style="height: 400px; overflow-y: auto;">
                <ul class="chat-list list-unstyled">
                    <!-- Chat messages will be appended here dynamically -->
                </ul>
            </div>
        </div>
        <div class="col-12">
            <form id="chatSendForm" class="mb-4">
                <div class="input-group">
                    <input type="text" id="chid" hidden value="<?= $chat->id ?>">
                    <input type="text" id="chatMessage" class="form-control" placeholder="Napiš zprávu...">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-primary">Odeslat</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript" src="<?= base_url('/assets/bootstrap/js/chat.js'); ?>"></script>
<?= $this->endSection(); ?>
