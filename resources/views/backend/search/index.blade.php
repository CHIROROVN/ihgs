
@extends('backend.layouts.app')
@section('content')

        <!-- breadcrumbs -->
          <div class="w3l_agileits_breadcrumbs">
            <div class="w3l_agileits_breadcrumbs_inner">
              <ul>
                <li>個人ごと月次集計</li>

              </ul>
            </div>
          </div>
        <!-- //breadcrumbs -->
        <div class="inner_content_w3_agile_info two_in">
          <div class="graph-form agile_info_shadow">
            <div class="form-body">
                <table id="table">
                  <thead>
                    <tr>
                      <th>部課名</th>
                      <th>日付</th>
                      <th>社員番号/社員名</th>
                      <th></th>
                    </tr>
                  </thead>
                {!! Form::open( ['id' => 'f_search', 'method' => 'get', 'route' => 'backend.search.index', 'enctype'=>'multipart/form-data', 'accept-charset'=>'utf-8']) !!}
                  <tbody>
                  <tr>
                    <td>
                      {!! divisions('belong_id', $belong_selected, true) !!}
                    </td>
                    <td>
                      <div class="fl-left">
                        <select name="year_from" class="form-control form-control-date">
                          @for($yf=($curr_year-5); $yf<=($curr_year); $yf++)
                          <option value="{{$yf}}" @if(isset($year_from) && $year_from == $yf) selected @endif>{{$yf}}年</option>
                          @endfor
                        </select>
                          <select name="month_from" class="form-control form-control-date">
                            @for($mf=1; $mf<=12; $mf++)
                            <option value="{{c2digit($mf)}}" @if(isset($month_from) && $month_from == c2digit($mf)) selected @endif>{{c2digit($mf)}}年</option>
                            @endfor
                          </select>
                          
                          <div class="fl-left mar-left15 line-height30 mar-right15">～</div>
                        </div>
                        <div class="fl-left">
                          <select name="year_to" class="form-control form-control-date">
                            @for($yt=($curr_year-5); $yt<=($curr_year); $yt++)
                            <option value="{{$yt}}" @if(isset($year_to) && $year_to == $yt) selected @endif>{{$yt}}年</option>
                          @endfor
                          </select>
                          <select name="month_to" class="form-control form-control-date">
                            @for($mt=1; $mt<=12; $mt++)
                            <option value="{{c2digit($mt)}}" @if(isset($month_to) && $month_to == c2digit($mt)) selected @endif>{{c2digit($mt)}}年</option>
                            @endfor
                          </select>
                          
                        </div>
                     </td>
                     <td>
                      <input name="kw" type="text" class="form-control" size="20" value="{{@$kw}}">
                     </td>
                     <td>
                        <input value="抽出する" type="submit" class="btn btn-primary btn-sm">
                      </td>
                  </tr>
                </tbody>
                 </table>
                
              </div>
           </div>
          <!-- tables -->
          @if(count($staffs) > 0)
          <div class="agile-tables">
            <div class="w3l-table-info agile_info_shadow">
              @foreach($staffs as $staff)
              <div class="row mar-bottom15">
                <div class="col-md-12 text-left">
                  {!! (!empty($staff->staff_belong)) ? division($staff->staff_belong) : '全社' !!}／{{$staff->staff_id_no}}／{{$staff->staff_name}}
                </div>
              </div>

              <table id="table" class="mar-bottom15">
                <thead>
                  <tr>
                    <th rowspan="2">年月日</th>
                    <th colspan="2">本人申告</th>
                    <th colspan="2">入退出</th>
                    <th colspan="2">パソコン(テレワーク)</th>
                    <th colspan="2"  rowspan="2">分析</th>
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
                 @if(count(search_work_time($staff->staff_id_no, $conditions)) > 0)
                   @foreach(search_work_time($staff->staff_id_no, $conditions) as $wt)
                   <?php $date = format_date($wt->tt_date, '-');?>
                    <tr>
                      <td>{{DayeJp($wt->tt_date)}}</td>
                      <td>{{formatshortTime($wt->tt_gotime, ':')}}</td>
                      <td>{{formatshortTime($wt->tt_backtime, ':')}}</td>
                      <td>{{@hour_minute(touchtime($staff, $date)[0]->door_in)}}</td>
                      <td>{{@hour_minute(touchtime($staff, $date)[0]->door_out)}}</td>
                      <td>{{@hour_minute(actiontime($staff, $date)[0]->action_in)}}</td>
                      <td>{{@hour_minute(actiontime($staff, $date)[0]->action_out)}}</td>
                      <?php 
                        $time_start = compare_min(touchtime($staff, $date)[0]->door_in, actiontime($staff, $date)[0]->action_in); 
                        $time_end = compare_max(touchtime($staff, $date)[0]->door_out, actiontime($staff, $date)[0]->action_out);

                        $over_in = over_in(time2second($wt->tt_gotime), time2second(date('H:i:s',strtotime($time_start))));
                        $over_out = over_out(time2second($wt->tt_backtime), time2second(date('H:i:s',strtotime($time_end))));
                        ?>
                      <td {{@style_overtime($over_in, $over_out)}}>{{ @time_over($over_in, $over_out) }}</td>
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

              @endforeach

            </div>
          </div>
          @elseif(count($staffs) <= 0 && (isset($belong_id) || isset($kw)) )

          <div class="agile-tables">
            <div class="agile_info_shadow" style="text-align: center;">
              <strong style="color: #777;">該当するデータがありません。</strong>
            </div>
          </div>
          @endif
        </div>

@endsection