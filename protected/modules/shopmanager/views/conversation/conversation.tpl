<div class="conversation_container">
    <div class="conversation_name">
        {if $conversation->shop_user_unread=='yes'}
        <div class="message_unread"></div>
        {/if}
        <a href="{Yii::app()->request->baseUrl}/shopmanager/conversation/one/{$conversation->id}">{$conversation->title}</a>
        <span class="conversation_date">{$conversation->create_date|date_format:"%H:%M:%S %d.%m.%Y"}</span>
    </div>
    <div class="conversation_shop_user">
        {$users[$conversation->user_id]->name} {$users[$conversation->user_id]->sname}
    </div>
</div>