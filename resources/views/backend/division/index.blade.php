
@extends('backend.layouts.app')
@section('content')

        <!-- breadcrumbs -->
          <div class="w3l_agileits_breadcrumbs">
            <div class="w3l_agileits_breadcrumbs_inner">
              <ul>
                <li>データ管理<span>＞</span></li>
                <li>部課の管理<span>＞</span></li>
                <li>登録済み部の一覧</li>
              </ul>
            </div>
          </div>
        <!-- //breadcrumbs -->
        <div class="inner_content_w3_agile_info two_in">
          <p class="intro">登録されている部の名称を一覧表示しています。</p>
          <!-- tables -->
          <div class="agile-tables">
            <div class="w3l-table-info agile_info_shadow">
              <div class="row mar-bottom15">
                <div class="col-md-12 text-right">
                  <input onclick="location.href='{{route('backend.division.regist')}}'" value="部の新規登録" type="button" class="btn btn-primary btn-xs">
                </div>
              </div>
              <table id="table">
                <thead>
                  <tr>
                    <th>削除</th>
                    <th>部のコード</th>
                    <th>部の名称</th>
                    <th>配下の課一覧</th>
                    <th>配下の課の編集</th>
                    <th>編集</th>
                    <th colspan="4" align="center" style="text-align: center;">表示順序</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td align="center"><input name="button2" id="button2" value="削除" type="button" class="btn btn-primary btn-xs"></td>
                    <td>D123456</td>
                    <td>営業部</td>
                    <td>営業一課<br />営業二課<br/>営業三課<br />特殊営業課</td>
                    <td align="center"><input onclick="location.href='section_list.html'" value="配下の課の編集" type="button" class="btn btn-primary btn-xs"></td>
                    <td align="center"><input onclick="location.href='division_edit.html'" value="編集" type="button" class="btn btn-primary btn-xs"></td>
                    <td style="width: 50px;"></td>
                    <td style="width: 50px;"></td>
                    <td style="width: 50px;"><input name="button8" value="↓" type="button" class="btn btn-primary btn-xs"></td>
                    <td style="width: 50px;"><input name="button9" value="LAST" type="button" class="btn btn-primary btn-xs"></td>
                  </tr>
                  <tr>
                    <td align="center"><input name="button2" id="button2" value="削除" type="button" class="btn btn-primary btn-xs"></td>
                    <td>D123456</td>
                    <td>営業部</td>
                    <td>営業一課<br />営業二課<br/>営業三課<br />特殊営業課</td>
                    <td align="center"><input onclick="location.href='section_list.html'" value="配下の課の編集" type="button" class="btn btn-primary btn-xs"></td>
                    <td align="center"><input onclick="location.href='division_edit.html'" value="編集" type="button" class="btn btn-primary btn-xs"></td>
                    <td><input name="button9" id="button11" value="TOP" type="button" class="btn btn-primary btn-xs"></td>
                    <td><input name="button9" id="button12" value="↑" type="button" class="btn btn-primary btn-xs"></td>
                    <td><input name="button8" value="↓" type="button" class="btn btn-primary btn-xs"></td>
                    <td><input name="button9" value="LAST" type="button" class="btn btn-primary btn-xs"></td>
                  </tr>
                  <tr>
                    <td align="center"><input name="button2" id="button2" value="削除" type="button" class="btn btn-primary btn-xs"></td>
                    <td>D123456</td>
                    <td>営業部</td>
                    <td>営業一課<br />営業二課<br/>営業三課<br />特殊営業課</td>
                    <td align="center"><input onclick="location.href='section_list.html'" value="配下の課の編集" type="button" class="btn btn-primary btn-xs"></td>
                    <td align="center"><input onclick="location.href='division_edit.html'" value="編集" type="button" class="btn btn-primary btn-xs"></td>
                    <td><input name="button9" id="button11" value="TOP" type="button" class="btn btn-primary btn-xs"></td>
                    <td><input name="button9" id="button12" value="↑" type="button" class="btn btn-primary btn-xs"></td>
                    <td><input name="button8" value="↓" type="button" class="btn btn-primary btn-xs"></td>
                    <td><input name="button9" value="LAST" type="button" class="btn btn-primary btn-xs"></td>
                  </tr>
                  <tr>
                    <td align="center"><input name="button2" id="button2" value="削除" type="button" class="btn btn-primary btn-xs"></td>
                    <td>D123456</td>
                    <td>営業部</td>
                    <td>営業一課<br />営業二課<br/>営業三課<br />特殊営業課</td>
                    <td align="center"><input onclick="location.href='section_list.html'" value="配下の課の編集" type="button" class="btn btn-primary btn-xs"></td>
                    <td align="center"><input onclick="location.href='division_edit.html'" value="編集" type="button" class="btn btn-primary btn-xs"></td>
                    <td><input name="button9" id="button11" value="TOP" type="button" class="btn btn-primary btn-xs"></td>
                    <td><input name="button9" id="button12" value="↑" type="button" class="btn btn-primary btn-xs"></td>
                    <td><input name="button8" value="↓" type="button" class="btn btn-primary btn-xs"></td>
                    <td><input name="button9" value="LAST" type="button" class="btn btn-primary btn-xs"></td>
                  </tr>
                  <tr>
                    <td align="center"><input name="button2" id="button2" value="削除" type="button" class="btn btn-primary btn-xs"></td>
                    <td>D123456</td>
                    <td>営業部</td>
                    <td>営業一課<br />営業二課<br/>営業三課<br />特殊営業課</td>
                    <td align="center"><input onclick="location.href='section_list.html'" value="配下の課の編集" type="button" class="btn btn-primary btn-xs"></td>
                    <td align="center"><input onclick="location.href='division_edit.html'" value="編集" type="button" class="btn btn-primary btn-xs"></td>
                    <td><input name="button9" id="button11" value="TOP" type="button" class="btn btn-primary btn-xs"></td>
                    <td><input name="button9" id="button12" value="↑" type="button" class="btn btn-primary btn-xs"></td>
                    <td><input name="button8" value="↓" type="button" class="btn btn-primary btn-xs"></td>
                    <td><input name="button9" value="LAST" type="button" class="btn btn-primary btn-xs"></td>
                  </tr>
                  <tr>
                    <td align="center"><input name="button2" id="button2" value="削除" type="button" class="btn btn-primary btn-xs"></td>
                    <td>D123456</td>
                    <td>営業部</td>
                    <td>営業一課<br />営業二課<br/>営業三課<br />特殊営業課</td>
                    <td align="center"><input onclick="location.href='section_list.html'" value="配下の課の編集" type="button" class="btn btn-primary btn-xs"></td>
                    <td align="center"><input onclick="location.href='division_edit.html'" value="編集" type="button" class="btn btn-primary btn-xs"></td>
                    <td><input name="button9" id="button11" value="TOP" type="button" class="btn btn-primary btn-xs"></td>
                    <td><input name="button9" id="button12" value="↑" type="button" class="btn btn-primary btn-xs"></td>
                    <td><input name="button8" value="↓" type="button" class="btn btn-primary btn-xs"></td>
                    <td><input name="button9" value="LAST" type="button" class="btn btn-primary btn-xs"></td>
                  </tr>
                  <tr>
                    <td align="center"><input name="button2" id="button2" value="削除" type="button" class="btn btn-primary btn-xs"></td>
                    <td>D123456</td>
                    <td>営業部</td>
                    <td>営業一課<br />営業二課<br/>営業三課<br />特殊営業課</td>
                    <td align="center"><input onclick="location.href='section_list.html'" value="配下の課の編集" type="button" class="btn btn-primary btn-xs"></td>
                    <td align="center"><input onclick="location.href='division_edit.html'" value="編集" type="button" class="btn btn-primary btn-xs"></td>
                    <td><input name="button9" id="button11" value="TOP" type="button" class="btn btn-primary btn-xs"></td>
                    <td><input name="button9" id="button12" value="↑" type="button" class="btn btn-primary btn-xs"></td>
                    <td><input name="button8" value="↓" type="button" class="btn btn-primary btn-xs"></td>
                    <td><input name="button9" value="LAST" type="button" class="btn btn-primary btn-xs"></td>
                  </tr>
                  <tr>
                    <td align="center"><input name="button2" id="button2" value="削除" type="button" class="btn btn-primary btn-xs"></td>
                    <td>D123456</td>
                    <td>営業部</td>
                    <td>営業一課<br />営業二課<br/>営業三課<br />特殊営業課</td>
                    <td align="center"><input onclick="location.href='section_list.html'" value="配下の課の編集" type="button" class="btn btn-primary btn-xs"></td>
                    <td align="center"><input onclick="location.href='division_edit.html'" value="編集" type="button" class="btn btn-primary btn-xs"></td>
                    <td><input name="button9" id="button11" value="TOP" type="button" class="btn btn-primary btn-xs"></td>
                    <td><input name="button9" id="button12" value="↑" type="button" class="btn btn-primary btn-xs"></td>
                    <td><input name="button8" value="↓" type="button" class="btn btn-primary btn-xs"></td>
                    <td><input name="button9" value="LAST" type="button" class="btn btn-primary btn-xs"></td>
                  </tr>
                  <tr>
                    <td align="center"><input name="button2" id="button2" value="削除" type="button" class="btn btn-primary btn-xs"></td>
                    <td>D123456</td>
                    <td>営業部</td>
                    <td>営業一課<br />営業二課<br/>営業三課<br />特殊営業課</td>
                    <td align="center"><input onclick="location.href='section_list.html'" value="配下の課の編集" type="button" class="btn btn-primary btn-xs"></td>
                    <td align="center"><input onclick="location.href='division_edit.html'" value="編集" type="button" class="btn btn-primary btn-xs"></td>
                    <td><input name="button9" id="button11" value="TOP" type="button" class="btn btn-primary btn-xs"></td>
                    <td><input name="button9" id="button12" value="↑" type="button" class="btn btn-primary btn-xs"></td>
                    <td></td>
                    <td></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
      

@endsection