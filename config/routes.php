<?php
return array(
   
    
    '^enrollment$' => 'enrollment/index',
    '^enrollment/confirm$' => 'enrollment/confirm',
    '^signup$' => 'enrollment/signup',
    '^signin$' => 'enrollment/signin',

    '^logout$' => 'user/logout',
    '^settings$' => 'user/settings',
    '^settings/save$'=> 'user/SaveSettings',

    '^restore$' => 'user/restore',
    '^restore/request$' => 'user/ForgotRequest',
    '^restore/request/password-form-data$' => 'user/SetNewPassword',
    '^restore/request/email$' => 'user/CheckYourEmail',
    '^restore/request/password(.*)$' => 'user/PasswordRestore',

    '^gallery$' => 'gallery/index',
    '^makephoto$' => 'makephoto/index',
    '^makephoto/savePhoto$' => 'makephoto/savePhoto',

    '^restore(.*)$' => 'user/restore',
    '^confirm(.*)$' => 'user/confirm'

    
);