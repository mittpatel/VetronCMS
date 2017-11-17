<?php

return [
    'driver' => config('aSetting.admin_MailDriver'),

    'host' => config('aSetting.admin_MailHost'),

    'port' => config('aSetting.admin_MailPort'),

    'from' => ['address' => config('aSetting.admin_MailSendAddress'), 'name' => config('aSetting.admin_MailSendName')],

    'encryption' => config('aSetting.admin_MailEncryption'),

    'username' => config('aSetting.admin_MailUsername'),

    'password' => config('aSetting.admin_MailUserPassword'),

    'sendmail' => '/usr/sbin/sendmail -bs',
];
