<?php
return array(
    'makephoto' => 'makephoto/index',
    
    '^enrollment$' => 'enrollment/index',
    '^enrollment/confirm$' => 'enrollment/confirm',
    '^signup$' => 'enrollment/signup',
    '^signin$' => 'enrollment/signin',

    '^logout$' => 'user/logout',
    '^settings$' => 'user/settings',
    '^settings/save$'=> 'user/SaveSettings',
    '^restore$' => 'user/restore',
    '^restore(.*)$' => 'user/restore',
    '^restore/request$' => 'user/ForgotRequest',
    '^confirm(.*)$' => 'user/confirm'

);