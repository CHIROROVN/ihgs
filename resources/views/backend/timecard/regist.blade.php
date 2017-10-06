
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
          <p class="intro">「タイムカード」のデータを取り込みます。ファイルを指定し、「取り込み開始」をクリックしてください。<br />
            ※過去のデータを削除する場合は、一覧表内の「削除」ボタンをクリックしてください。<br />
            ※ユニークキーがないため、データは重複されて取り込まれます。データ変更（差し替え）の場合は、必ず、削除して登録してください。</p>
          <p class="note">
            ●取り込むデータの形式●<br />
            社員番号：00列目<br />
            日付：00列目<br />
            出社時刻：00列目<br />
            退社時刻：00列目
          </p>
          <div class="graph-form agile_info_shadow">
            <div class="form-body">
              <form> 
                <table class="table table-bordered">
                  <tr>
                    <td class="col-title col-md-3"><label for="">データ名称</label></td>
                    <td class="col-md-9">
                      <div class="col-md-6">
                        <input type="text" class="form-control" id="">
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td class="col-title col-md-3"><label for="">取り込むデータ</label></td>
                    <td class="col-md-9">
                      <div class="bt-browser mar-left15">
                        <button type="button" class="bfs btn btn-primary" data-style="fileStyle-l"><span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span> ファイルを選ぶ</button>
                      </div>
                      <div class="fl-left">
                        <input name="button" value="取り込み開始" type="button" class="btn btn-primary">
                      </div>
                    </td>
                  </tr>
                 </table>
                </form> 
              </div>
           </div>
          <!-- tables -->
          <div class="agile-tables">
            <div class="w3l-table-info agile_info_shadow">
              <table id="table">
                <thead>
                  <tr>
                    <th>削除</th>
                    <th>データ名称</th>
                    <th>取り込み日時</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td align="center" style="width: 150px;"><input name="button2" value="削除" type="button" class="btn btn-primary btn-xs"></td>
                    <td>2017年8月期</td>
                    <td>2017/08/11 12:34:56</td>
                  </tr>
                  <tr>
                    <td align="center"><input name="button2" value="削除" type="button" class="btn btn-primary btn-xs"></td>
                    <td>2017年7月期</td>
                    <td>2017/08/11 12:34:56</td>
                  </tr>
                  <tr>
                    <td align="center"><input name="button2" value="削除" type="button" class="btn btn-primary btn-xs"></td>
                    <td>2017年6月期</td>
                    <td>2017/08/11 12:34:56</td>
                  </tr>
                  <tr>
                    <td align="center"><input name="button2" value="削除" type="button" class="btn btn-primary btn-xs"></td>
                    <td>2017年5月期</td>
                    <td>2017/08/11 12:34:56</td>
                  </tr>
                  <tr>
                    <td align="center"><input name="button2" value="削除" type="button" class="btn btn-primary btn-xs"></td>
                    <td>2017年4月期</td>
                    <td>2017/08/11 12:34:56</td>
                  </tr>
                  <tr>
                    <td align="center"><input name="button2" value="削除" type="button" class="btn btn-primary btn-xs"></td>
                    <td>2017年3月期</td>
                    <td>2017/08/11 12:34:56</td>
                  </tr>
                  <tr>
                    <td align="center"><input name="button2" value="削除" type="button" class="btn btn-primary btn-xs"></td>
                    <td>2017年2月期</td>
                    <td>2017/08/11 12:34:56</td>
                  </tr>
                  <tr>
                    <td align="center"><input name="button2" value="削除" type="button" class="btn btn-primary btn-xs"></td>
                    <td>2017年1月期</td>
                    <td>2017/08/11 12:34:56</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
       
@endsection