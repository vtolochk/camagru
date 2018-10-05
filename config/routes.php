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

    '^makephoto$' => 'makephoto/index',
    '^makephoto/savePhoto$' => 'makephoto/savePhoto',

    '^restore(.*)$' => 'user/restore',
    '^confirm(.*)$' => 'user/confirm',

    '^gallery$' => 'gallery/index',
    '^gallery/addLike$' => 'gallery/addLike',
    '^gallery/removeLike$' => 'gallery/removeLike',
    '^gallery/addComment$' => 'gallery/addComment'
    
);