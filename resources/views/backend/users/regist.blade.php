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
                {!! Form::open(array('route' => ['backend.users.regist'], 'class' => 'form-horizontal', 'method' => 'post', 'enctype'=>'multipart/form-data', 'accept-charset'=>'utf-8')) !!}
                  <table class="table table-bordered mar-bottom15">
                    <tr>
                      <td class="col-title col-md-3"><label for="">ユーザー名<span class="required">必須</span></label></td>
                      <td class="col-md-9">
                        <div class="col-md-6">
                          <input type="text" class="form-control" id="u_name" name="u_name" value="{{old('u_name')}}"> 
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
                          <input type="text" class="form-control" id="u_login" name="u_login" value="{{old('u_login')}}"> 
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
                          <input type="password" class="form-control" id="u_passwd" name="u_passwd" value=""> 
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
                          {!! divisions('u_belong' ,(!empty(old('u_belong')) ? old('u_belong') : 1)) !!}

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
                          <input name="u_power01" value="1" id="u_power0" type="checkbox" @if(old('u_power01') == 1) checked @endif > データの抽出と表示
                        </div>
                        <div>
                          <input name="u_power02" value="1" id="u_power02" type="checkbox" @if(old('u_power02') == 1) checked @endif > 「タイムカード」の管理
                        </div>
                        <div>
                          <input name="u_power03" value="1" id="u_power03" type="checkbox" @if(old('u_power03') == 1) checked @endif > 「入退出」の管理
                        </div>
                        <div>
                          <input name="u_power04" value="1" id="u_power04" type="checkbox" @if(old('u_power04') == 1) checked @endif > 「PCログ」の管理
                        </div>
                        <div>
                          <input name="u_power05" value="1" id="u_power05" type="checkbox" @if(old('u_power05') == 1) checked @endif > 部課マスタの管理
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
                      <input value="登録する" type="submit" name="btn_submit" class="btn btn-primary btn-sm">
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