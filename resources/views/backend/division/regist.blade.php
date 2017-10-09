@extends('backend.layouts.app')
@section('content')
<!-- breadcrumbs -->
  <div class="w3l_agileits_breadcrumbs">
    <div class="w3l_agileits_breadcrumbs_inner">
      <ul>
        <li>データ管理<span>＞</span></li>
        <li>部課の管理<span>＞</span></li>
        <li>部の新規登録</li>
      </ul>
    </div>
  </div>
  
  {!! Form::open(array('url' => 'division/regist', 'method' => 'post')) !!}
        <!-- //breadcrumbs -->
        <div class="inner_content_w3_agile_info two_in">
          <p class="intro">部を新規登録します。</p>
          <!--/forms-->
          <div class="forms-main_agileits">
            <header class="panel-heading">
              部の新規登録
            </header>
            <div class="graph-form agile_info_shadow">
              <div class="form-body">
                <form> 
                  <table class="table table-bordered mar-bottom15">
                    <tr>
                      <td class="col-title col-md-3"><label for="">部の名称<span class="f_caution">(*)</span></label></td>
                      <td class="col-md-9">
                        <div class="col-md-6">
                          <input type="text" class="form-control" id="belong_name" name="belong_name">
                          <span class="help-block">@if ($errors->first('belong_name')) ※{!! $errors->first('belong_name') !!} @endif</span>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td class="col-title col-md-3"><label for="">部のコード<span class="f_caution">(*)</span></label></td>
                      <td class="col-md-9">
                        <div class="col-md-6">
                          <input type="text" class="form-control" id="belong_code" name="belong_code">
                          <span class="help-block">@if ($errors->first('belong_code')) ※{!! $errors->first('belong_code') !!} @endif</span>
                        </div>
                      </td>
                    </tr>
                  </table>
                  <div class="row mar-bottom15">
                    <div class="col-md-12 text-center">
                      <input name="button" value="登録する" type="submit" class="btn btn-primary btn-sm">
                      <input name="button" value="クリア" type="reset" class="btn btn-primary btn-sm mar-left15">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12 text-center">
                      <input onclick="location.href='{{route('backend.division.index')}}'" value="登録済み部の一覧に戻る" type="button" class="btn btn-primary btn-sm">
                    </div>
                  </div>
                  </form> 
                </div>
              </div>
            </div>
          </div>  
  {!! Form::close() !!}     

@endsection