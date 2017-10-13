@extends('backend.layouts.app')
@section('content')
<!-- breadcrumbs -->
          <div class="w3l_agileits_breadcrumbs">
            <div class="w3l_agileits_breadcrumbs_inner">
              <ul>
                <li>部課ごと残業集計</li>

              </ul>
            </div>
          </div>
        <!-- //breadcrumbs -->
        <div class="inner_content_w3_agile_info two_in">
          <div class="graph-form agile_info_shadow">
            <div class="form-body">
              {!! Form::open(array('url' => 'overwork','id'=>'frm', 'method' => 'post')) !!} 
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
                    <td>
                      <select name="select" id="select" class="form-control">
                        @if(!empty($divisions))
                              @foreach($divisions as $division)
                                  @if(!empty($division->belong_parent_id))
                                    @if($division->belong_id == $division->belong_parent_id)
                                      <option value="{{$division->belong_id}}" @if(old('u_belong') == $division->belong_id) selected @endif > - {{$division->belong_name}} </option>
                                    @else
                                    <option value="{{$division->belong_id}}" @if(old('u_belong') == $division->belong_id) selected @endif > &#12288;|- {{$division->belong_name}} </option>
                                    @endif

                                  @else
                                    <option value="{{$division->belong_id}}" @if(old('u_belong') == $division->belong_id) selected @endif > {{$division->belong_name}} </option>
                                  @endif

                              @endforeach
                            @endif
                      </select>
                    </td>
                    <td>
                      <div class="fl-left">
                        <select name="select2" class="form-control form-control-date">
                          <option>----年度</option>
                        </select>
                        </div>
                     </td>
                     <td>
                        <input name="button" value="抽出する" type="button" class="btn btn-primary btn-sm">
                      </td>
                  </tr>
                 </table>
                 {!! Form::close() !!}  
              </div>
           </div>
          <!-- tables -->
          <div class="agile-tables">
            <div class="w3l-table-info agile_info_shadow">
              <div class="row mar-bottom15">
              </div>
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
                  <tr>
                    <td><a href="statics_overtime_detail.html">山田太郎</a></td>
                    <td>0h</td>
                    <td>30h</td>
                    <td>25h</td>
                    <td>40h</td>
                    <td class="bg-red">60h</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>155h</td>
                    <td>1回</td>
                  </tr>
                  <tr>
                    <td><a href="statics_overtime_detail.html">山田太郎</a></td>
                    <td>0h</td>
                    <td>30h</td>
                    <td>25h</td>
                    <td>40h</td>
                    <td class="bg-red">60h</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>155h</td>
                    <td>1回</td>
                  </tr>
                  <tr>
                    <td><a href="statics_overtime_detail.html">山田太郎</a></td>
                    <td>0h</td>
                    <td>30h</td>
                    <td>25h</td>
                    <td>40h</td>
                    <td class="bg-red">60h</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>155h</td>
                    <td>1回</td>
                  </tr>
                  <tr>
                    <td><a href="statics_overtime_detail.html">山田太郎</a></td>
                    <td>0h</td>
                    <td>30h</td>
                    <td>25h</td>
                    <td>40h</td>
                    <td class="bg-red">60h</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>155h</td>
                    <td>1回</td>
                  </tr>
                  <tr>
                    <td><a href="statics_overtime_detail.html">山田太郎</a></td>
                    <td>0h</td>
                    <td>30h</td>
                    <td>25h</td>
                    <td>40h</td>
                    <td class="bg-red">60h</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>155h</td>
                    <td>1回</td>
                  </tr>
                  <tr>
                    <td><a href="statics_overtime_detail.html">山田太郎</a></td>
                    <td>0h</td>
                    <td>30h</td>
                    <td>25h</td>
                    <td>40h</td>
                    <td class="bg-red">60h</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>155h</td>
                    <td>1回</td>
                  </tr>
                  <tr>
                    <td><a href="statics_overtime_detail.html">山田太郎</a></td>
                    <td>0h</td>
                    <td>30h</td>
                    <td>25h</td>
                    <td>40h</td>
                    <td class="bg-red">60h</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>155h</td>
                    <td>1回</td>
                  </tr>
                  <tr>
                    <td><a href="statics_overtime_detail.html">山田太郎</a></td>
                    <td>0h</td>
                    <td>30h</td>
                    <td>25h</td>
                    <td>40h</td>
                    <td class="bg-red">60h</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>155h</td>
                    <td>1回</td>
                  </tr>
                  <tr>
                    <td><a href="statics_overtime_detail.html">山田太郎</a></td>
                    <td>0h</td>
                    <td>30h</td>
                    <td>25h</td>
                    <td>40h</td>
                    <td class="bg-red">60h</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>155h</td>
                    <td>1回</td>
                  </tr>
                  <tr>
                    <td><a href="statics_overtime_detail.html">山田太郎</a></td>
                    <td>0h</td>
                    <td>30h</td>
                    <td>25h</td>
                    <td>40h</td>
                    <td class="bg-red">60h</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>155h</td>
                    <td>1回</td>
                  </tr>
                  <tr>
                    <td><a href="statics_overtime_detail.html">山田太郎</a></td>
                    <td>0h</td>
                    <td>30h</td>
                    <td>25h</td>
                    <td>40h</td>
                    <td class="bg-red">60h</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>155h</td>
                    <td>1回</td>
                  </tr>
                  <tr>
                    <td><a href="statics_overtime_detail.html">山田太郎</a></td>
                    <td>0h</td>
                    <td>30h</td>
                    <td>25h</td>
                    <td>40h</td>
                    <td class="bg-red">60h</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>155h</td>
                    <td>1回</td>
                  </tr>
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
@endsection