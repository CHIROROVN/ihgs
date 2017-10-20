@extends('backend.layouts.app')
@section('content')
<!-- breadcrumbs -->
<div class="w3l_agileits_breadcrumbs">
    <div class="w3l_agileits_breadcrumbs_inner">
        <ul><li>部課ごと残業集計</li></ul>
    </div>
</div>
<!-- //breadcrumbs -->
<div class="inner_content_w3_agile_info two_in">
    <div class="graph-form agile_info_shadow">
        <div class="form-body">
        {!! Form::open(array('url' => 'overwork','id'=>'frmSearch', 'method' => 'post')) !!} 
        <table id="table">
            <thead>
            <tr>
                <th>部課名</th>
                <th>年度</th>
                <th></th>
            </tr>
            </thead>
        <tbody>
        <tr>
            <td>{!! divisions('staff_belong', $staff_belong,true) !!}                
            </td>
            <td>
                <div class="fl-left">
                    <select name="cb_year" id="cb_year" class="form-control form-control-date">
                        <option value="">All</option>
                        <?php $last=2020; $now=2017; ?>
                        @for ($i = $now; $i <= $last; $i++)
                            <option value="{{ $i }}" @if($i==$cb_year) selected="" @endif>{{ $i }} 年度</option>
                        @endfor
                    </select>
                </div>
            </td>
            <td><input name="btnSubmit" value="抽出する" id="btnSubmit" type="button" class="btn btn-primary btn-sm"></td>
            </tr>
        </table>
        {!! Form::close() !!}  
   </div>
</div>
<!-- tables -->
<div class="agile-tables">
    <div class="w3l-table-info agile_info_shadow">
        <div class="row mar-bottom15"></div>
            <table id="table" class="mar-bottom15">
                <thead>
                  <tr>
                    <th>氏名</th>
                    <th>2017年<br />4月</th>
                    <th>2017年<br />5月</th>
                    <th>2017年<br />6月</th>
                    <th>2017年<br />7月</th>
                    <th>2017年<br />8月</th>
                    <th>2017年<br />9月</th>
                    <th>2017年<br />10月</th>
                    <th>2017年<br />11月</th>
                    <th>2017年<br />12月</th>
                    <th>2018年<br />1月</th>
                    <th>2018年<br />2月</th>
                    <th>2018年<br />3月</th>
                    <th>合計</th>
                    <th>基準超</th>
                  </tr>
                </thead>
                <tbody>
                @if(empty($worktimes['data']) || count($worktimes['data']) < 1)
                <tr>
                <td colspan="15">
                  <h3 align="center">該当するデータがありません。</h3>
                </td>
              </tr>
                @else  
                @foreach($worktimes['data'] as $worktime)  
                  <tr>
                    <td><a href="{{ asset('overtime/detail/'.$worktime->staff_id.'?year='.$cb_year) }}">{{$worktime->staff_name}}</a></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="bg-red"></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td></td>
                    <td></td>
                  </tr>
                @endforeach
                @endif      
                </tbody>
              </table>
              <div class="row">
                <div class="col-md-12 text-center">
                  <input name="submit" value="PDFで出力する" type="submit" class="btn btn-primary btn-sm">
                </div>
              </div>
            </div>
          </div>
        </div>
 </div>
</div>
<script type="text/javascript">
$("#btnSubmit").on("click",function() {
   
  $( "#frmSearch" ).submit(); 
});
</script>   
@endsection