@extends('backend.layouts.app')
@section('content')
<div class="w3l_agileits_breadcrumbs">
            <div class="w3l_agileits_breadcrumbs_inner">
              <ul>
                <li>個人ごと残業集計</li>

              </ul>
            </div>
          </div>
 <div class="inner_content_w3_agile_info two_in">         
 <div class="agile-tables">
            <div class="w3l-table-info agile_info_shadow">
              <div class="row mar-bottom15">
                <div class="col-md-12 text-left">
                 {{$staff->belong_name}}／{{$staff->staff_id_no}}／{{$staff->staff_name}}
                </div>
              </div>
              <table id="table" class="mar-bottom15">
                <thead>
                  <tr>
                    <th rowspan="2">年月日</th>
                    <th colspan="2">本人申告</th>
                    <th colspan="2">入退出</th>
                    <th colspan="2">パソコン(テレワーク)</th>
                    <th colspan="2"  rowspan="2">乖離</th>
                    <th colspan="2"  rowspan="2">残業</th>
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
                  <tr>
                    <td>2017/08/01(火)</td>
                    <td>9:00</td>
                    <td>18:00</td>
                    <td>8:45</td>
                    <td>18:15</td>
                    <td>8:55</td>
                    <td>18:03</td>
                    <td></td>
                    <td></td>
                  </tr>
                  
                </tbody>
              </table>
              <div class="row">
                <div class="col-md-12 text-center">                  
                  <input name="submit" value="戻る" type="submit" class="btn btn-primary btn-sm" onClick="history.back()">
                </div>
              </div>
            </div>
          </div>
</div>          
@endsection