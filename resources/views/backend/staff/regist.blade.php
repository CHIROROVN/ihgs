
@extends('backend.layouts.app')
@section('content')
<!-- breadcrumbs -->
<div class="w3l_agileits_breadcrumbs">
  <div class="w3l_agileits_breadcrumbs_inner">
    <ul>
      <li>データ管理<span>＞</span></li>
      <li>社員データの新規登録</li>
    </ul>
  </div>
</div>
        <!-- //breadcrumbs -->
        <div class="inner_content_w3_agile_info two_in">
          <!--/forms-->
          <div class="forms-main_agileits">
            <header class="panel-heading">
              社員データの新規登録
            </header>
            <div class="graph-form agile_info_shadow">
            <!--form-->
              <div class="form-body">
                {!! Form::open(array('url' => 'division/regist','id'=>'frmRegist', 'method' => 'post')) !!} 
                  <table class="table table-bordered mar-bottom15">
                    <tr>
                      <td class="col-title col-md-3"><label for="">社員番号</label></td>
                      <td class="col-md-9">
                        <div class="col-md-6">
                          <input type="text" class="form-control" id="staff_id_no" name="staff_id_no">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td class="col-title col-md-3"><label for="">社員名</label></td>
                      <td class="col-md-9">
                        <div class="col-md-6">
                          <input type="text" class="form-control" id="staff_name" name="staff_name">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td class="col-title col-md-3"><label for="">部署名</label></td>
                      <td class="col-md-9">
                        <div class="col-md-6">
                          <select name="staff_belong" id="staff_belong" class="form-control">
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
                          @if ($errors->has('u_belong'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('u_belong') }}</strong>
                              </span>
                          @endif
                          </select>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td class="col-title col-md-3"><label for="">入退出カード番号(1)</label></td>
                      <td class="col-md-9">
                        <div class="col-md-6">
                          <input type="text" class="form-control" id="staff_card1" name="staff_card1">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td class="col-title col-md-3"><label for="">入退出カード番号(2)</label></td>
                      <td class="col-md-9">
                        <div class="col-md-6">
                          <input type="text" class="form-control" id="staff_card2" name="staff_card2">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td class="col-title col-md-3"><label for="">入退出カード番号(3)</label></td>
                      <td class="col-md-9">
                        <div class="col-md-6">
                          <input type="text" class="form-control" id="staff_card3" name="staff_card3">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td class="col-title col-md-3"><label for="">入退出カード番号(4)</label></td>
                      <td class="col-md-9">
                        <div class="col-md-6">
                          <input type="text" class="form-control" id="staff_card4" name="staff_card4">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td class="col-title col-md-3"><label for="">入退出カード番号(5)</label></td>
                      <td class="col-md-9">
                        <div class="col-md-6">
                          <input type="text" class="form-control" id="staff_card5" name="staff_card5">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td class="col-title col-md-3"><label for="">入退出カード番号(6)</label></td>
                      <td class="col-md-9">
                        <div class="col-md-6">
                          <input type="text" class="form-control" id="staff_card6" name="staff_card6">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td class="col-title col-md-3"><label for="">入退出カード番号(7)</label></td>
                      <td class="col-md-9">
                        <div class="col-md-6">
                          <input type="text" class="form-control" id="staff_card7" name="staff_card7">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td class="col-title col-md-3"><label for="">入退出カード番号(8)</label></td>
                      <td class="col-md-9">
                        <div class="col-md-6">
                          <input type="text" class="form-control" id="staff_card8" name="staff_card8">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td class="col-title col-md-3"><label for="">入退出カード番号(9)</label></td>
                      <td class="col-md-9">
                        <div class="col-md-6">
                          <input type="text" class="form-control" id="staff_card9" name="staff_card9">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td class="col-title col-md-3"><label for="">入退出カード番号(10)</label></td>
                      <td class="col-md-9">
                        <div class="col-md-6">
                          <input type="text" class="form-control" id="staff_card10" name="staff_card10">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td class="col-title col-md-3"><label for="">PC番号(1)</label></td>
                      <td class="col-md-9">
                        <div class="col-md-6">
                          <input type="text" class="form-control" id="staff_pc1" name="staff_pc1">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td class="col-title col-md-3"><label for="">PC番号(2)</label></td>
                      <td class="col-md-9">
                        <div class="col-md-6">
                          <input type="text" class="form-control" id="staff_pc2" name="staff_pc2">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td class="col-title col-md-3"><label for="">PC番号(3)</label></td>
                      <td class="col-md-9">
                        <div class="col-md-6">
                          <input type="text" class="form-control" id="staff_pc3" name="staff_pc3">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td class="col-title col-md-3"><label for="">PC番号(4)</label></td>
                      <td class="col-md-9">
                        <div class="col-md-6">
                          <input type="text" class="form-control" id="staff_pc4" name="staff_pc4">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td class="col-title col-md-3"><label for="">PC番号(5)</label></td>
                      <td class="col-md-9">
                        <div class="col-md-6">
                          <input type="text" class="form-control" id="staff_pc5" name="staff_pc5">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td class="col-title col-md-3"><label for="">PC番号(6)</label></td>
                      <td class="col-md-9">
                        <div class="col-md-6">
                          <input type="text" class="form-control" id="staff_pc6" name="staff_pc6">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td class="col-title col-md-3"><label for="">PC番号(7)</label></td>
                      <td class="col-md-9">
                        <div class="col-md-6">
                          <input type="text" class="form-control" id="staff_pc7" name="staff_pc7">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td class="col-title col-md-3"><label for="">PC番号(8)</label></td>
                      <td class="col-md-9">
                        <div class="col-md-6">
                          <input type="text" class="form-control" id="staff_pc8" name="staff_pc8">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td class="col-title col-md-3"><label for="">PC番号(9)</label></td>
                      <td class="col-md-9">
                        <div class="col-md-6">
                          <input type="text" class="form-control" id="staff_pc9" name="staff_pc9">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td class="col-title col-md-3"><label for="">PC番号(10)</label></td>
                      <td class="col-md-9">
                        <div class="col-md-6">
                          <input type="text" class="form-control" id="staff_pc10" name="staff_pc10">
                        </div>
                      </td>
                    </tr>
                  </table>
                  <div class="row">
                    <div class="col-md-12 text-center">
                      <input  value="登録する" type="button" name="btnSubmit" id="btnSubmit" class="btn btn-primary btn-sm">
                      <input name="button3" value="クリア" type="reset" class="btn btn-primary btn-sm mar-left15">
                    </div>
                  </div>
                  </form> 
                </div>
              </div>
              <!--form-->
            </div>
          </div>     
<script type="text/javascript">
$("#btnSubmit").on("click",function() {
   
  $( "#frmRegist" ).submit(); 
});
</script>
@endsection