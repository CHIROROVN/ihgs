
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
                {!! Form::open(array('url' => 'division/regist', 'method' => 'post')) !!} 
                  <table class="table table-bordered mar-bottom15">
                    <tr>
                      <td class="col-title col-md-3"><label for="">社員番号</label></td>
                      <td class="col-md-9">
                        <div class="col-md-6">
                          <input type="text" class="form-control" id="">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td class="col-title col-md-3"><label for="">社員名</label></td>
                      <td class="col-md-9">
                        <div class="col-md-6">
                          <input type="text" class="form-control" id="">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td class="col-title col-md-3"><label for="">部署名</label></td>
                      <td class="col-md-9">
                        <div class="col-md-6">
                          <select name="select" class="form-control">
                            <option>営業部</option>
                            <option>├営業一課</option>
                            <option>├営業二課</option>
                            <option>└営業三課</option>
                            <option>総務人事部</option>
                            <option>├総務課</option>
                            <option>└人事課</option>
                          </select>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td class="col-title col-md-3"><label for="">入退出カード番号(1)</label></td>
                      <td class="col-md-9">
                        <div class="col-md-6">
                          <input type="text" class="form-control" id="">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td class="col-title col-md-3"><label for="">入退出カード番号(2)</label></td>
                      <td class="col-md-9">
                        <div class="col-md-6">
                          <input type="text" class="form-control" id="">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td class="col-title col-md-3"><label for="">入退出カード番号(3)</label></td>
                      <td class="col-md-9">
                        <div class="col-md-6">
                          <input type="text" class="form-control" id="">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td class="col-title col-md-3"><label for="">入退出カード番号(4)</label></td>
                      <td class="col-md-9">
                        <div class="col-md-6">
                          <input type="text" class="form-control" id="">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td class="col-title col-md-3"><label for="">入退出カード番号(5)</label></td>
                      <td class="col-md-9">
                        <div class="col-md-6">
                          <input type="text" class="form-control" id="">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td class="col-title col-md-3"><label for="">入退出カード番号(6)</label></td>
                      <td class="col-md-9">
                        <div class="col-md-6">
                          <input type="text" class="form-control" id="">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td class="col-title col-md-3"><label for="">入退出カード番号(7)</label></td>
                      <td class="col-md-9">
                        <div class="col-md-6">
                          <input type="text" class="form-control" id="">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td class="col-title col-md-3"><label for="">入退出カード番号(8)</label></td>
                      <td class="col-md-9">
                        <div class="col-md-6">
                          <input type="text" class="form-control" id="">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td class="col-title col-md-3"><label for="">入退出カード番号(9)</label></td>
                      <td class="col-md-9">
                        <div class="col-md-6">
                          <input type="text" class="form-control" id="">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td class="col-title col-md-3"><label for="">入退出カード番号(10)</label></td>
                      <td class="col-md-9">
                        <div class="col-md-6">
                          <input type="text" class="form-control" id="">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td class="col-title col-md-3"><label for="">PC番号(1)</label></td>
                      <td class="col-md-9">
                        <div class="col-md-6">
                          <input type="text" class="form-control" id="">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td class="col-title col-md-3"><label for="">PC番号(2)</label></td>
                      <td class="col-md-9">
                        <div class="col-md-6">
                          <input type="text" class="form-control" id="">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td class="col-title col-md-3"><label for="">PC番号(3)</label></td>
                      <td class="col-md-9">
                        <div class="col-md-6">
                          <input type="text" class="form-control" id="">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td class="col-title col-md-3"><label for="">PC番号(4)</label></td>
                      <td class="col-md-9">
                        <div class="col-md-6">
                          <input type="text" class="form-control" id="">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td class="col-title col-md-3"><label for="">PC番号(5)</label></td>
                      <td class="col-md-9">
                        <div class="col-md-6">
                          <input type="text" class="form-control" id="">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td class="col-title col-md-3"><label for="">PC番号(6)</label></td>
                      <td class="col-md-9">
                        <div class="col-md-6">
                          <input type="text" class="form-control" id="">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td class="col-title col-md-3"><label for="">PC番号(7)</label></td>
                      <td class="col-md-9">
                        <div class="col-md-6">
                          <input type="text" class="form-control" id="">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td class="col-title col-md-3"><label for="">PC番号(8)</label></td>
                      <td class="col-md-9">
                        <div class="col-md-6">
                          <input type="text" class="form-control" id="">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td class="col-title col-md-3"><label for="">PC番号(9)</label></td>
                      <td class="col-md-9">
                        <div class="col-md-6">
                          <input type="text" class="form-control" id="">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td class="col-title col-md-3"><label for="">PC番号(10)</label></td>
                      <td class="col-md-9">
                        <div class="col-md-6">
                          <input type="text" class="form-control" id="">
                        </div>
                      </td>
                    </tr>
                  </table>
                  <div class="row">
                    <div class="col-md-12 text-center">
                      <input onclick="location.href='staff_list.html'" value="登録する" type="button" class="btn btn-primary btn-sm">
                      <input name="button3" value="クリア" type="reset" class="btn btn-primary btn-sm mar-left15">
                    </div>
                  </div>
                  </form> 
                </div>
              </div>
              <!--form-->
            </div>
          </div>     

@endsection