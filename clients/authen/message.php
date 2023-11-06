<?php
if(isset($_SESSION['message']))
{
    $message_type = isset($_SESSION['message_type']) ? $_SESSION['message_type'] : 'success';
    $alert_class = '';
    if ($message_type === 'error') {
        $alert_class = 'alert-danger';
    } elseif ($message_type === 'success') {
        $alert_class = 'alert-success';
    } elseif ($message_type === 'warning') {
        $alert_class = 'alert-warning';
    }
    ?>
        <div class="alert <?= $alert_class; ?> alert-dismissible fade show" role="alert">
            <strong>Hey!</strong><?= $_SESSION['message']; ?>
        </div>
    <?php
    unset($_SESSION['message']);
    unset($_SESSION['message_type']);
}
?>
