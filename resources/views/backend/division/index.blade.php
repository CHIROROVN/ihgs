
@extends('backend.layouts.app')
@section('content')
<!-- breadcrumbs -->
<div class="w3l_agileits_breadcrumbs">
  <div class="w3l_agileits_breadcrumbs_inner">
    <ul>
      <li>データ管理<span>＞</span></li>
      <li>部課の管理<span>＞</span></li>
      <li>登録済み部の一覧</li>
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
    <p class="intro">登録されている部の名称を一覧表示しています。</p>
      <!-- tables -->          
    <div class="agile-tables">
            <div class="w3l-table-info agile_info_shadow">
              <div class="row mar-bottom15">
                <div class="col-md-12 text-right">
                  <input onclick="location.href='{{route('backend.division.regist')}}'" value="部の新規登録" type="button" class="btn btn-primary btn-xs">
                </div>
              </div>
              <table id="table" class="table-bordered">
                <thead>
                  <tr>
                    <th>削除</th>
                    <th>部のコード</th>
                    <th>部の名称</th>
                    <th>配下の課一覧</th>
                    <th>配下の課の編集</th>
                    <th>編集</th>
                    <th colspan="4" align="center" style="text-align: center;">表示順序</th>
                  </tr>
                </thead>
                <?php 
                  $i = 0;
                  $max = count($belongs);
                ?>
                @if(empty($belongs) || count($belongs) < 1)
                <tr>
                <td colspan="7">
                  <h3 align="center">該当するデータがありません。</h3>
                </td>
              </tr>
                @else                    
                <tbody>
                  @foreach($belongs as $belong)
                    <?php $i++; ?>
                      <tr data-id='{{$belong->belong_id}}'>
                        <td align="center"><input name="btnDelete" id="btnDelete" value="削除" type="button" class="btn btn-primary btn-xs" onclick="btnDelete('{{$belong->belong_id}}');"></td>
                        <td>{{ $belong->belong_code }}</td>
                        <td>{{ $belong->belong_name }}</td>
                        <td>@foreach($sections as $section)
                               @if($section->belong_parent_id==$belong->belong_id)
                               {{ $section->belong_name }} <br />
                               @endif 
                           
                            @endforeach</td>
                        <td align="center"><input onclick="location.href='{{ asset('section/' . $belong->belong_id) }}'" value="配下の課の編集" type="button" class="btn btn-primary btn-xs"></td>
                        <td align="center"><input onclick="location.href='{{ asset('division/edit/' . $belong->belong_id) }}'" value="編集" type="button" class="btn btn-primary btn-xs"></td>
                        <td style="width: 50px;"><input name="btnTop" id="btnTop" value="TOP" type="button" class="btn btn-primary btn-xs @if($i < 2) {{'hidden'}} @endif" onclick="location.href='{{ asset('division/orderby-top?id=' . $belong->belong_id) }}'" ></td>
                        <td style="width: 50px;"><input name="btnUp" id="btnUp" value="↑" type="button" class="btn btn-primary btn-xs @if($i < 2) {{'hidden'}} @endif" onclick="location.href='{{ asset('division/orderby-up?id=' . $belong->belong_id) }}'"></td>
                        <td style="width: 50px;"><input name="btnDown" id="btnDown" value="↓" type="button" class="btn btn-primary btn-xs @if($i == $max) {{'hidden'}} @endif" onclick="location.href='{{ asset('division/orderby-down?id=' . $belong->belong_id) }}'" ></td>
                        <td style="width: 50px;"><input name="btnLast" value="Last" type="button" class="btn btn-primary btn-xs @if($i == $max) {{'hidden'}} @endif" onclick="location.href='{{ asset('division/orderby-last?id=' . $belong->belong_id) }}'"></td>
                      </tr>
                  @endforeach
                   </tbody>
                @endif                  
                </tbody>
              </table>
            </div>
          </div></div>
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
    location.href='{{ asset('division/delete/') }}'+'/'+ id ;    
});
</script>    

@endsection