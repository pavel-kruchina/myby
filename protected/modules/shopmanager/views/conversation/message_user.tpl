<div class="message_container">
    <div class="message_author">
        {$user->name} {$user->sname}
        <span class="message_date">{$message->create_date|date_format:"%H:%M:%S %d.%m.%Y"}</span>
    </div>
    <div class="message_text">
        {$message->message}
    </div>
</div>