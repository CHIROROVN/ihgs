@extends('backend.layouts.app')

@section('content')

<!-- CONTENTS -->
<!-- breadcrumbs -->
          <div class="w3l_agileits_breadcrumbs">
            <div class="w3l_agileits_breadcrumbs_inner">
              <ul>
                <li>データ管理<span>＞</span></li>
                <li>登録済みユーザーの一覧</li>
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
          
          <p class="intro">**件が登録されています。</p>
          <!-- tables -->
          <div class="agile-tables">
            <div class="w3l-table-info agile_info_shadow">
              <div class="row mar-bottom15">
                <div class="col-md-12 text-right">
                  <input onclick="location.href='{{route('backend.users.regist')}}'" value="ユーザーの新規登録" type="button" class="btn btn-primary btn-xs">
                </div>
              </div>
              <table id="table" class="mar-bottom15">
                <thead>
                  <tr>
                    <th>削除</th>
                    <th>社員名</th>
                    <th>所属部署</th>
                    <th>ログインID</th>
                    <th>編集</th>
                  </tr>
                </thead>
                <tbody>

                @if(count($users) > 0)
                @foreach($users as $user)
                  <tr>
                    <td align="center" style="width: 120px;">
                      <input name="btnDelete" id="btnDelete" value="削除" type="button" class="btn btn-primary btn-xs" onclick="btnDelete('{{$user->u_id}}');">
                    </td>
                    <td>{{$user->u_name}}</td>
                    <td>@if(!empty($user->u_belong)) {{division($user->u_belong)}} @else 全社 @endif</td>
                    <td>{{$user->u_login}}</td>
                    <td align="center" style="width: 120px;">
                      <input name="btn_detail" id="btn_detail" value="編集" type="button" class="btn btn-primary btn-xs" onClick="location.href='{{route('backend.users.detail', $user->u_id)}}'">
                    </td>
                  </tr>
                  @endforeach
                  @endif

                </tbody>
              </table>

<!-- start: Delete Coupon Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"
                    aria-hidden="true">&times;</button>
                <h3 class="modal-title" id="myModalLabel">確認を削除!</h3>
            </div>
            <div class="modal-body">
                <h4>本当に削除してもいいですか。</h4>
            </div>
            <!--/modal-body-collapse -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="btnDelteYes" href="#">削除</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">キャンセル</button>
            </div>
            <!--/modal-footer-collapse -->
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

              <div class="row">
                <div class="col-md-12 text-center">

                  {{ $users->links() }}

                  <!-- <input name="submit2" disabled="" value="前の20件を表示" type="submit" class="btn btn-primary btn-sm">
                  <input name="submit3" id="submit3" value="次の20件を表示" type="submit" class="btn btn-primary btn-sm mar-left15"> -->
                </div>
              </div>
            </div>
          </div>
        </div>
<!-- /CONTENTS -->
<!-- /.modal -->
<script type="text/javascript">
  $('#btnDelete').on('click', function (e) {    
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
    location.href="{{ asset('users/delete/') }}"+"/"+ id ;  
});
</script> 
@endsection