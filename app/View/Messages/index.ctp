<div class="row d-flex justify-content-center mt-5 mb-5">
    <div class="col-7">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h2>Message</h2>
                <?php
                    echo $this->Html->link('<i class="fa fa-plus-square" aria-hidden="true"></i> Add Message', array( 
                        'controller' => 'messages',
                        'action'=> 'addMessage'
                    ), array(
                        'class' => 'btn btn-outline-secondary',
                        'type' => 'button',
                        'escape' => false,
                        'label' => false,
                        'full_base' => true
                    )
                );
                ?>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <td>User</td>
                        <td>Date</td>
                        <td>Action</td>
                    </thead>
                    <tbody>
                        <?php foreach ($conversations as $chat):?>
                                <?php if (!empty($chat)):?>
                                <tr>
                                    <?php if ($current_user['id'] == $chat['Recipient']['id']): ?>
                                        <td class="text-danger">
                                             <?php 
                                                // if the user is the recipient 
                                                $senderUser = isset($chat['Sender']['name']) ? $chat['Sender']['name'] : '';
                                                echo $senderUser; 
                                            ?>
                                        </td>
                                    <?php else:?>
                                        <td>
                                            <?php 
                                                $recipientUser = isset($chat['Recipient']['name']) ? $chat['Recipient']['name'] : '';
                                                echo $recipientUser;
                                            ?>
                                        </td>
                                    <?php endif;?>
                                    <td>
                                        <?php 
                                            $date = isset($chat['Conversation']['created']) ? gmdate('Y-m-d g:i A', strtotime($chat['Conversation']['created'])) : '';
                                            echo $date;
                                        ?>
                                    </td>
                                    <td>
                                        <?php 
                                            // View Conversation
                                            echo $this->Html->link('<i class="fa fa-external-link" aria-hidden="true">View</i>', array(
                                                'controller'=> 'messages',
                                                'action'=> 'viewMessage',
                                                $chat['Conversation']['id']
                                            ), array(
                                                'class'=> 'btn btn-primary mx-2',
                                                'full_base' => true,
                                                'escape' => false,
                                                'label' => false,
                                            ));
                                            
                                            // Delete Conversation
                                            echo $this->Html->link('<i class="fa fa-trash" aria-hidden="true">Delete</i>', array(
                                                'controller'=> 'messages',
                                                'action'=> 'deleteConversation',
                                                $chat['Conversation']['id']
                                            ), array(
                                                'class' => 'btn btn-secondary mx-2',
                                                'full_base'=> true,
                                                'escape' => false,
                                                'label' => false,
                                                'confirm' => 'Are you sure you want to delete this?'
                                            ));
                                        ?>
                                    </td>
                                </tr>
                                <?php else:?>
                                    <tr>
                                        <td colspan="3" class="text-center">No Conversation</td>
                                    </tr>
                            <?php endif;?>
                        <?php endforeach;?>
                    </tbody>
                </table>
                <div class="row">
                    <div class="col-12 text-center">
                        <button class="btn btn-link" id="show-more">Show More</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        var userId = "<?php echo $current_user['id'];?>"
        var page = 2; // Initialize the page number for pagination
        var isLoading = false; // Flag to prevent multiple simultaneous requests
        
        // Action Url
        var updateUrl = '<?php echo $this->Html->url(array('controller' => 'messages', 'action' => 'viewMessage'), true); ?>';
        var deleteUrl = '<?php echo $this->Html->url(array('controller' => 'messages', 'action' => 'deleteConversation'), true); ?>';

        // Function to load more data
        function loadMoreData() {
            if (!isLoading) {
                isLoading = true;
                $.ajax({
                    url: "<?php echo $this->Html->url(array('controller' => 'Messages', 'action' => 'loadMore'));?>",
                    type: "get",
                    data: {
                        page: page,
                    },
                    dataType: 'json', // Expect JSON data in response
                    beforeSend: function() {
                        $('#show-more').html('Loading...');
                    },
                    success: function(data) {
                        console.log(data);
                        if (data.length > 0) {
                            // Append the new data to the table's tbody
                            $.each(data, function(index, conversation) {
                                if (userId == conversation.Recipient_id) {
                                    var row = `<tr>;
                                        <td class="text-danger">`+ conversation.Sender.name +`</td>
                                        <td>`+ moment(conversation.Conversation.created).format("YYYY-MM-DD H:mm A") +`</td>
                                        <td><a class="btn btn-success text-light mr-1" href="`+ updateUrl + '/' + conversation.Conversation.id +`" ><i class="fa fa-external-link" aria-hidden="true"></i></a><a class="btn btn-danger text-light" href="`+ deleteUrl + '/' + conversation.Conversation.id +`"><i class="fa fa-trash" aria-hidden="true"></i></a> </td>
                                    </tr>`;
                                    $('.table tbody').append(row);
                                } else {
                                    var row = `<tr>;
                                        <td>`+ conversation.Recipient.name +`</td>
                                        <td>`+ moment(conversation.Conversation.created).format("YYYY-MM-DD H:mm A") +`</td>
                                        <td><a class="btn btn-success text-light mr-1" href="`+ updateUrl + '/' + conversation.Conversation.id +`"><i class="fa fa-external-link" aria-hidden="true"></i></a><a class="btn btn-danger text-light" href="`+ deleteUrl + '/' + conversation.Conversation.id +`"><i class="fa fa-trash" aria-hidden="true"></i></a> </td>
                                    </tr>`;
                                    $('.table tbody').append(row);
                                }
                            });
                            isLoading = false;
                            page++;
                            $('#show-more').html('Show More');
                        } else {
                            $('#show-more').html('No more records');
                        }
                    },
                });
            }
        }

        $('#show-more').click(function() {
            loadMoreData();
        });

    });
</script>