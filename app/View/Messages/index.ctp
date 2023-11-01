<h1>Conversations</h1>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Recipient</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($messages as $message) : ?> <!--  $users was declared from app/Controller/UsersController.php -->
        <tr>
            <td><?php echo $message['Message']['id']; ?></td>
            <td><?php echo $message['Message']['user_id']; ?></td>
            <td>
                <?php echo $this->Html->link('View', array('controller' => 'messages', 'action' => 'chat', $message['Message']['user_id'])); ?>
                <?php echo $this->Form->postLink('Delete', array('controller' => 'messages', 'action' => 'delete', $message['Message']['id']), array('confirm' => 'Are you sure you want to delete this?')); ?>
            </td>
        </tr>
        <?php endforeach; ?>
        <?php unset($message); ?>
    </tbody>
    
    <tfoot></tfoot>
</table>

