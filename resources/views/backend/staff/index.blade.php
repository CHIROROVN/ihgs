@extends('backend.layouts.app')
@section('content') 
<!-- breadcrumbs -->
<div class="w3l_agileits_breadcrumbs">
  <div class="w3l_agileits_breadcrumbs_inner">
    <ul>
      <li>データ管理<span>＞</span></li>
      <li>登録済み社員データの検索結果一覧</li>
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
        <a id="close" title="Message"  href="javascript::void(0);" onClick="document.getElementById('success').setAttribute('style','display: none;');">&times;</a>
        <span>{{$message}}</span>
      </div>
    @endif  
  </div>
  <p class="intro">検索の結果、**件が該当しました。うち、1～20件を表示しています。</p>
          <!-- tables -->
          <div class="agile-tables">
            <div class="w3l-table-info agile_info_shadow">
              <div class="row mar-bottom15">
                <div class="col-md-12 text-right">
                  <input onclick="location.href='{{route('backend.staff.regist')}}'" value="社員データの新規登録" type="button" class="btn btn-primary btn-xs">
                </div>
              </div>
              <table id="table" class="mar-bottom15">
                <thead>
                  <tr>
                    <th>削除</th>
                    <th>社員番号</th>
                    <th>社員名</th>
                    <th>所属部署</th>
                    <th>入退出カード番号</th>
                    <th>PC番号</th>
                    <th>編集</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  $i = 0;
                  $max = count($staffs);
                ?>
                @if(empty($staffs) || count($staffs) < 1)
                <tr>
                <td colspan="7">
                  <h3 align="center">該当するデータがありません。</h3>
                </td>
              </tr>
                @else 
                 @foreach($staffs as $staff)
                    <?php $i++; ?>
                  <tr>
                    <td align="center"><input name="btnDelete" id="btnDelete" value="削除"  type="button"  class="btn btn-primary btn-xs" onclick="if (confirm('Are you sure delete')) {location.href='{{ asset('staff/delete/' . $staff->staff_id) }}' }"></td>
                    <td>{{ $staff->staff_id_no }}</td>
                    <td>{{ $staff->staff_name }}</td>
                    <td>{{ $staff->staff_belong }}</td>
                    <td>{{ $staff->staff_card1 }}</td>
                    <td>{{ $staff->staff_pc1 }}</td>
                    <td align="center"><input name="button" value="編集" type="button" class="btn btn-primary btn-xs" onclick="location.href='{{ asset('staff/edit/' . $staff->staff_id) }}'"></td>
                  </tr>
                  @endforeach
                  @endif   
                </tbody>
              </table>
              <div class="row mar-bottom15">
                <div class="col-md-12 text-center">
                  <input name="submit2" disabled="" value="前の20件を表示" type="submit" class="btn btn-primary btn-sm">
                  <input name="submit3" value="次の20件を表示" type="submit" class="btn btn-primary btn-sm mar-left15">
                </div>
              </div>
              <div class="row">
                <div class="col-md-12 text-center">
                  <input onclick="location.href='{{ asset('staff/search' ) }}'" value="条件を変えて再検索" type="button" class="btn btn-primary btn-sm">
                </div>
              </div>
            </div>
          </div>
      
        
@endsection