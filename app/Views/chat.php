<?= $this->extend('layout/Master') ?>
<?= $this->section('content'); ?>

<div class="container">
   <div class="row">
    <div class="col-12">
        <h1>Chat | Event:  <?= $chat->nazev_eventu; ?></h1>
        <div class="chat">
            <ul class="chat-list">

            </ul>
        </div>
    </div>
    <div class="col-12">
        <form id="chatSendForm">
            <div class="d-flex ">
                <input type="text" id="chid" hidden value="<?= $chat->id ?>">       
                <input type="text" id="chatMessage" class="form-control" placeholder="Napiš zprávu...">
                <button type="submit" class="btn btn-primary">Odeslat</button>
            </div>
        </form>
    </div>
   </div>
</div>

<script type="text/javascript" src="<?= base_url('/assets/bootstrap/js/chat.js'); ?>"></script>
<?= $this->endSection(); ?>