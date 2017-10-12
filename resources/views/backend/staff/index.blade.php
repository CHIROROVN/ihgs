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
  <p class="intro">検索の結果、{{$staffs['count']}}件が該当しました。うち、@if($staffs['count']==0) 0～0  @else  {{$staffs['start']}}～{{$staffs['end']}} @endif件を表示しています。</p>
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
                @if(empty($staffs['data']) || count($staffs['data']) < 1)
                <tr>
                <td colspan="7">
                  <h3 align="center">該当するデータがありません。</h3>
                </td>
              </tr>              
                @else 
                 @foreach($staffs['data'] as $staff)
                    <?php $i++; ?>
                  <tr data-id='{{$staff->staff_id}}'>
                    <td align="center"><input name="btnDelete" id="btnDelete" value="削除"  type="button"  class="btn btn-primary btn-xs" onclick="btnDelete('{{$staff->staff_id}}');"></td>
                    <td>{{ $staff->staff_id_no }}</td>
                    <td>{{ $staff->staff_name }}</td>
                    <td>{{ $staff->belong_name }}</td>
                    <td>@if(!empty($staff->staff_card1)) {{$staff->staff_card1}} @endif</td>
                    <td>{{ $staff->staff_pc1 }}</td>
                    <td align="center"><input name="button" value="編集" type="button" class="btn btn-primary btn-xs" onclick="location.href='{{ asset('staff/edit/' . $staff->staff_id) }}'"></td>
                  </tr>
                  @endforeach
                  @endif   
                </tbody>
              </table>
              <div class="row mar-bottom15">
                <div class="col-md-12 text-center">
                 {{ $staffs['data']->links() }}
                  <!--<input name="submit2" disabled="" value="前の20件を表示" type="submit" class="btn btn-primary btn-sm">
                  <input name="submit3" value="次の20件を表示" type="submit" class="btn btn-primary btn-sm mar-left15">-->
                </div>
              </div>
              <div class="row">
                <div class="col-md-12 text-center">
                  <input onclick="location.href='{{ asset('staff/search' ) }}'" value="条件を変えて再検索" type="button" class="btn btn-primary btn-sm">
                </div>
              </div>
            </div>
          </div>
  </div>        
<!-- start: Delete Coupon Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"
                    aria-hidden="true">&times;</button>
                <h3 class="modal-title" id="myModalLabel">Warning!</h3>
            </div>
            <div class="modal-body">
                <h4>Are you sure you want to DELETE?</h4>

            </div>
            <!--/modal-body-collapse -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="btnDelteYes" href="#">Yes</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
            </div>
            <!--/modal-footer-collapse -->
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<script type="text/javascript">
  $('#btnDelete').on('click', function (e) {
    e.preventDefault();
    var id = $(this).closest('tr').data('id');
    $('#myModal').data('id', id).modal('show');
});
function btnDelete($id)
 {
      var id = $id;
    $('#myModal').data('id', id).modal('show');
 }   
$('#btnDelteYes').click(function () {
    var id = $('#myModal').data('id');
    location.href='{{ asset('staff/delete/') }}'+'/'+ id ;    
});
</script>           
@endsection