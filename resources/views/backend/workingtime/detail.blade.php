@extends('backend.layouts.app')
@section('content')
<div class="w3l_agileits_breadcrumbs">
            <div class="w3l_agileits_breadcrumbs_inner">
              <ul>
                <li>個人ごと残業集計</li>

              </ul>
            </div>
          </div>
        <!-- //breadcrumbs -->
        <div class="inner_content_w3_agile_info two_in">
<!--          <div class="graph-form agile_info_shadow">
            <div class="form-body">
              <form> 
                <table id="table">
                  <thead>
                    <tr>
                      <th>部課名</th>
                      <th>日付</th>
                      <th>社員番号/社員名</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                  <tr>
                    <td>
                      <select name="select" id="select" class="form-control">
                        <option selected="">全社</option>
                        <option>├営業部</option>
                        <option>│├営業一課</option>
                        <option>│├営業二課</option>
                        <option>│└営業三課</option>
                        <option>└総務人事部</option>
                        <option>&#12288;├総務課</option>
                        <option>&#12288;└人事課</option>
                      </select>
                    </td>
                    <td>
                      <div class="fl-left">
                        <select name="select2" class="form-control form-control-date">
                          <option>----年</option>
                        </select>
                          <select name="select3" class="form-control form-control-date">
                            <option>--月</option>
                          </select>
                          
                          <div class="fl-left mar-left15 line-height30 mar-right15">～</div>
                        </div>
                        <div class="fl-left">
                          <select name="select5" class="form-control form-control-date">
                            <option>----年</option>
                          </select>
                          <select name="select6" class="form-control form-control-date">
                            <option>--月</option>
                          </select>
                          
                        </div>
                     </td>
                     <td>
                      <input name="textfield" type="text" class="form-control" size="20">
                     </td>
                     <td>
                        <input name="button" value="抽出する" type="button" class="btn btn-primary btn-sm">
                      </td>
                  </tr>
                 </table>
                </form> 
              </div>
           </div>-->
          <!-- tables -->
          <div class="agile-tables">
            <div class="w3l-table-info agile_info_shadow">
              <div class="row mar-bottom15">
                <div class="col-md-12 text-left">
                  営業部営業課／1234567890／山山田田太郎
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
                  <tr>
                    <td>2017/08/02(水)</td>
                    <td>9:00</td>
                    <td>18:00</td>
                    <td>8:45</td>
                    <td>18:15</td>
                    <td>8:55</td>
                    <td>18:03</td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td>2017/08/03(木)</td>
                    <td>9:00</td>
                    <td>18:00</td>
                    <td>8:45</td>
                    <td>18:15</td>
                    <td>8:55</td>
                    <td>18:03</td>
                    <td class="bg-yellow">30分超</td>
                    <td>1h</td>
                  </tr>
                  <tr>
                    <td>2017/08/04(金)</td>
                    <td>9:00</td>
                    <td>18:00</td>
                    <td>8:45</td>
                    <td>18:15</td>
                    <td>8:55</td>
                    <td>18:03</td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td>2017/08/05(土)</td>
                    <td>9:00</td>
                    <td>18:00</td>
                    <td>8:45</td>
                    <td>18:15</td>
                    <td>8:55</td>
                    <td>18:03</td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td>2017/08/06(日)</td>
                    <td>9:00</td>
                    <td>18:00</td>
                    <td>8:45</td>
                    <td>18:15</td>
                    <td>8:55</td>
                    <td>18:03</td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td>2017/08/07(月)</td>
                    <td>9:00</td>
                    <td>21:00</td>
                    <td>8:45</td>
                    <td>18:15</td>
                    <td>8:55</td>
                    <td>18:03</td>
                    <td class="bg-red">1時間超</td>
                    <td>3h</td>
                  </tr>
                  <tr>
                    <td>2017/08/08(火)</td>
                    <td>9:00</td>
                    <td>18:00</td>
                    <td>8:45</td>
                    <td>18:15</td>
                    <td>8:55</td>
                    <td>18:03</td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td>2017/08/09(水)</td>
                    <td>9:00</td>
                    <td>18:00</td>
                    <td>8:45</td>
                    <td>18:15</td>
                    <td>8:55</td>
                    <td>18:03</td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td>2017/08/10(木)</td>
                    <td>9:00</td>
                    <td>18:00</td>
                    <td>8:45</td>
                    <td>18:15</td>
                    <td>8:55</td>
                    <td>18:03</td>
                    <td class="bg-yellow">30分超</td>
                    <td></td>
                  </tr>
                  <tr>
                    <td>2017/08/11(金)</td>
                    <td>9:00</td>
                    <td>18:00</td>
                    <td>8:45</td>
                    <td>18:15</td>
                    <td>8:55</td>
                    <td>18:03</td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td>2017/08/12(土)</td>
                    <td>9:00</td>
                    <td>18:00</td>
                    <td>8:45</td>
                    <td>18:15</td>
                    <td>8:55</td>
                    <td>18:03</td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td>2017/08/13(日)</td>
                    <td>9:00</td>
                    <td>18:00</td>
                    <td>8:45</td>
                    <td>18:15</td>
                    <td>8:55</td>
                    <td>18:03</td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td>2017/08/14(月)</td>
                    <td>9:00</td>
                    <td>22:00</td>
                    <td>8:45</td>
                    <td>18:15</td>
                    <td>8:55</td>
                    <td>18:03</td>
                    <td class="bg-red">1時間超</td>
                    <td>4h</td>
                  </tr>
                  <tr>
                    <td>2017/08/15(火)</td>
                    <td>9:00</td>
                    <td>18:00</td>
                    <td>8:45</td>
                    <td>18:15</td>
                    <td>8:55</td>
                    <td>18:03</td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td>2017/08/16(水)</td>
                    <td>9:00</td>
                    <td>18:00</td>
                    <td>8:45</td>
                    <td>18:15</td>
                    <td>8:55</td>
                    <td>18:03</td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td>2017/08/17(木)</td>
                    <td>9:00</td>
                    <td>18:00</td>
                    <td>8:45</td>
                    <td>18:15</td>
                    <td>8:55</td>
                    <td>18:03</td>
                    <td class="bg-yellow">30分超</td>
                    <td></td>
                  </tr>
                  <tr>
                    <td>2017/08/18(金)</td>
                    <td>9:00</td>
                    <td>18:00</td>
                    <td>8:45</td>
                    <td>18:15</td>
                    <td>8:55</td>
                    <td>18:03</td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td>2017/08/19(土)</td>
                    <td>9:00</td>
                    <td>18:00</td>
                    <td>8:45</td>
                    <td>18:15</td>
                    <td>8:55</td>
                    <td>18:03</td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td>2017/08/20(日)</td>
                    <td>9:00</td>
                    <td>18:00</td>
                    <td>8:45</td>
                    <td>18:15</td>
                    <td>8:55</td>
                    <td>18:03</td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td>2017/08/21(月)</td>
                    <td>9:00</td>
                    <td>22:00</td>
                    <td>8:45</td>
                    <td>22:15</td>
                    <td>8:55</td>
                    <td>22:03</td>
                    <td class="bg-red">1時間超</td>
                    <td>4h</td>
                  </tr>
                  <tr>
                    <td>2017/08/22(火)</td>
                    <td>9:00</td>
                    <td>18:00</td>
                    <td>8:45</td>
                    <td>18:15</td>
                    <td>8:55</td>
                    <td>18:03</td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td>2017/08/23(水)</td>
                    <td>9:00</td>
                    <td>18:00</td>
                    <td>8:45</td>
                    <td>18:15</td>
                    <td>8:55</td>
                    <td>18:03</td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td>2017/08/24(木)</td>
                    <td>9:00</td>
                    <td>18:00</td>
                    <td>8:45</td>
                    <td>18:15</td>
                    <td>8:55</td>
                    <td>18:03</td>
                    <td class="bg-yellow">30分超</td>
                    <td></td>
                  </tr>
                  <tr>
                    <td>2017/08/25(金)</td>
                    <td>9:00</td>
                    <td>18:00</td>
                    <td>8:45</td>
                    <td>18:15</td>
                    <td>8:55</td>
                    <td>18:03</td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td>2017/08/26(土)</td>
                    <td>9:00</td>
                    <td>18:00</td>
                    <td>8:45</td>
                    <td>18:15</td>
                    <td>8:55</td>
                    <td>18:03</td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td>2017/08/27(日)</td>
                    <td>9:00</td>
                    <td>18:00</td>
                    <td>8:45</td>
                    <td>18:15</td>
                    <td>8:55</td>
                    <td>18:03</td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td>2017/08/28(月)</td>
                    <td>9:00</td>
                    <td>22:00</td>
                    <td>8:45</td>
                    <td>18:15</td>
                    <td>8:55</td>
                    <td>18:03</td>
                    <td class="bg-red">1時間超</td>
                    <td>4h</td>
                  </tr>
                  <tr>
                    <td>2017/08/29(火)</td>
                    <td>9:00</td>
                    <td>18:00</td>
                    <td>8:45</td>
                    <td>18:15</td>
                    <td>8:55</td>
                    <td>18:03</td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td>2017/08/30(水)</td>
                    <td>9:00</td>
                    <td>18:00</td>
                    <td>8:45</td>
                    <td>18:15</td>
                    <td>8:55</td>
                    <td>18:03</td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td>2017/08/31(木)</td>
                    <td>9:00</td>
                    <td>18:00</td>
                    <td>8:45</td>
                    <td>18:15</td>
                    <td>8:55</td>
                    <td>18:03</td>
                    <td class="bg-yellow">30分超</td>
                    <td></td>
                  </tr>
                </tbody>
              </table>
              <div class="row">
                <div class="col-md-12 text-center">
                  <!--<input name="submit" value="PDFで出力する" type="submit" class="btn btn-primary btn-sm">-->
                  <input name="submit" value="戻る" type="submit" class="btn btn-primary btn-sm" onClick="history.back()">
                </div>
              </div>
            </div>
          </div>
        </div>
