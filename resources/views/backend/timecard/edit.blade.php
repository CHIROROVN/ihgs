
@extends('backend.layouts.app')
@section('content')
<!-- breadcrumbs -->
        <!-- breadcrumbs -->
          <div class="w3l_agileits_breadcrumbs">
            <div class="w3l_agileits_breadcrumbs_inner">
              <ul>
                <li>データ管理<span>＞</span></li>
                <li>「タイムカード」の管理<span>＞</span></li>
                <li>フォーマットの指定</li>
              </ul>
            </div>
          </div>
        <!-- //breadcrumbs -->
        <div class="inner_content_w3_agile_info two_in">
          <p class="intro">取り込む「タイムカード」のデータのフォーマットを指定します。</p>
          <!--/forms-->
          <div class="forms-main_agileits">
            <header class="panel-heading">
              フォーマットの指定
            </header>
            <div class="graph-form agile_info_shadow">
              <div class="form-body">
                <form> 
                  <table class="table table-bordered table-list-regist mar-bottom15">
                    <thead>
                      <tr>
                        <th>取り込む項目名</th>
                        <th>元データの列</th>
                        <th>元データの形式</th>
                      </tr>
                    </thead>
                    <tr>
                      <td class="col-title col-md-3"><label for="">社員番号</label></td>
                      <td class="col-md-2">
                        <select name="select" id="select" class="form-control">
                          <option selected="">1列目</option>
                          <option>2列目</option>
                          <option>3列目</option>
                          <option>4列目</option>
                          <option>5列目</option>
                          <option>6列目</option>
                          <option>7列目</option>
                          <option>8列目</option>
                          <option>9列目</option>
                          <option>10列目</option>
                          <option>11列目</option>
                          <option>12列目</option>
                          <option>13列目</option>
                          <option>14列目</option>
                          <option>15列目</option>
                          <option>16列目</option>
                          <option>17列目</option>
                          <option>18列目</option>
                          <option>19列目</option>
                          <option>20列目</option>
                          <option>21列目</option>
                          <option>22列目</option>
                          <option>23列目</option>
                          <option>24列目</option>
                          <option>25列目</option>
                          <option>26列目</option>
                          <option>27列目</option>
                          <option>28列目</option>
                          <option>29列目</option>
                          <option>30列目</option>
                          <option>31列目</option>
                          <option>32列目</option>
                          <option>33列目</option>
                          <option>34列目</option>
                          <option>35列目</option>
                          <option>36列目</option>
                          <option>37列目</option>
                          <option>38列目</option>
                          <option>39列目</option>
                          <option>40列目</option>
                        </select>
                      </td>
                      <td class="col-md-6"></td>
                    </tr>
                    <tr>
                      <td class="col-title col-md-3"><label for="">日付</label></td>
                      <td class="col-md-2">
                        <select name="select" id="select"  class="form-control">
                          <option selected="">1列目</option>
                          <option>2列目</option>
                          <option>3列目</option>
                          <option>4列目</option>
                          <option>5列目</option>
                          <option>6列目</option>
                          <option>7列目</option>
                          <option>8列目</option>
                          <option>9列目</option>
                          <option>10列目</option>
                          <option>11列目</option>
                          <option>12列目</option>
                          <option>13列目</option>
                          <option>14列目</option>
                          <option>15列目</option>
                          <option>16列目</option>
                          <option>17列目</option>
                          <option>18列目</option>
                          <option>19列目</option>
                          <option>20列目</option>
                          <option>21列目</option>
                          <option>22列目</option>
                          <option>23列目</option>
                          <option>24列目</option>
                          <option>25列目</option>
                          <option>26列目</option>
                          <option>27列目</option>
                          <option>28列目</option>
                          <option>29列目</option>
                          <option>30列目</option>
                          <option>31列目</option>
                          <option>32列目</option>
                          <option>33列目</option>
                          <option>34列目</option>
                          <option>35列目</option>
                          <option>36列目</option>
                          <option>37列目</option>
                          <option>38列目</option>
                          <option>39列目</option>
                          <option>40列目</option>
                        </select>
                      </td>
                      <td class="col-md-6">
                        <div class="col-md-6">
                          <select name="select5" class="form-control">
                            <option selected="">YYYY年MM月DD日</option>
                            <option>YYYY/MM/DD</option>
                            <option>YYYYMMDD</option>
                          </select>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td class="col-title col-md-3"><label for="">出社時刻</label></td>
                      <td class="col-md-2">
                        <select name="select" id="select"  class="form-control">
                          <option selected="">1列目</option>
                          <option>2列目</option>
                          <option>3列目</option>
                          <option>4列目</option>
                          <option>5列目</option>
                          <option>6列目</option>
                          <option>7列目</option>
                          <option>8列目</option>
                          <option>9列目</option>
                          <option>10列目</option>
                          <option>11列目</option>
                          <option>12列目</option>
                          <option>13列目</option>
                          <option>14列目</option>
                          <option>15列目</option>
                          <option>16列目</option>
                          <option>17列目</option>
                          <option>18列目</option>
                          <option>19列目</option>
                          <option>20列目</option>
                          <option>21列目</option>
                          <option>22列目</option>
                          <option>23列目</option>
                          <option>24列目</option>
                          <option>25列目</option>
                          <option>26列目</option>
                          <option>27列目</option>
                          <option>28列目</option>
                          <option>29列目</option>
                          <option>30列目</option>
                          <option>31列目</option>
                          <option>32列目</option>
                          <option>33列目</option>
                          <option>34列目</option>
                          <option>35列目</option>
                          <option>36列目</option>
                          <option>37列目</option>
                          <option>38列目</option>
                          <option>39列目</option>
                          <option>40列目</option>
                        </select>
                      </td>
                      <td class="col-md-6">
                        <div class="col-md-6">
                          <select name="select6" class="form-control">
                            <option selected="">13:45:02</option>
                            <option>01:45:02 PM</option>
                            <option>13:45</option>
                            <option>1:45 PM</option>
                            <option>13時45分</option>
                          </select>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td class="col-title col-md-3"><label for="">退社時刻</label></td>
                      <td class="col-md-2">
                        <select name="select" id="select"  class="form-control">
                          <option selected="">1列目</option>
                          <option>2列目</option>
                          <option>3列目</option>
                          <option>4列目</option>
                          <option>5列目</option>
                          <option>6列目</option>
                          <option>7列目</option>
                          <option>8列目</option>
                          <option>9列目</option>
                          <option>10列目</option>
                          <option>11列目</option>
                          <option>12列目</option>
                          <option>13列目</option>
                          <option>14列目</option>
                          <option>15列目</option>
                          <option>16列目</option>
                          <option>17列目</option>
                          <option>18列目</option>
                          <option>19列目</option>
                          <option>20列目</option>
                          <option>21列目</option>
                          <option>22列目</option>
                          <option>23列目</option>
                          <option>24列目</option>
                          <option>25列目</option>
                          <option>26列目</option>
                          <option>27列目</option>
                          <option>28列目</option>
                          <option>29列目</option>
                          <option>30列目</option>
                          <option>31列目</option>
                          <option>32列目</option>
                          <option>33列目</option>
                          <option>34列目</option>
                          <option>35列目</option>
                          <option>36列目</option>
                          <option>37列目</option>
                          <option>38列目</option>
                          <option>39列目</option>
                          <option>40列目</option>
                        </select>
                      </td>
                      <td class="col-md-6">
                        <div class="col-md-6">
                          <select name="select6" class="form-control">
                            <option selected="">13:45:02</option>
                            <option>01:45:02 PM</option>
                            <option>13:45</option>
                            <option>1:45 PM</option>
                            <option>13時45分</option>
                          </select>
                        </div>
                      </td>
                    </tr>
                  </table>
                  <div class="row">
                    <div class="col-md-12 text-center">
                      <input name="button3" value="保存する" type="button" class="btn btn-primary btn-sm">
                      <input name="reset" value="元に戻す" type="reset" class="btn btn-primary btn-sm mar-left15">
                    </div>
                  </div>
                  </form> 
                </div>
              </div>
            </div>
          </div>
@endsection