<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    /*
    |--------------------------------------------------------------------------
    | Model User
    |--------------------------------------------------------------------------
    */
    //Login
    'error_u_login_required'              => 'このフィールドに記入してください。',
    'error_u_passwd_required'             => 'このフィールドに記入してください。',

    //Users
    'error_u_name_required'               => 'ユーザー名を入力してください。',
    'error_u_login_required'              => 'ログインIDを入力してください。',
    'error_u_passwd_required'             => 'パスワードを入力してください。',
    'error_u_belong_required'             => '所属を入力してください。',

     /*
    |--------------------------------------------------------------------------
    | Model Belong
    |--------------------------------------------------------------------------
    */
    'error_belong_name_required'           => '所属名を入力してください。',
    'error_belong_code_required'           => '所属コードを選択してください。',
    'error_section_name_required'          => '所属名を入力してください。',
    'error_section_code_required'          => '所属名を入力してください。',
    /* */
    'error_tt_dataname_required'           => '所属名を入力してください。',
    'error_file_path_required'             => 'Please choose file upload。',
    /* doorcard*/
    'error_door_format_required'           => '所属名を入力してください。',
    'error_td_dataname_required'           => '所属名を入力してください。',
    /* staff*/
    'error_staff_id_no_required'           => '所属名を入力してください。',
    'error_staff_name_required'           => '所属名を入力してください。',
];
