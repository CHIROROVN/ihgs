@extends('backend.layouts.app')
@section('content')
<!-- breadcrumbs -->
<div class="w3l_agileits_breadcrumbs">
  <div class="w3l_agileits_breadcrumbs_inner">
    <ul>
      <li>データ管理<span>＞</span></li>
      <li>登録済み社員データの検索</li>
    </ul>
  </div>
</div>
<!-- //breadcrumbs -->
{!! Form::open(array('url' => 'staff','id'=>'frmSearch', 'method' => 'post')) !!}
  <div class="inner_content_w3_agile_info two_in">
  <!--/forms-->
    <div class="forms-main_agileits">
      <p class="intro">条件を指定し、「検索開始」をクリックしてください。</p>
        <header class="panel-heading">登録済み社員データの検索</header>
        <div class="graph-form agile_info_shadow">
          <div class="form-body">
            <table class="table table-bordered mar-bottom15">
            <tr>
              <td class="col-title col-md-3"><label for="">部署名</label></td>
              <td class="col-md-9">
                <div class="col-md-6">
                  {!! divisions('staff_belong', '') !!}                  
                </div>
              </td>
            </tr>
            <tr>
              <td class="col-title col-md-3"><label for="">氏名</label></td>
              <td class="col-md-9">
                <div class="col-md-6">
                  <input type="text" class="form-control" id="txtstaff_name" name="txtstaff_name">
                </div>
                <div class="fl-left mar-left15 line-height30">を含む</div>
              </td>
            </tr>
            <tr>
              <td class="col-title col-md-3"><label for="">社員番号</label></td>
              <td class="col-md-9">
              <div class="col-md-6">
                <input type="text" class="form-control" id="txtstaff_id_no" name="txtstaff_id_no">
              </div>
              <div class="fl-left mar-left15 line-height30">を含む</div>
              </td>
            </tr>
          </table>
          <div class="row mar-bottom15">
            <div class="col-md-12 text-center">
              <input name="btnSubmit" id="btnSubmit" value="検索開始" type="button" class="btn btn-primary btn-sm">
              <input name="button3" value="クリア" type="reset" class="btn btn-primary btn-sm mar-left15">
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
{!! Form::close() !!}       
<script type="text/javascript">
$("#btnSubmit").on("click",function() {
   
  $( "#frmSearch" ).submit(); 
});
</script>       
@endsection