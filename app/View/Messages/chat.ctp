<!-- app/View/Messages/chat.ctp -->

<div class="chat-container">
    <?php foreach ($messages as $message): ?>
        <div class="chat-message <?php echo ($message['Message']['user_id'] === $current_user) ? 'right' : 'left'; ?>">
            <?php echo h($message['Message']['message']); ?>
        </div>
    <?php endforeach; ?>
</div>
