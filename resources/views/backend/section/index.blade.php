@extends('backend.layouts.app')
@section('content')
  <!-- breadcrumbs -->
  <div class="w3l_agileits_breadcrumbs">
    <div class="w3l_agileits_breadcrumbs_inner">
      <ul>
        <li>データ管理<span>＞</span></li>
        <li>部課の管理<span>＞</span></li>
        <li>登録済み課の一覧</li>
      </ul>
    </div>
  </div>
        <!-- //breadcrumbs -->
        <div class="inner_content_w3_agile_info two_in">
          <p class="intro">登録されている課の名称を一覧表示しています。</p>
          @if ($message = Session::get('success'))
          <div class="alert alert-success  alert-dismissible fade in" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <ul class="no-margin-bottom"><strong><li>  {{ $message }}</li></strong></ul>
          </div>
        @elseif($message = Session::get('danger'))
          <div class="alert alert-danger alert-dismissible fade in" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <ul class="no-margin-bottom"><strong><li>  {{ $message }}</li></strong></ul>
          </div>
        @endif
          <div class="graph-form agile_info_shadow">
            <div class="form-body">              
                <table class="table table-bordered">
                  <tr>
                    <td class="col-title col-md-3"><label for="">表示している部の名称</label></td>
                    <td class="col-md-9"><span style="line-height: 35px;">{{ $parent->belong_name }}</span><input onclick="location.href='{{route('backend.division.index')}}'" value="部の再選択" type="button" class="btn btn-primary btn-xs mar-left15"></td>
                  </tr>
                 </table>                
              </div>
           </div>
          <!-- tables -->
          <div class="agile-tables">
            <div class="w3l-table-info agile_info_shadow">
              <div class="row mar-bottom15">
                <div class="col-md-12 text-right">
                  <input onclick="location.href='{{ asset('section/' . $parent->belong_id.'/regist') }}'" value="課の新規登録" type="button" class="btn btn-primary btn-xs">
                </div>
              </div>
              <table id="table" class="mar-bottom15">
                <thead>
                  <tr>
                    <th>削除</th>
                    <th>課のコード</th>
                    <th>課の名称</th>
                    <th>編集</th>
                    <th colspan="4">表示順序</th>
                  </tr>
                </thead>                
                <tbody> 
                <?php 
                  $i = 0;
                  $max = count($belongs);
                ?>
                @if(empty($belongs) || count($belongs) < 1)
                <tr>
                  <td colspan="8">
                    <h3 align="center">該当するデータがありません。</h3>
                  </td>
                </tr>
                @else        
                  @foreach($belongs as $belong)
                    <?php $i++; ?>           
                  <tr>
                    <td align="center"><input name="button2" id="button2" value="削除" type="button" class="btn btn-primary btn-xs"></td>
                    <td>{{ $belong->belong_code }}</td>
                    <td>{{ $belong->belong_name }}</td>
                    <td align="center"><input onclick="location.href='{{ asset('division/' . $belong->belong_parent_id.'/edit/'.$belong->belong_id) }}'" value="編集" type="button" class="btn btn-primary btn-xs"></td>
                    <td><input name="btnTop" id="btnTop" value="TOP" type="button" class="btn btn-primary btn-xs"></td>
                    <td><input name="btnUp" id="btnUp" value="↑" type="button" class="btn btn-primary btn-xs"></td>
                    <td><input name="btnDown" id="btnDown" value="↓" type="button" class="btn btn-primary btn-xs"></td>
                    <td><input name="btnLast" id="btnLast" value="LAST" type="button" class="btn btn-primary btn-xs"></td>
                  </tr>
                 @endforeach
                 @endif 
                </tbody>
              </table>
              <div class="row">
                <div class="col-md-12 text-center">
                  <input onclick="location.href='{{route('backend.division.index')}}'" value="登録済み部の一覧に戻る" type="button" class="btn btn-primary btn-sm">
                </div>
              </div>
            </div>
          </div>  

@endsection