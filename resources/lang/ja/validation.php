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
    //Login
    'error_u_login_required'              => 'このフィールドに記入してください。',
    'error_u_passwd_required'             => 'このフィールドに記入してください。',

    //Users
    'error_u_name_required'               => 'ユーザー名を入力してください。',
    'error_u_login_required'              => 'ログインIDを入力してください。',
    'error_u_passwd_required'             => 'パスワードを入力してください。',

    //Category
    'error_category_name_required'        => 'カテゴリ名を入力してください。',

    //Infos
    'error_info_title_required'           => 'タイトルを入力してください',
    'error_info_year_required'            => '情報登録日を選択してください。',
    'error_info_month_required'           => '情報登録日を選択してください。',
    'error_info_day_required'             => '情報登録日を選択してください。',
    'error_info_type_required'            => 'タイプ を選択してください。',
    'error_product_name_required'         => '商品名を入力してください。',
    'error_info_list_img_mime'            => 'イメージは .jpeg, .jpg, .png, .bmp, .gif のタイプのファイルでなければなりません。',
    'error_info_list_img_max'             => '画像サイズは10メガバイト未満でなければなりません。',
    'error_info1_url_required'            => 'リンク先URLを入力してください。',
    'error_info2_file_required'           => 'ファイルを選択してください。',
    'error_info2_file_mime'               => 'ファイルは  .doc, .docx, .pdf, .txt, .xls, .xlsx のタイプのファイルでなければなりません。',
    'error_info2_file_max'                => 'ファイルサイズは10メガバイト未満でなければなりません。',
    'error_info3_img_mime'                => 'イメージは .jpeg, .jpg, .png, .bmp, .gif のタイプのファイルでなければなりません。',
    'error_info3_img_max'                 => '画像サイズは10メガバイト未満でなければなりません。',
    'error_info3_file_mime'               => 'ファイルは .doc, .docx, .pdf, .txt, .xls, .xlsx のタイプのファイルでなければなりません。',
    'error_info3_file_max'                => 'ファイルサイズは10メガバイト未満でなければなりません。',
    'error_info3_contents_required'       => '詳細を入力してください。',

    //Event
    'error_event_title_required'          => 'タイトルを入力してください。',
    'error_event_year_start_required'     => '開始日時を選択してください。',
    'error_event_month_start_required'    => '開始日時を選択してください。',
    'error_event_day_start_required'      => '開始日時を選択してください。',
    'error_event_hour_start_required'     => '開始日時を選択してください。',
    'error_event_minute_start_required'   => '開始日時を選択してください。',

    //Product
    'error_product_name_required'         => '商品名を入力してください。',
    'error_cat_required'                  => '所属カテゴリを入力してください。',
    'error_product_list_img_mime'         => 'イメージは .jpeg, .jpg, .png, .bmp, .gif のタイプのファイルでなければなりません。',
    'error_product_list_img_max'          => '画像サイズは10メガバイト未満でなければなりません。',
    'error_product_detail_img_mime'       => 'イメージは .jpeg, .jpg, .png, .bmp, .gif のタイプのファイルでなければなりません。',
    'error_product_detail_img_max'        => '画像サイズは10メガバイト未満でなければなりません。',
    'error_product1_img_mime'             => 'イメージは .jpeg, .jpg, .png, .bmp, .gif のタイプのファイルでなければなりません。',
    'error_product1_img_max'              => '画像サイズは10メガバイト未満でなければなりません。',
    'error_product2_img_mime'             => 'イメージは .jpeg, .jpg, .png, .bmp, .gif のタイプのファイルでなければなりません。',
    'error_product2_img_max'              => '画像サイズは10メガバイト未満でなければなりません。',
    'error_product3_img_mime'             => 'イメージは .jpeg, .jpg, .png, .bmp, .gif のタイプのファイルでなければなりません。',
    'error_product3_img_max'              => '画像サイズは10メガバイト未満でなければなりません。',
    'error_product4_img_mime'             => 'イメージは .jpeg, .jpg, .png, .bmp, .gif のタイプのファイルでなければなりません。',
    'error_product4_img_max'              => '画像サイズは10メガバイト未満でなければなりません。',
    'error_product5_img_mime'             => 'イメージは .jpeg, .jpg, .png, .bmp, .gif のタイプのファイルでなければなりません。',
    'error_product5_img_max'              => '画像サイズは10メガバイト未満でなければなりません。',
    'error_product6_img_mime'             => 'イメージは .jpeg, .jpg, .png, .bmp, .gif のタイプのファイルでなければなりません。',
    'error_product6_img_max'              => '画像サイズは10メガバイト未満でなければなりません。',
    'error_product7_img_mime'             => 'イメージは .jpeg, .jpg, .png, .bmp, .gif のタイプのファイルでなければなりません。',
    'error_product7_img_max'              => '画像サイズは10メガバイト未満でなければなりません。',
    'error_product8_img_mime'             => 'イメージは .jpeg, .jpg, .png, .bmp, .gif のタイプのファイルでなければなりません。',
    'error_product8_img_max'              => '画像サイズは10メガバイト未満でなければなりません。',

    'error_product1_price_numeric'        => '価格はタイプ数値でなければなりません。',
    'error_product2_price_numeric'        => '価格はタイプ数値でなければなりません。',
    'error_product3_price_numeric'        => '価格はタイプ数値でなければなりません。',
    'error_product4_price_numeric'        => '価格はタイプ数値でなければなりません。',
    'error_product5_price_numeric'        => '価格はタイプ数値でなければなりません。',
    'error_product6_price_numeric'        => '価格はタイプ数値でなければなりません。',
    'error_product7_price_numeric'        => '価格はタイプ数値でなければなりません。',
    'error_product8_price_numeric'        => '価格はタイプ数値でなければなりません。',

    //Inquiry
    'error_inquiry_type_required'               => 'お問い合わせ種別を選択してください',
    'error_inquiry_store_required'              => 'お問い合わせ店舗を選択してください。',
    'error_inquiry_content_required'            => 'お問い合わせ内容を入力してください。',
    'error_inquiry_first_name_required'         => '姓をご入力ください。',
    'error_inquiry_last_name_required'          => '名をご入力ください。',
    'error_inquiry_first_name_kana_required'    => 'せい(ふりがな)をご入力ください。',
    'error_inquiry_first_name_kana_regex'       => 'ふりがなをご入力ください。',
    'error_inquiry_last_name_kana_required'     => 'めい(ふりがな)をご入力ください。',
    'error_inquiry_last_name_kana_regex'        => 'ふりがなをご入力ください。',
    'error_inquiry_post1_numeric'               => '郵便番号は数値型でなければなりません。',
    'error_inquiry_post2_numeric'               => '郵便番号は数値型でなければなりません。',
    'error_inquiry_tel1_numeric'                => '電話番号は数値型でなければなりません。',
    'error_inquiry_tel2_numeric'                => '電話番号は数値型でなければなりません。',
    'error_inquiry_tel3_numeric'                => '電話番号は数値型でなければなりません。',
    'error_inquiry_mail_address_required'       => 'メールアドレスをご入力ください。',
    'error_inquiry_mail_address_email'          => '正しいメール形式を入力してください。',
    'error_inquiry_privacy_required'            => '同意するにチェックを入れてください。',


];
