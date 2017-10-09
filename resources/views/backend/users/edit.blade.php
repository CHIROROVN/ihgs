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
              ユーザーの新規登録
            </header>
            <div class="graph-form agile_info_shadow">
              <div class="form-body">
                {!! Form::open(array('route' => ['backend.users.edit', $u_id], 'class' => 'form-horizontal', 'method' => 'post', 'enctype'=>'multipart/form-data', 'accept-charset'=>'utf-8')) !!}
                  <table class="table table-bordered mar-bottom15">
                    <tr>
                      <td class="col-title col-md-3"><label for="">ユーザー名<span class="required">必須</span></label></td>
                      <td class="col-md-9">
                        <div class="col-md-6">
                          <input type="text" class="form-control" id="u_name" name="u_name" value="@if(old('u_name')){{old('u_name')}}@else{{$user->u_name}}@endif"> 
	                        @if ($errors->has('u_name'))
	                            <span class="help-block">
	                                <strong>{{ $errors->first('u_name') }}</strong>
	                            </span>
	                        @endif
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td class="col-title col-md-3"><label for="">ログインID<span class="required">必須</span></label></td>
                      <td class="col-md-9">
                        <div class="col-md-6">
                          <input type="text" class="form-control" id="u_login" name="u_login" value="@if(old('u_login')){{old('u_login')}}@else{{$user->u_login}}@endif"> 
                            @if ($errors->has('u_login'))
	                            <span class="help-block">
	                                <strong>{{ $errors->first('u_login') }}</strong>
	                            </span>
	                        @endif
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td class="col-title col-md-3"><label for="">パスワード<span class="required">必須</span></label></td>
                      <td class="col-md-9">
                        <div class="col-md-6">
                          <input type="password" class="form-control" id="u_passwd" name="u_passwd" value="{{old('u_passwd')}}"> 
                            @if ($errors->has('u_passwd'))
	                            <span class="help-block">
	                                <strong>{{ $errors->first('u_passwd') }}</strong>
	                            </span>
	                        @endif
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td class="col-title col-md-3"><label for="">所属</label></td>
                      <td class="col-md-9">
                        <div class="fl-left">
                          <select name="u_belong" class="form-control">
                            <option selected="" @if(old('u_belong') == '') selected @elseif($user->u_belong == '') selected @endif >全社</option>
                            <option value="1" @if(old('u_belong') == '1') selected @elseif($user->u_belong == '1') selected @endif >├営業部</option>
                            <option value="2" @if(old('u_belong') == '2') selected @elseif($user->u_belong == '2') selected  @endif >│├営業一課</option>
                            <option value="3" @if(old('u_belong') == '3') selected @elseif($user->u_belong == '3') selected  @endif >│├営業二課</option>
                            <option value="4" @if(old('u_belong') == '4') selected @elseif($user->u_belong == '4') selected  @endif >│└営業三課</option>
                            <option value="5" @if(old('u_belong') == '5') selected @elseif($user->u_belong == '5') selected  @endif >└総務人事部</option>
                            <option value="6" @if(old('u_belong') == '6') selected @elseif($user->u_belong == '6') selected  @endif >&#12288;├総務課</option>
                            <option value="7" @if(old('u_belong') == '7') selected @elseif($user->u_belong == '7') selected  @endif >&#12288;└人事課</option>
                          </select>
                          @if ($errors->has('u_belong'))
	                            <span class="help-block">
	                                <strong>{{ $errors->first('u_belong') }}</strong>
	                            </span>
	                        @endif
                        </div>
                        <div class="fl-left mar-left15 line-height30">※ここで指定した部課の配下の社員の勤怠データを表示することができます</div>
                      </td>
                    </tr>
                    <tr>
                      <td class="col-title col-md-3"><label for="">権限</label></td>
                      <td class="col-md-9">
                        <div>
                          <input name="u_power01" value="1" id="u_power0" type="checkbox" @if(old('u_power01') == 1) checked @elseif($user->u_power01 == '1') checked @endif > データの抽出と表示
                        </div>
                        <div>
                          <input name="u_power02" value="1" id="u_power02" type="checkbox" @if(old('u_power02') == 1) checked @elseif($user->u_power02 == '1') checked @endif > 「タイムカード」の管理
                        </div>
                        <div>
                          <input name="u_power03" value="1" id="u_power03" type="checkbox" @if(old('u_power03') == 1) checked @elseif($user->u_power03 == '1') checked  @endif > 「入退出」の管理
                        </div>
                        <div>
                          <input name="u_power04" value="1" id="u_power04" type="checkbox" @if(old('u_power04') == 1) checked @elseif($user->u_power04 == '1') checked @endif > 「PCログ」の管理
                        </div>
                        <div>
                          <input name="u_power05" value="1" id="u_power05" type="checkbox" @if(old('u_power05') == 1) checked @elseif($user->u_power05 == '1') checked @endif > 部課マスタの管理
                        </div>
                        <div>
                          <input name="u_power06" value="1" id="u_power06" type="checkbox" @if(old('u_power06') == 1) checked @endif > 社員マスタの管理
                        </div>
                        <div>
                          <input name="u_power07" value="1" id="u_power7" type="checkbox" @if(old('u_power07') == 1) checked @endif > ユーザー管理
                        </div>
                      </td>
                    </tr>
                  </table>
                  <div class="row">
                    <div class="col-md-12 text-center">
                      <input value="変更する" type="submit" name="btn_submit" class="btn btn-primary btn-sm">
                      <input name="btn_reset" value="クリア" type="reset" class="btn btn-primary btn-sm mar-left15">
                    </div>
                  </div>
                  {!! Form::close() !!}
                </div>
              </div>
            </div>
          </div>
        </div>
<!-- /CONTENTS -->

@endsection