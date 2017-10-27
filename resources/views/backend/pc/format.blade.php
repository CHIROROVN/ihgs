@extends('backend.layouts.app')
@section('content')
<!-- breadcrumbs -->
          <div class="w3l_agileits_breadcrumbs">
            <div class="w3l_agileits_breadcrumbs_inner">
              <ul>
                <li>データ管理<span>＞</span></li>
                <li>「PCログ」の管理<span>＞</span></li>
                <li>フォーマットの指定</li>
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
                        <a id="close" title="Message"  href="javascript:void(0);" onClick="document.getElementById('success').setAttribute('style','display: none;');">&times;</a>
                        <span>{{$message}}</span>
                    </div>

                @endif  
          </div>

          <p class="intro">取り込む「PCログ」のデータのフォーマットを指定します。</p>
          <!--/forms-->
          <div class="forms-main_agileits">
            <header class="panel-heading">
              フォーマットの指定
            </header>

            <div class="graph-form agile_info_shadow">
              <div class="form-body">
              {!! Form::open(array('route' => ['backend.pc.format'], 'class' => 'form-horizontal', 'method' => 'post', 'enctype'=>'multipart/form-data', 'accept-charset'=>'utf-8')) !!}
                <input type="hidden" name="mp_id" value="{{@$mpc->mp_id}}">
                  <table class="table table-bordered table-list-regist mar-bottom15">
                    <thead>
                      <tr>
                        <th>取り込む項目名</th>
                        <th>元データの列</th>
                        <th>元データの形式</th>
                      </tr>
                    </thead>                
                    <tr>
                      <td class="col-title col-md-3"><label for="">PC番号</label></td>
                      <td class="col-md-2">
                        <select name="mp_pc_no_row" id="mp_pc_no_row" class="form-control">
                          @for($i=1; $i<=40; $i++)
                            <option value="{{$i}}" @if(isset($mpc->mp_pc_no_row) && $mpc->mp_pc_no_row == $i) selected @endif>{{$i}}列目</option>
                          @endfor                          
                        </select>
                      </td>
                      <td class="col-md-6"></td>
                    </tr>
                    <tr>
                      <td class="col-title col-md-3"><label for="">社員番号</label></td>
                      <td class="col-md-2">
                        <select name="mp_pc_no_row" id="mp_pc_no_row" class="form-control">
                          @for($i=1; $i<=40; $i++)
                            <option value="{{$i}}" @if(isset($mpc->mp_pc_no_row) && $mpc->mp_pc_no_row == $i) selected @endif>{{$i}}列目</option>
                          @endfor                          
                        </select>
                      </td>
                      <td class="col-md-6"></td>
                    </tr>
                    <tr>
                      <td class="col-title col-md-3"><label for="">日付</label></td>
                      <td class="col-md-2">
                        <select name="mt_date_row" id="mt_date_row"  class="form-control">                          
                          @for($i=1; $i<=40; $i++)
                              <option value="{{$i}}" @if(isset($mpc->mp_pc_no_row) && $mpc->mp_pc_no_row == $i) selected @endif>{{$i}}列目</option>
                          @endfor
                        </select>
                      </td>
                      <td class="col-md-6">
                        <div class="col-md-6">
                          <select name="mt_date_format" id="mt_date_format" class="form-control">
                           @foreach($date_formats as $key=>$date_format)                           
                            <option value="{{ $key }}">{{ $date_format }}</option>
                          @endforeach
                            
                          </select>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td class="col-title col-md-3"><label for="">出社時刻</label></td>
                      <td class="col-md-2">
                        <select name="mt_gotime_row" id="mt_gotime_row"  class="form-control">                          
                          @for($i=1; $i<=40; $i++)
                              <option value="{{$i}}" @if(isset($mpc->mp_pc_no_row) && $mpc->mp_pc_no_row == $i) selected @endif>{{$i}}列目</option>
                          @endfor
                        </select>
                      </td>
                      <td class="col-md-6">
                        <div class="col-md-6">
                          <select name="mt_gotime_format" id="mt_gotime_format" class="form-control">
                            @foreach($time_formats as $key=>$date_format)                           
                            <option value="{{ $key }}">{{ $date_format }}</option>
                          @endforeach
                          </select>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td class="col-title col-md-3"><label for="">退社時刻</label></td>
                      <td class="col-md-2">
                        <select name="mt_backtime_row" id="mt_backtime_row"  class="form-control">                          
                         @for($i=1; $i<=40; $i++)
                              <option value="{{$i}}" @if(isset($mpc->mp_pc_no_row) && $mpc->mp_pc_no_row == $i) selected @endif>{{$i}}列目</option>
                          @endfor
                        </select>
                      </td>
                      <td class="col-md-6">
                        <div class="col-md-6">
                          <select name="mt_backtime_format" id="mt_backtime_format" class="form-control">
                            @foreach($time_formats as $key=>$date_format)                           
                            <option value="{{ $key }}">{{ $date_format }}</option>
                          @endforeach
                          </select>
                        </div>
                      </td>
                    </tr>   
                    <tr>
                      <td class="col-title col-md-3"><label for="">日時</label></td>
                      <td class="col-md-2">
                        <select name="mp_pc_no_row" id="mp_pc_no_row" class="form-control">
                          @for($i=1; $i<=40; $i++)
                            <option value="{{$i}}" @if(isset($mpc->mp_pc_no_row) && $mpc->mp_pc_no_row == $i) selected @endif>{{$i}}列目</option>
                          @endfor                          
                        </select>
                      </td>
                      <td class="col-md-6">
                        <div class="col-md-6">
                          <select name="mt_backtime_format" id="mt_backtime_format" class="form-control">
                            @foreach($date_formats as $key=>$date_format)                           
                            <option value="{{ $key }}">{{ $date_format }}</option>
                           @endforeach
                          </select>
                        </div>
                      </td>
                    </tr>                 
                  </table>
                  <div class="row">
                    <div class="col-md-12 text-center">
                      <input name="btn_submit" value="保存する" type="submit" class="btn btn-primary btn-sm">
                      <input name="reset" value="元に戻す" type="reset" class="btn btn-primary btn-sm mar-left15">
                    </div>
                  </div>
                  </form> 
                </div>
              </div>
            </div>
          </div>
@endsection