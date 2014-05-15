<div class="message_container you-message">
    <div class="message_author">
        Вы
        <span class="message_date">{$message->create_date|date_format:"%H:%M:%S %d.%m.%Y"}</span>
    </div>
    <div class="message_text">
        {$message->message}
    </div>
</div>