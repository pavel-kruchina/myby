<div class="conversation_container">
    <div class="conversation_name">
        {if $conversation->user_unread=='yes'}
        <div class="message_unread"></div>
        {/if}
        <a href="{Yii::app()->request->baseUrl}/public/conversation/one/{$conversation->id}">{$conversation->title}</a>
        <span class="conversation_date">{$conversation->create_date|date_format:"%H:%M:%S %d.%m.%Y"}</span>
    </div>
    <div class="conversation_shop_user">
        {$shopUsers[$conversation->shop_user_id]->name}
    </div>
</div>