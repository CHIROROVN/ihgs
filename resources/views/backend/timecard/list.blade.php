@extends('backend.layouts.app')
@section('content')
<!-- breadcrumbs -->
          <div class="w3l_agileits_breadcrumbs">
            <div class="w3l_agileits_breadcrumbs_inner">
              <ul>
                <li>データ管理<span>＞</span></li>
                <li>「タイムカード」の管理<span>＞</span></li>
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
                <a id="close" title="Message"  href="javascript::void(0);" onClick="document.getElementById('success').setAttribute('style','display: none;');">&times;</a>
                  <span>{{$message}}</span>
              </div>
            @endif  
          </div>                 
          <div class="graph-form agile_info_shadow">           
          <!-- tables -->
          <div class="agile-tables">            
            <div class="w3l-table-info agile_info_shadow">
              <div class="row mar-bottom15">
                <div class="col-md-12 text-left">
                 <!--$timecards->belong_name／$staff->staff_id_no／$staff->staff_name-->
                </div>
              </div>
              <table id="table">
                <thead>
                  <tr>
                    <th>氏名</th>
                    <th>年月日</th>
                    <th>名</th>
                    <th>始業時刻</th>
                    <th>終業時刻</th>
                  </tr>
                </thead>
                <tbody>
                @if(empty($timecards) || count($timecards) < 1)
                <tr>
                <td colspan="3">
                  <h3 align="center">該当するデータがありません。</h3>
                </td>
              </tr>
                @else  
                @foreach($timecards as $timecard)
                  <tr data-id='{{$timecard->tt_dataname}}'>
                    <td align="center" style="width: 250px;">{{$timecard->staff_name}}</td>
                    <td align="center" style="width: 200px;">{{date_time($timecard->last_date)}}</td>
                    <td align="center">{{$timecard->tt_dataname}}</td>
                    <td align="center">{{$timecard->tt_gotime}}</td>
                    <td align="center">{{$timecard->tt_backtime}}</td>                    
                  </tr> 
                 @endforeach
                 @endif                      
                </tbody>
              </table>
              
            </div>
          </div>
          <div class="agile-tables">
            <div class="row mar-bottom15">
                <div class="col-md-12 text-left">
                 DoorCard
                </div>
              </div>
              <table id="table1">
                <thead>
                  <tr>
                    <th>入館証ID</th>
                    <th>ドア№</th>
                    <th>名</th>
                    <th>日付</th>
                    
                  </tr>
                </thead>
                <tbody>
                @if(empty($doorcards) || count($doorcards) < 1)
                <tr>
                <td colspan="3">
                  <h3 align="center">該当するデータがありません。</h3>
                </td>
              </tr>
                @else  
                @foreach($doorcards as $doorcard)
                  <tr data-id='{{$timecard->tt_dataname}}'>
                    <td align="center" style="width: 250px;">{{$doorcard->td_card}}</td>
                    <td align="center" style="width: 200px;">{{$doorcard->td_door}}</td>
                    <td align="center">{{$doorcard->td_dataname}}</td>                    
                    <td align="center">{{date_time($doorcard->td_touchtime)}}</td>                    
                  </tr> 
                 @endforeach
                 @endif                      
                </tbody>
              </table>
           </div> 
          <div class="agile-tables">
            <div class="row mar-bottom15">
                <div class="col-md-12 text-left">
                 <strong>PC</strong>
                </div>
              </div>
              <table id="table1">
                <thead>
                  <tr>
                    <th>PCID</th>
                    <th>入退</th>
                    <th>名</th>
                    <th>日付</th>
                    
                  </tr>
                </thead>
                <tbody>
                @if(empty($pcs) || count($pcs) < 1)
                <tr>
                <td colspan="3">
                  <h3 align="center">該当するデータがありません。</h3>
                </td>
              </tr>
                @else  
                @foreach($pcs as $pc)
                  <tr data-id='{{$timecard->tt_dataname}}'>
                    <td align="center" style="width: 250px;">{{$pc->tp_pc_no}}</td>
                    <td align="center" style="width: 200px;">{{$pc->tp_action}}</td>
                    <td align="center">{{$pc->tp_dataname}}</td>                    
                    <td align="center">{{date_time($pc->tp_actiontime)}}</td>                    
                  </tr> 
                 @endforeach
                 @endif                      
                </tbody>
              </table>
           </div> 
 </div> 
@endsection
