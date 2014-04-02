<div class="contactInfo">
    <b>{$openUsers[$contact->user_id]->name} {$openUsers[$contact->user_id]->sname}</b> <a href="http://vk.com/id{$openUsers[$contact->user_id]->viewer_id}" target="_blank">Профиль вконтакте</a> <br />
    <b>Телефон:</b> {$contact->phone}; <b>Почта:</b> {$contact->mail} <br />
    {$contact->comment}
</div>