@endsection<div class="w3l_agileits_breadcrumbs">
            <div class="w3l_agileits_breadcrumbs_inner">
              <ul>
                <li>個人ごと残業集計</li>

              </ul>
            </div>
          </div>
        <!-- //breadcrumbs -->
        <div class="inner_content_w3_agile_info two_in">
<!--          <div class="graph-form agile_info_shadow">
            <div class="form-body">
              <form> 
                <table id="table">
                  <thead>
                    <tr>
                      <th>部課名</th>
                      <th>日付</th>
                      <th>社員番号/社員名</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                  <tr>
                    <td>
                      <select name="select" id="select" class="form-control">
                        <option selected="">全社</option>
                        <option>├営業部</option>
                        <option>│├営業一課</option>
                        <option>│├営業二課</option>
                        <option>│└営業三課</option>
                        <option>└総務人事部</option>
                        <option>&#12288;├総務課</option>
                        <option>&#12288;└人事課</option>
                      </select>
                    </td>
                    <td>
                      <div class="fl-left">
                        <select name="select2" class="form-control form-control-date">
                          <option>----年</option>
                        </select>
                          <select name="select3" class="form-control form-control-date">
                            <option>--月</option>
                          </select>
                          
                          <div class="fl-left mar-left15 line-height30 mar-right15">～</div>
                        </div>
                        <div class="fl-left">
                          <select name="select5" class="form-control form-control-date">
                            <option>----年</option>
                          </select>
                          <select name="select6" class="form-control form-control-date">
                            <option>--月</option>
                          </select>
                          
                        </div>
                     </td>
                     <td>
                      <input name="textfield" type="text" class="form-control" size="20">
                     </td>
                     <td>
                        <input name="button" value="抽出する" type="button" class="btn btn-primary btn-sm">
                      </td>
                  </tr>
                 </table>
                </form> 
              </div>
           </div>-->
          <!-- tables -->
          <div class="agile-tables">
            <div class="w3l-table-info agile_info_shadow">
              <div class="row mar-bottom15">
                <div class="col-md-12 text-left">
                  営業部営業課／1234567890／山山田田太郎
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
                  <tr>
                    <td>2017/08/02(水)</td>
                    <td>9:00</td>
                    <td>18:00</td>
                    <td>8:45</td>
                    <td>18:15</td>
                    <td>8:55</td>
                    <td>18:03</td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td>2017/08/03(木)</td>
                    <td>9:00</td>
                    <td>18:00</td>
                    <td>8:45</td>
                    <td>18:15</td>
                    <td>8:55</td>
                    <td>18:03</td>
                    <td class="bg-yellow">30分超</td>
                    <td>1h</td>
                  </tr>
                  <tr>
                    <td>2017/08/04(金)</td>
                    <td>9:00</td>
                    <td>18:00</td>
                    <td>8:45</td>
                    <td>18:15</td>
                    <td>8:55</td>
                    <td>18:03</td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td>2017/08/05(土)</td>
                    <td>9:00</td>
                    <td>18:00</td>
                    <td>8:45</td>
                    <td>18:15</td>
                    <td>8:55</td>
                    <td>18:03</td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td>2017/08/06(日)</td>
                    <td>9:00</td>
                    <td>18:00</td>
                    <td>8:45</td>
                    <td>18:15</td>
                    <td>8:55</td>
                    <td>18:03</td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td>2017/08/07(月)</td>
                    <td>9:00</td>
                    <td>21:00</td>
                    <td>8:45</td>
                    <td>18:15</td>
                    <td>8:55</td>
                    <td>18:03</td>
                    <td class="bg-red">1時間超</td>
                    <td>3h</td>
                  </tr>
                  <tr>
                    <td>2017/08/08(火)</td>
                    <td>9:00</td>
                    <td>18:00</td>
                    <td>8:45</td>
                    <td>18:15</td>
                    <td>8:55</td>
                    <td>18:03</td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td>2017/08/09(水)</td>
                    <td>9:00</td>
                    <td>18:00</td>
                    <td>8:45</td>
                    <td>18:15</td>
                    <td>8:55</td>
                    <td>18:03</td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td>2017/08/10(木)</td>
                    <td>9:00</td>
                    <td>18:00</td>
                    <td>8:45</td>
                    <td>18:15</td>
                    <td>8:55</td>
                    <td>18:03</td>
                    <td class="bg-yellow">30分超</td>
                    <td></td>
                  </tr>
                  <tr>
                    <td>2017/08/11(金)</td>
                    <td>9:00</td>
                    <td>18:00</td>
                    <td>8:45</td>
                    <td>18:15</td>
                    <td>8:55</td>
                    <td>18:03</td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td>2017/08/12(土)</td>
                    <td>9:00</td>
                    <td>18:00</td>
                    <td>8:45</td>
                    <td>18:15</td>
                    <td>8:55</td>
                    <td>18:03</td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td>2017/08/13(日)</td>
                    <td>9:00</td>
                    <td>18:00</td>
                    <td>8:45</td>
                    <td>18:15</td>
                    <td>8:55</td>
                    <td>18:03</td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td>2017/08/14(月)</td>
                    <td>9:00</td>
                    <td>22:00</td>
                    <td>8:45</td>
                    <td>18:15</td>
                    <td>8:55</td>
                    <td>18:03</td>
                    <td class="bg-red">1時間超</td>
                    <td>4h</td>
                  </tr>
                  <tr>
                    <td>2017/08/15(火)</td>
                    <td>9:00</td>
                    <td>18:00</td>
                    <td>8:45</td>
                    <td>18:15</td>
                    <td>8:55</td>
                    <td>18:03</td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td>2017/08/16(水)</td>
                    <td>9:00</td>
                    <td>18:00</td>
                    <td>8:45</td>
                    <td>18:15</td>
                    <td>8:55</td>
                    <td>18:03</td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td>2017/08/17(木)</td>
                    <td>9:00</td>
                    <td>18:00</td>
                    <td>8:45</td>
                    <td>18:15</td>
                    <td>8:55</td>
                    <td>18:03</td>
                    <td class="bg-yellow">30分超</td>
                    <td></td>
                  </tr>
                  <tr>
                    <td>2017/08/18(金)</td>
                    <td>9:00</td>
                    <td>18:00</td>
                    <td>8:45</td>
                    <td>18:15</td>
                    <td>8:55</td>
                    <td>18:03</td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td>2017/08/19(土)</td>
                    <td>9:00</td>
                    <td>18:00</td>
                    <td>8:45</td>
                    <td>18:15</td>
                    <td>8:55</td>
                    <td>18:03</td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td>2017/08/20(日)</td>
                    <td>9:00</td>
                    <td>18:00</td>
                    <td>8:45</td>
                    <td>18:15</td>
                    <td>8:55</td>
                    <td>18:03</td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td>2017/08/21(月)</td>
                    <td>9:00</td>
                    <td>22:00</td>
                    <td>8:45</td>
                    <td>22:15</td>
                    <td>8:55</td>
                    <td>22:03</td>
                    <td class="bg-red">1時間超</td>
                    <td>4h</td>
                  </tr>
                  <tr>
                    <td>2017/08/22(火)</td>
                    <td>9:00</td>
                    <td>18:00</td>
                    <td>8:45</td>
                    <td>18:15</td>
                    <td>8:55</td>
                    <td>18:03</td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td>2017/08/23(水)</td>
                    <td>9:00</td>
                    <td>18:00</td>
                    <td>8:45</td>
                    <td>18:15</td>
                    <td>8:55</td>
                    <td>18:03</td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td>2017/08/24(木)</td>
                    <td>9:00</td>
                    <td>18:00</td>
                    <td>8:45</td>
                    <td>18:15</td>
                    <td>8:55</td>
                    <td>18:03</td>
                    <td class="bg-yellow">30分超</td>
                    <td></td>
                  </tr>
                  <tr>
                    <td>2017/08/25(金)</td>
                    <td>9:00</td>
                    <td>18:00</td>
                    <td>8:45</td>
                    <td>18:15</td>
                    <td>8:55</td>
                    <td>18:03</td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td>2017/08/26(土)</td>
                    <td>9:00</td>
                    <td>18:00</td>
                    <td>8:45</td>
                    <td>18:15</td>
                    <td>8:55</td>
                    <td>18:03</td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td>2017/08/27(日)</td>
                    <td>9:00</td>
                    <td>18:00</td>
                    <td>8:45</td>
                    <td>18:15</td>
                    <td>8:55</td>
                    <td>18:03</td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td>2017/08/28(月)</td>
                    <td>9:00</td>
                    <td>22:00</td>
                    <td>8:45</td>
                    <td>18:15</td>
                    <td>8:55</td>
                    <td>18:03</td>
                    <td class="bg-red">1時間超</td>
                    <td>4h</td>
                  </tr>
                  <tr>
                    <td>2017/08/29(火)</td>
                    <td>9:00</td>
                    <td>18:00</td>
                    <td>8:45</td>
                    <td>18:15</td>
                    <td>8:55</td>
                    <td>18:03</td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td>2017/08/30(水)</td>
                    <td>9:00</td>
                    <td>18:00</td>
                    <td>8:45</td>
                    <td>18:15</td>
                    <td>8:55</td>
                    <td>18:03</td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td>2017/08/31(木)</td>
                    <td>9:00</td>
                    <td>18:00</td>
                    <td>8:45</td>
                    <td>18:15</td>
                    <td>8:55</td>
                    <td>18:03</td>
                    <td class="bg-yellow">30分超</td>
                    <td></td>
                  </tr>
                </tbody>
              </table>
              <div class="row">
                <div class="col-md-12 text-center">
                  <!--<input name="submit" value="PDFで出力する" type="submit" class="btn btn-primary btn-sm">-->
                  <input name="submit" value="戻る" type="submit" class="btn btn-primary btn-sm" onClick="history.back()">
                </div>
              </div>
            </div>
          </div>
        </div>