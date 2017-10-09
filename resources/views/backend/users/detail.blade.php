@extends('backend.layouts.app')

@section('content')

<!-- CONTENTS -->
<!-- breadcrumbs -->
          <div class="w3l_agileits_breadcrumbs">
            <div class="w3l_agileits_breadcrumbs_inner">
              <ul>
                <li>データ管理<span>＞</span></li>
                <li>ユーザーの新規登録</li>
              </ul>
            </div>
          </div>
        <!-- //breadcrumbs -->
        <div class="inner_content_w3_agile_info two_in">
          <div class="forms-main_agileits">
            <header class="panel-heading">
              ユーザーの詳細
            </header>
            <div class="graph-form agile_info_shadow">
              <div class="form-body">                
                  <table class="table table-bordered mar-bottom15">
                    <tr>
                      <td class="col-title col-md-3"><label for="">ユーザー名</label></td>
                      <td class="col-md-9">
                        <div class="col-md-6">
                          {{$user->u_name}}
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td class="col-title col-md-3"><label for="">ログインID</label></td>
                      <td class="col-md-9">
                        <div class="col-md-6">
                          {{$user->u_login}}
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td class="col-title col-md-3"><label for="">パスワード</label></td>
                      <td class="col-md-9">
                        <div class="col-md-6">
                          ******                            
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td class="col-title col-md-3"><label for="">所属</label></td>
                      <td class="col-md-9">
                        <div class="col-md-6">
                          {{$user->belong_name}}
                        </div>
                        <!-- <div class="fl-left mar-left15 line-height30">※ここで指定した部課の配下の社員の勤怠データを表示することができます</div> -->
                      </td>
                    </tr>
                    <tr>
                      <td class="col-title col-md-3"><label for="">権限</label></td>
                      <td class="col-md-9">
                        <div>
	                        @if(!empty($user->u_power01) && $user->u_power01 == 1)
	                        データの抽出と表示
	                        @endif 
	                    </div>

	                    <div>
	                        @if(!empty($user->u_power02) && $user->u_power02 == 1)
	                        「タイムカード」の管理
	                        @endif 
	                    </div>

	                    <div>
	                        @if(!empty($user->u_power03) && $user->u_power03 == 1)
	                        「入退出」の管理
	                        @endif 
	                    </div>
                        
                        <div>
	                        @if(!empty($user->u_power04) && $user->u_power04 == 1)
	                        「PCログ」の管理
	                        @endif 
	                    </div> 

	                    <div>
	                        @if(!empty($user->u_power05) && $user->u_power05 == 1)
	                        部課マスタの管理
	                        @endif 
	                    </div>

	                    <div>
	                        @if(!empty($user->u_power06) && $user->u_power06 == 1)
	                        社員マスタの管理
	                        @endif 
	                    </div> 

	                    <div>
	                        @if(!empty($user->u_power07) && $user->u_power07 == 1)
	                        ユーザー管理
	                        @endif 
	                    </div>                       

                      </td>
                    </tr>
                  </table>
                  <div class="row">
                    <div class="col-md-12 text-center">
                       <input type="button" id="btn-edit" onClick="location.href='{{route('backend.users.edit', $u_id)}}'" value="編集する">
		  				<input type="button" id="btn-back" onClick="if (confirm('これを削除してもよろしいですか？')) {location.href='{{ route('backend.users.delete', $user->u_id) }}' }" value="削除する">
                    </div>
                  </div>
                 
                </div>
              </div>
            </div>
          </div>
        </div>
<!-- /CONTENTS -->

@endsection