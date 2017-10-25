@extends('backend.layouts.app')
@section('content')
<!-- breadcrumbs -->
    <div class="w3l_agileits_breadcrumbs">
      <div class="w3l_agileits_breadcrumbs_inner">
        <ul>
          <li>データ管理<span>＞</span></li>
          <li>「PCログ」の管理<span>＞</span></li>
          <li>データの取り込み</li>
        </ul>
      </div>
    </div>
  <!-- //breadcrumbs -->
  <div class="inner_content_w3_agile_info two_in">

    <div class="flash-messages">
      @if($message = Session::get('danger'))

          <div id="error" class="message">
              <a id="close" title="Message"  href="#" onClick="document.getElementById('error').setAttribute('style','display: none;');">&times;</a>
              <span>{{$message}}</span>
          </div>

      @elseif($message = Session::get('success'))

          <div id="success" class="message">
              <a id="close" title="Message"  href="javascript:void(0);" onClick="document.getElementById('success').setAttribute('style','display: none;');">&times;</a>
              <span>{{$message}}</span>
          </div>

      @endif  
    </div>

    <p class="intro">「PCログ」のデータを取り込みます。ファイルを指定し、「取り込み開始」をクリックしてください。<br />
      ※過去のデータを削除する場合は、一覧表内の「削除」ボタンをクリックしてください。<br />
      ※ユニークキーがないため、データは重複されて取り込まれます。データ変更（差し替え）の場合は、必ず、削除して登録してください。</p>
    <p class="note">
      ●取り込むデータの形式●<br />
      PC番号：00列目<br />
      アクション（ログイン or ログアウト）：00列目<br />
      日時：00列目
    </p>
    <div class="graph-form agile_info_shadow">
      <div class="form-body">
        {!! Form::open(array('route' => ['backend.pc.import'], 'class' => 'form-horizontal', 'method' => 'post', 'enctype'=>'multipart/form-data', 'accept-charset'=>'utf-8')) !!}
          <table class="table table-bordered">
            <tr>
              <td class="col-title col-md-3"><label for="">データ名称<span class="required">必須</span></label></td>
               <td class="col-md-9">
                <div class="col-md-6">
                  <input type="text" name="tp_dataname" class="form-control" id="tp_dataname" value="@if(old('tp_dataname')){{old('tp_dataname')}}@endif">
                  @if ($errors->has('tp_dataname'))
                      <span class="help-block">
                          <strong>{{ $errors->first('tp_dataname') }}</strong>
                      </span>
                  @endif
                </div>
              </td>
            </tr>
            <tr>
              <td class="col-title col-md-3"><label for="">取り込むデータ<span class="required">必須</span></label></td>
              <td class="col-md-9">
                <div class="bt-browser mar-left15">
                  <input type="file" name="tp_file_csv" class="filestyle" data-btnClass="btn-primary" data-text="ファイルを選ぶ" data-placeholder="csvファイルを選択">

                  @if ($errors->has('tp_file_csv'))
                      <span class="help-block">
                          <strong>{{ $errors->first('tp_file_csv') }}</strong>
                      </span>
                  @endif

                </div>
                <div class="fl-left">
                  <input name="btn_submit" value="取り込み開始" type="submit" class="btn btn-primary">
                </div>
              </td>
            </tr>
           </table>
          </form> 
        </div>
     </div>
    <!-- tables -->
    <div class="agile-tables">
      <div class="w3l-table-info agile_info_shadow">
        <table id="table">
          <thead>
            <tr>
              <th>削除</th>
              <th>データ名称</th>
              <th>取り込み日時</th>
            </tr>
          </thead>
          <tbody>
            @if(count($pcs) > 0)
            @foreach($pcs as $pc)
            <tr>
              <td align="center" style="width: 120px;">
                <input name="btn_delete" value="削除" type="button" class="btn btn-primary btn-xs" onClick="if (confirm('これを削除してもよろしいですか？')) {location.href='{{ route('backend.pc.import.delete', $pc->tp_dataname) }}' }">
              </td>
              <td>{{$pc->tp_dataname}}</td>
              <td>{{date_time($pc->last_date, '/')}}</td>
            </tr>
            @endforeach
            @else
            <tr><td colspan="3" style="text-align: center;">該当するデータがありません。</td></tr>
            @endif

          </tbody>
        </table>
      </div>
    </div>
  </div>

@endsection

@section('js')
<script src="{{ asset('') }}public/backend/js/bootstrap-filestyle.min.js"></script>
<script>
  $(":file").filestyle({htmlIcon : '<span class="glyphicon glyphicon-folder-open"></span>', btnClass: "btn-primary", text: " ファイルを選ぶ", placeholder: "csvファイルを選択"});
</script>
@endsection