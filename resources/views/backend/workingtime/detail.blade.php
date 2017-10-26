@extends('backend.layouts.app')
@section('content')
<div class="w3l_agileits_breadcrumbs">
  <div class="w3l_agileits_breadcrumbs_inner">
    <ul><li>個人ごと残業集計</li></ul>
  </div>
</div>
<div class="inner_content_w3_agile_info two_in">         
 <div class="agile-tables">
    <div class="w3l-table-info agile_info_shadow">
      <div class="row mar-bottom15">
        <div class="col-md-12 text-left">{{$staff->belong_name}}／{{$staff->staff_id_no}}／{{$staff->staff_name}}</div>
      </div>
      <table id="table" class="mar-bottom15 table-bordered">
        <thead>
          <tr>
            <th rowspan="2">年月日</th>
            <th colspan="2">本人申告</th>
            <th colspan="2">入退出</th>
            <th colspan="2">パソコン(テレワーク)</th>
            <th rowspan="2">乖離</th>
            <th rowspan="2">残業</th>
          </tr>
          <tr>
            <th>出社</th>
            <th>退社</th>
            <th>最初</th>
            <th>最後</th>
            <th>ログイン</th>
            <th>ログアウト</th>
          </tr>
        </thead>
        <tbody>
        @if(empty($worktimes) || count($worktimes) < 1)
          <tr><td colspan="12"><h3 align="center">該当するデータがありません。</h3></td></tr>
        @else                   
          @foreach($worktimes as $key=>$worktime)                  
            <tr>
              <td>{{DayeJp($key, '/')}}</td>
              <td>@if(isset($worktime['gotime'])){{formatshortTime($worktime['gotime'])}} @else  データ無し @endif</td>
              <td>@if(isset($worktime['backtime'])){{formatshortTime($worktime['backtime'])}} @else  データ無し @endif</td>
              <td>@if(isset($worktime['touchtime_in'])){{formatshortTime($worktime['touchtime_in'])}} @else  データ無し @endif</td>
              <td>@if(isset($worktime['touchtime_out'])){{formatshortTime($worktime['touchtime_out'])}} @else  データ無し @endif</td>
              <td>@if(isset($worktime['pc_in'])){{formatshortTime($worktime['pc_in'])}} @else  データ無し @endif</td>
              <td>@if(isset($worktime['pc_out'])){{formatshortTime($worktime['pc_out'])}} @else  データ無し @endif</td>
              @if(isset($worktime['diff'])) 
                @if($worktime['diff']>29 && $worktime['diff'] <61) 
                  <td class="bg-yellow" style="text-align: center;">30 分超 </td>
                  @elseif($worktime['diff'] >60)                
                  <td class="bg-red" style="text-align: center;">1 時間超 </td>
                  @else  <td></td>
                @endif
              @endif                        
               <td style="text-align: center;">{{@get_work_overtime($worktime['gotime'],$worktime['backtime'],$key)}}</td>
            </tr>
          @endforeach
        @endif      
        </tbody>
        </table>
        <div class="row">
          <div class="col-md-12 text-center"><input name="submit" value="戻る" type="submit" class="btn btn-primary btn-sm" onClick="history.back()"></div>
        </div>
      </div>
  </div>
</div>        
@endsection