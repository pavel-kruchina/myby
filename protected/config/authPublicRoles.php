<?php

return array(
    'guest' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Guest',
        'bizRule' => null,
        'data' => null
    ),
    
    ROLE_USER => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Moderator',
        'children' => array(
            'guest',          // РїРѕР·РІРѕР»РёРј РјРѕРґРµСЂР°С‚РѕСЂСѓ РІСЃС‘, С‡С‚Рѕ РїРѕР·РІРѕР»РµРЅРѕ РїРѕР»СЊР·РѕРІР°С‚РµР»СЋ
        ),
        'bizRule' => null,
        'data' => null
    ),
    
    ROLE_ADMIN => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Administrator',
        'children' => array(
            ROLE_USER,         // РїРѕР·РІРѕР»РёРј Р°РґРјРёРЅСѓ РІСЃС‘, С‡С‚Рѕ РїРѕР·РІРѕР»РµРЅРѕ РјРѕРґРµСЂР°С‚РѕСЂСѓ
        ),
        'bizRule' => null,
        'data' => null
    ),
);