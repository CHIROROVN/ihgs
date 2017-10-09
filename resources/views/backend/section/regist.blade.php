
@extends('backend.layouts.app')
@section('content')
<!-- breadcrumbs -->
  <div class="w3l_agileits_breadcrumbs">
    <div class="w3l_agileits_breadcrumbs_inner">
      <ul>
        <li>データ管理<span>＞</span></li>
        <li>部課の管理<span>＞</span></li>
        <li>課の新規登録</li>
      </ul>
    </div>
  </div>
<!-- //breadcrumbs -->
  <div class="inner_content_w3_agile_info two_in">
    <p class="intro">課を新規登録します。</p>
    <!--/forms-->
    <div class="forms-main_agileits">
      <header class="panel-heading">
        課の新規登録
      </header>
    <div class="graph-form agile_info_shadow">
      <div class="form-body">      
      {!! Form::open(array('url' => 'section/'. $parent->belong_id.'/regist', 'method' => 'post')) !!} 
        <table class="table table-bordered mar-bottom15">
          <tr>
            <td class="col-title col-md-3"><label for="">部の名称</label></td>
            <td class="col-md-9">{{ $parent->belong_name }}</td>
          </tr>
          <tr>
            <td class="col-title col-md-3"><label for="">課の名称<span class="f_caution">(*)</span></label></td>
              <td class="col-md-9">
                <div class="col-md-6">
                  <input type="text" class="form-control" id="belong_name" name="belong_name">
                  <span class="error-input">@if ($errors->first('belong_name')) ※{!! $errors->first('belong_name') !!} @endif</span>
                </div>
              </td>
          </tr>
          <tr>
              <td class="col-title col-md-3"><label for="">課のコード<span class="f_caution">(*)</span></label></td>
              <td class="col-md-9">
                <div class="col-md-6">
                  <input type="text" class="form-control" id="belong_code" name="belong_code">
                  <span class="error-input">@if ($errors->first('belong_code')) ※{!! $errors->first('belong_code') !!} @endif</span>
                </div>
              </td>
          </tr>
        </table>
        <div class="row mar-bottom15">
          <div class="col-md-12 text-center">
            <input name="button" value="登録する" type="submit" class="btn btn-primary btn-sm">
            <input name="btnReset" value="クリア" type="reset" class="btn btn-primary btn-sm mar-left15">
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 text-center">
            <input onclick="location.href='{{ asset('section/' . $parent->belong_id) }}'" value="登録済み課の一覧に戻る" type="button" class="btn btn-primary btn-sm">
          </div>
        </div>
        {!! Form::close() !!}           
      </div>
    </div>
  </div>
</div>  
@endsection