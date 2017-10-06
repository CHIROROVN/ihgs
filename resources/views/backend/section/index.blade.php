
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
          <div class="agile-tabl
        <!-- breadcrumbs -->
          <div class="w3l_agileits_breadcrumbs">
            <div class="w3l_agileits_breadcrumbs_inner">
              <ul>
                <li>データ管理<span>＞</span></li>
                <li>部課の管理<span>＞</span></li>
                <li>登録済み課の一覧</li>
              </ul>
            </div>
          </div>
        <!-- //breadcrumbs -->
        <div class="inner_content_w3_agile_info two_in">
          <p class="intro">登録されている課の名称を一覧表示しています。</p>
          <div class="graph-form agile_info_shadow">
            <div class="form-body">
              <form> 
                <table class="table table-bordered">
                  <tr>
                    <td class="col-title col-md-3"><label for="">表示している部の名称</label></td>
                    <td class="col-md-9"><span style="line-height: 35px;">営業部</span><input onclick="location.href='division_list.html'" value="部の再選択" type="button" class="btn btn-primary btn-xs mar-left15"></td>
                  </tr>
                 </table>
                </form> 
              </div>
           </div>
          <!-- tables -->
          <div class="agile-tables">
            <div class="w3l-table-info agile_info_shadow">
              <div class="row mar-bottom15">
                <div class="col-md-12 text-right">
                  <input onclick="location.href='section_regist.html'" value="課の新規登録" type="button" class="btn btn-primary btn-xs">
                </div>
              </div>
              <table id="table" class="mar-bottom15">
                <thead>
                  <tr>
                    <th>削除</th>
                    <th>課のコード</th>
                    <th>課の名称</th>
                    <th>編集</th>
                    <th colspan="4">表示順序</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td align="center"><input name="button2" id="button2" value="削除" type="button" class="btn btn-primary btn-xs"></td>
                    <td>S123456</td>
                    <td>営業一課</td>
                    <td align="center"><input onclick="location.href='section_edit.html'" value="編集" type="button" class="btn btn-primary btn-xs"></td>
                    <td style="width: 50px;"></td>
                    <td style="width: 50px;"></td>
                    <td style="width: 50px;"><input name="button8" value="↓" type="button" class="btn btn-primary btn-xs"></td>
                    <td style="width: 50px;"><input name="button9" value="LAST" type="button" class="btn btn-primary btn-xs"></td>
                  </tr>
                  <tr>
                    <td align="center"><input name="button2" id="button2" value="削除" type="button" class="btn btn-primary btn-xs"></td>
                    <td>S123456</td>
                    <td>営業一課</td>
                    <td align="center"><input onclick="location.href='section_edit.html'" value="編集" type="button" class="btn btn-primary btn-xs"></td>
                    <td><input name="button9" id="button11" value="TOP" type="button" class="btn btn-primary btn-xs"></td>
                    <td><input name="button9" id="button12" value="↑" type="button" class="btn btn-primary btn-xs"></td>
                    <td><input name="button8" value="↓" type="button" class="btn btn-primary btn-xs"></td>
                    <td><input name="button9" value="LAST" type="button" class="btn btn-primary btn-xs"></td>
                  </tr>
                  <tr>
                    <td align="center"><input name="button2" id="button2" value="削除" type="button" class="btn btn-primary btn-xs"></td>
                    <td>S123456</td>
                    <td>営業一課</td>
                    <td align="center"><input onclick="location.href='section_edit.html'" value="編集" type="button" class="btn btn-primary btn-xs"></td>
                    <td><input name="button9" id="button11" value="TOP" type="button" class="btn btn-primary btn-xs"></td>
                    <td><input name="button9" id="button12" value="↑" type="button" class="btn btn-primary btn-xs"></td>
                    <td><input name="button8" value="↓" type="button" class="btn btn-primary btn-xs"></td>
                    <td><input name="button9" value="LAST" type="button" class="btn btn-primary btn-xs"></td>
                  </tr>
                  <tr>
                    <td align="center"><input name="button2" id="button2" value="削除" type="button" class="btn btn-primary btn-xs"></td>
                    <td>S123456</td>
                    <td>営業一課</td>
                    <td align="center"><input onclick="location.href='section_edit.html'" value="編集" type="button" class="btn btn-primary btn-xs"></td>
                    <td><input name="button9" id="button11" value="TOP" type="button" class="btn btn-primary btn-xs"></td>
                    <td><input name="button9" id="button12" value="↑" type="button" class="btn btn-primary btn-xs"></td>
                    <td><input name="button8" value="↓" type="button" class="btn btn-primary btn-xs"></td>
                    <td><input name="button9" value="LAST" type="button" class="btn btn-primary btn-xs"></td>
                  </tr>
                  <tr>
                    <td align="center"><input name="button2" id="button2" value="削除" type="button" class="btn btn-primary btn-xs"></td>
                    <td>S123456</td>
                    <td>営業一課</td>
                    <td align="center"><input onclick="location.href='section_edit.html'" value="編集" type="button" class="btn btn-primary btn-xs"></td>
                    <td><input name="button9" id="button11" value="TOP" type="button" class="btn btn-primary btn-xs"></td>
                    <td><input name="button9" id="button12" value="↑" type="button" class="btn btn-primary btn-xs"></td>
                    <td><input name="button8" value="↓" type="button" class="btn btn-primary btn-xs"></td>
                    <td><input name="button9" value="LAST" type="button" class="btn btn-primary btn-xs"></td>
                  </tr>
                  <tr>
                    <td align="center"><input name="button2" id="button2" value="削除" type="button" class="btn btn-primary btn-xs"></td>
                    <td>S123456</td>
                    <td>営業一課</td>
                    <td align="center"><input onclick="location.href='section_edit.html'" value="編集" type="button" class="btn btn-primary btn-xs"></td>
                    <td><input name="button9" id="button11" value="TOP" type="button" class="btn btn-primary btn-xs"></td>
                    <td><input name="button9" id="button12" value="↑" type="button" class="btn btn-primary btn-xs"></td>
                    <td><input name="button8" value="↓" type="button" class="btn btn-primary btn-xs"></td>
                    <td><input name="button9" value="LAST" type="button" class="btn btn-primary btn-xs"></td>
                  </tr>
                  <tr>
                    <td align="center"><input name="button2" id="button2" value="削除" type="button" class="btn btn-primary btn-xs"></td>
                    <td>S123456</td>
                    <td>営業一課</td>
                    <td align="center"><input onclick="location.href='section_edit.html'" value="編集" type="button" class="btn btn-primary btn-xs"></td>
                    <td><input name="button9" id="button11" value="TOP" type="button" class="btn btn-primary btn-xs"></td>
                    <td><input name="button9" id="button12" value="↑" type="button" class="btn btn-primary btn-xs"></td>
                    <td><input name="button8" value="↓" type="button" class="btn btn-primary btn-xs"></td>
                    <td><input name="button9" value="LAST" type="button" class="btn btn-primary btn-xs"></td>
                  </tr>
                  <tr>
                    <td align="center"><input name="button2" id="button2" value="削除" type="button" class="btn btn-primary btn-xs"></td>
                    <td>S123456</td>
                    <td>営業一課</td>
                    <td align="center"><input onclick="location.href='section_edit.html'" value="編集" type="button" class="btn btn-primary btn-xs"></td>
                    <td><input name="button9" id="button11" value="TOP" type="button" class="btn btn-primary btn-xs"></td>
                    <td><input name="button9" id="button12" value="↑" type="button" class="btn btn-primary btn-xs"></td>
                    <td><input name="button8" value="↓" type="button" class="btn btn-primary btn-xs"></td>
                    <td><input name="button9" value="LAST" type="button" class="btn btn-primary btn-xs"></td>
                  </tr>
                  <tr>
                    <td align="center"><input name="button2" id="button2" value="削除" type="button" class="btn btn-primary btn-xs"></td>
                    <td>S123456</td>
                    <td>営業部</td>
                    <td align="center"><input onclick="location.href='section_edit.html'" value="編集" type="button" class="btn btn-primary btn-xs"></td>
                    <td><input name="button9" id="button11" value="TOP" type="button" class="btn btn-primary btn-xs"></td>
                    <td><input name="button9" id="button12" value="↑" type="button" class="btn btn-primary btn-xs"></td>
                    <td></td>
                    <td></td>
                  </tr>
                </tbody>
              </table>
              <div class="row">
                <div class="col-md-12 text-center">
                  <input onclick="location.href='division_list.html'" value="登録済み部の一覧に戻る" type="button" class="btn btn-primary btn-sm">
                </div>
              </div>
            </div>
          </div>es">
            <div class="w3l-tabl
        <!-- breadcrumbs -->
          <div class="w3l_agileits_breadcrumbs">
            <div class="w3l_agileits_breadcrumbs_inner">
              <ul>
                <li>データ管理<span>＞</span></li>
                <li>部課の管理<span>＞</span></li>
                <li>登録済み課の一覧</li>
              </ul>
            </div>
          </div>
        <!-- //breadcrumbs -->
        <div class="inner_content_w3_agile_info two_in">
          <p class="intro">登録されている課の名称を一覧表示しています。</p>
          <div class="graph-form agile_info_shadow">
            <div class="form-body">
              <form> 
                <table class="table table-bordered">
                  <tr>
                    <td class="col-title col-md-3"><label for="">表示している部の名称</label></td>
                    <td class="col-md-9"><span style="line-height: 35px;">営業部</span><input onclick="location.href='division_list.html'" value="部の再選択" type="button" class="btn btn-primary btn-xs mar-left15"></td>
                  </tr>
                 </table>
                </form> 
              </div>
           </div>
          <!-- tables -->
          <div class="agile-tables">
            <div class="w3l-table-info agile_info_shadow">
              <div class="row mar-bottom15">
                <div class="col-md-12 text-right">
                  <input onclick="location.href='section_regist.html'" value="課の新規登録" type="button" class="btn btn-primary btn-xs">
                </div>
              </div>
              <table id="table" class="mar-bottom15">
                <thead>
                  <tr>
                    <th>削除</th>
                    <th>課のコード</th>
                    <th>課の名称</th>
                    <th>編集</th>
                    <th colspan="4">表示順序</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td align="center"><input name="button2" id="button2" value="削除" type="button" class="btn btn-primary btn-xs"></td>
                    <td>S123456</td>
                    <td>営業一課</td>
                    <td align="center"><input onclick="location.href='section_edit.html'" value="編集" type="button" class="btn btn-primary btn-xs"></td>
                    <td style="width: 50px;"></td>
                    <td style="width: 50px;"></td>
                    <td style="width: 50px;"><input name="button8" value="↓" type="button" class="btn btn-primary btn-xs"></td>
                    <td style="width: 50px;"><input name="button9" value="LAST" type="button" class="btn btn-primary btn-xs"></td>
                  </tr>
                  <tr>
                    <td align="center"><input name="button2" id="button2" value="削除" type="button" class="btn btn-primary btn-xs"></td>
                    <td>S123456</td>
                    <td>営業一課</td>
                    <td align="center"><input onclick="location.href='section_edit.html'" value="編集" type="button" class="btn btn-primary btn-xs"></td>
                    <td><input name="button9" id="button11" value="TOP" type="button" class="btn btn-primary btn-xs"></td>
                    <td><input name="button9" id="button12" value="↑" type="button" class="btn btn-primary btn-xs"></td>
                    <td><input name="button8" value="↓" type="button" class="btn btn-primary btn-xs"></td>
                    <td><input name="button9" value="LAST" type="button" class="btn btn-primary btn-xs"></td>
                  </tr>
                  <tr>
                    <td align="center"><input name="button2" id="button2" value="削除" type="button" class="btn btn-primary btn-xs"></td>
                    <td>S123456</td>
                    <td>営業一課</td>
                    <td align="center"><input onclick="location.href='section_edit.html'" value="編集" type="button" class="btn btn-primary btn-xs"></td>
                    <td><input name="button9" id="button11" value="TOP" type="button" class="btn btn-primary btn-xs"></td>
                    <td><input name="button9" id="button12" value="↑" type="button" class="btn btn-primary btn-xs"></td>
                    <td><input name="button8" value="↓" type="button" class="btn btn-primary btn-xs"></td>
                    <td><input name="button9" value="LAST" type="button" class="btn btn-primary btn-xs"></td>
                  </tr>
                  <tr>
                    <td align="center"><input name="button2" id="button2" value="削除" type="button" class="btn btn-primary btn-xs"></td>
                    <td>S123456</td>
                    <td>営業一課</td>
                    <td align="center"><input onclick="location.href='section_edit.html'" value="編集" type="button" class="btn btn-primary btn-xs"></td>
                    <td><input name="button9" id="button11" value="TOP" type="button" class="btn btn-primary btn-xs"></td>
                    <td><input name="button9" id="button12" value="↑" type="button" class="btn btn-primary btn-xs"></td>
                    <td><input name="button8" value="↓" type="button" class="btn btn-primary btn-xs"></td>
                    <td><input name="button9" value="LAST" type="button" class="btn btn-primary btn-xs"></td>
                  </tr>
                  <tr>
                    <td align="center"><input name="button2" id="button2" value="削除" type="button" class="btn btn-primary btn-xs"></td>
                    <td>S123456</td>
                    <td>営業一課</td>
                    <td align="center"><input onclick="location.href='section_edit.html'" value="編集" type="button" class="btn btn-primary btn-xs"></td>
                    <td><input name="button9" id="button11" value="TOP" type="button" class="btn btn-primary btn-xs"></td>
                    <td><input name="button9" id="button12" value="↑" type="button" class="btn btn-primary btn-xs"></td>
                    <td><input name="button8" value="↓" type="button" class="btn btn-primary btn-xs"></td>
                    <td><input name="button9" value="LAST" type="button" class="btn btn-primary btn-xs"></td>
                  </tr>
                  <tr>
                    <td align="center"><input name="button2" id="button2" value="削除" type="button" class="btn btn-primary btn-xs"></td>
                    <td>S123456</td>
                    <td>営業一課</td>
                    <td align="center"><input onclick="location.href='section_edit.html'" value="編集" type="button" class="btn btn-primary btn-xs"></td>
                    <td><input name="button9" id="button11" value="TOP" type="button" class="btn btn-primary btn-xs"></td>
                    <td><input name="button9" id="button12" value="↑" type="button" class="btn btn-primary btn-xs"></td>
                    <td><input name="button8" value="↓" type="button" class="btn btn-primary btn-xs"></td>
                    <td><input name="button9" value="LAST" type="button" class="btn btn-primary btn-xs"></td>
                  </tr>
                  <tr>
                    <td align="center"><input name="button2" id="button2" value="削除" type="button" class="btn btn-primary btn-xs"></td>
                    <td>S123456</td>
                    <td>営業一課</td>
                    <td align="center"><input onclick="location.href='section_edit.html'" value="編集" type="button" class="btn btn-primary btn-xs"></td>
                    <td><input name="button9" id="button11" value="TOP" type="button" class="btn btn-primary btn-xs"></td>
                    <td><input name="button9" id="button12" value="↑" type="button" class="btn btn-primary btn-xs"></td>
                    <td><input name="button8" value="↓" type="button" class="btn btn-primary btn-xs"></td>
                    <td><input name="button9" value="LAST" type="button" class="btn btn-primary btn-xs"></td>
                  </tr>
                  <tr>
                    <td align="center"><input name="button2" id="button2" value="削除" type="button" class="btn btn-primary btn-xs"></td>
                    <td>S123456</td>
                    <td>営業一課</td>
                    <td align="center"><input onclick="location.href='section_edit.html'" value="編集" type="button" class="btn btn-primary btn-xs"></td>
                    <td><input name="button9" id="button11" value="TOP" type="button" class="btn btn-primary btn-xs"></td>
                    <td><input name="button9" id="button12" value="↑" type="button" class="btn btn-primary btn-xs"></td>
                    <td><input name="button8" value="↓" type="button" class="btn btn-primary btn-xs"></td>
                    <td><input name="button9" value="LAST" type="button" class="btn btn-primary btn-xs"></td>
                  </tr>
                  <tr>
                    <td align="center"><input name="button2" id="button2" value="削除" type="button" class="btn btn-primary btn-xs"></td>
                    <td>S123456</td>
                    <td>営業部</td>
                    <td align="center"><input onclick="location.href='section_edit.html'" value="編集" type="button" class="btn btn-primary btn-xs"></td>
                    <td><input name="button9" id="button11" value="TOP" type="button" class="btn btn-primary btn-xs"></td>
                    <td><input name="button9" id="button12" value="↑" type="button" class="btn btn-primary btn-xs"></td>
                    <td></td>
                    <td></td>
                  </tr>
                </tbody>
              </table>
              <div class="row">
                <div class="col-md-12 text-center">
                  <input onclick="location.href='division_list.html'" value="登録済み部の一覧に戻る" type="button" class="btn btn-primary btn-sm">
                </div>
              </div>
            </div>
          </div>e-info agile_info_shadow">
              <div class="row ma
        <!-- breadcrumbs -->
          <div class="w3l_agileits_breadcrumbs">
            <div class="w3l_agileits_breadcrumbs_inner">
              <ul>
                <li>データ管理<span>＞</span></li>
                <li>部課の管理<span>＞</span></li>
                <li>登録済み課の一覧</li>
              </ul>
            </div>
          </div>
        <!-- //breadcrumbs -->
        <div class="inner_content_w3_agile_info two_in">
          <p class="intro">登録されている課の名称を一覧表示しています。</p>
          <div class="graph-form agile_info_shadow">
            <div class="form-body">
              <form> 
                <table class="table table-bordered">
                  <tr>
                    <td class="col-title col-md-3"><label for="">表示している部の名称</label></td>
                    <td class="col-md-9"><span style="line-height: 35px;">営業部</span><input onclick="location.href='division_list.html'" value="部の再選択" type="button" class="btn btn-primary btn-xs mar-left15"></td>
                  </tr>
                 </table>
                </form> 
              </div>
           </div>
          <!-- tables -->
          <div class="agile-tables">
            <div class="w3l-table-info agile_info_shadow">
              <div class="row mar-bottom15">
                <div class="col-md-12 text-right">
                  <input onclick="location.href='section_regist.html'" value="課の新規登録" type="button" class="btn btn-primary btn-xs">
                </div>
              </div>
              <table id="table" class="mar-bottom15">
                <thead>
                  <tr>
                    <th>削除</th>
                    <th>課のコード</th>
                    <th>課の名称</th>
                    <th>編集</th>
                    <th colspan="4">表示順序</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td align="center"><input name="button2" id="button2" value="削除" type="button" class="btn btn-primary btn-xs"></td>
                    <td>S123456</td>
                    <td>営業一課</td>
                    <td align="center"><input onclick="location.href='section_edit.html'" value="編集" type="button" class="btn btn-primary btn-xs"></td>
                    <td style="width: 50px;"></td>
                    <td style="width: 50px;"></td>
                    <td style="width: 50px;"><input name="button8" value="↓" type="button" class="btn btn-primary btn-xs"></td>
                    <td style="width: 50px;"><input name="button9" value="LAST" type="button" class="btn btn-primary btn-xs"></td>
                  </tr>
                  <tr>
                    <td align="center"><input name="button2" id="button2" value="削除" type="button" class="btn btn-primary btn-xs"></td>
                    <td>S123456</td>
                    <td>営業一課</td>
                    <td align="center"><input onclick="location.href='section_edit.html'" value="編集" type="button" class="btn btn-primary btn-xs"></td>
                    <td><input name="button9" id="button11" value="TOP" type="button" class="btn btn-primary btn-xs"></td>
                    <td><input name="button9" id="button12" value="↑" type="button" class="btn btn-primary btn-xs"></td>
                    <td><input name="button8" value="↓" type="button" class="btn btn-primary btn-xs"></td>
                    <td><input name="button9" value="LAST" type="button" class="btn btn-primary btn-xs"></td>
                  </tr>
                  <tr>
                    <td align="center"><input name="button2" id="button2" value="削除" type="button" class="btn btn-primary btn-xs"></td>
                    <td>S123456</td>
                    <td>営業一課</td>
                    <td align="center"><input onclick="location.href='section_edit.html'" value="編集" type="button" class="btn btn-primary btn-xs"></td>
                    <td><input name="button9" id="button11" value="TOP" type="button" class="btn btn-primary btn-xs"></td>
                    <td><input name="button9" id="button12" value="↑" type="button" class="btn btn-primary btn-xs"></td>
                    <td><input name="button8" value="↓" type="button" class="btn btn-primary btn-xs"></td>
                    <td><input name="button9" value="LAST" type="button" class="btn btn-primary btn-xs"></td>
                  </tr>
                  <tr>
                    <td align="center"><input name="button2" id="button2" value="削除" type="button" class="btn btn-primary btn-xs"></td>
                    <td>S123456</td>
                    <td>営業一課</td>
                    <td align="center"><input onclick="location.href='section_edit.html'" value="編集" type="button" class="btn btn-primary btn-xs"></td>
                    <td><input name="button9" id="button11" value="TOP" type="button" class="btn btn-primary btn-xs"></td>
                    <td><input name="button9" id="button12" value="↑" type="button" class="btn btn-primary btn-xs"></td>
                    <td><input name="button8" value="↓" type="button" class="btn btn-primary btn-xs"></td>
                    <td><input name="button9" value="LAST" type="button" class="btn btn-primary btn-xs"></td>
                  </tr>
                  <tr>
                    <td align="center"><input name="button2" id="button2" value="削除" type="button" class="btn btn-primary btn-xs"></td>
                    <td>S123456</td>
                    <td>営業一課</td>
                    <td align="center"><input onclick="location.href='section_edit.html'" value="編集" type="button" class="btn btn-primary btn-xs"></td>
                    <td><input name="button9" id="button11" value="TOP" type="button" class="btn btn-primary btn-xs"></td>
                    <td><input name="button9" id="button12" value="↑" type="button" class="btn btn-primary btn-xs"></td>
                    <td><input name="button8" value="↓" type="button" class="btn btn-primary btn-xs"></td>
                    <td><input name="button9" value="LAST" type="button" class="btn btn-primary btn-xs"></td>
                  </tr>
                  <tr>
                    <td align="center"><input name="button2" id="button2" value="削除" type="button" class="btn btn-primary btn-xs"></td>
                    <td>S123456</td>
                    <td>営業一課</td>
                    <td align="center"><input onclick="location.href='section_edit.html'" value="編集" type="button" class="btn btn-primary btn-xs"></td>
                    <td><input name="button9" id="button11" value="TOP" type="button" class="btn btn-primary btn-xs"></td>
                    <td><input name="button9" id="button12" value="↑" type="button" class="btn btn-primary btn-xs"></td>
                    <td><input name="button8" value="↓" type="button" class="btn btn-primary btn-xs"></td>
                    <td><input name="button9" value="LAST" type="button" class="btn btn-primary btn-xs"></td>
                  </tr>
                  <tr>
                    <td align="center"><input name="button2" id="button2" value="削除" type="button" class="btn btn-primary btn-xs"></td>
                    <td>S123456</td>
                    <td>営業一課</td>
                    <td align="center"><input onclick="location.href='section_edit.html'" value="編集" type="button" class="btn btn-primary btn-xs"></td>
                    <td><input name="button9" id="button11" value="TOP" type="button" class="btn btn-primary btn-xs"></td>
                    <td><input name="button9" id="button12" value="↑" type="button" class="btn btn-primary btn-xs"></td>
                    <td><input name="button8" value="↓" type="button" class="btn btn-primary btn-xs"></td>
                    <td><input name="button9" value="LAST" type="button" class="btn btn-primary btn-xs"></td>
                  </tr>
                  <tr>
                    <td align="center"><input name="button2" id="button2" value="削除" type="button" class="btn btn-primary btn-xs"></td>
                    <td>S123456</td>
                    <td>営業一課</td>
                    <td align="center"><input onclick="location.href='section_edit.html'" value="編集" type="button" class="btn btn-primary btn-xs"></td>
                    <td><input name="button9" id="button11" value="TOP" type="button" class="btn btn-primary btn-xs"></td>
                    <td><input name="button9" id="button12" value="↑" type="button" class="btn btn-primary btn-xs"></td>
                    <td><input name="button8" value="↓" type="button" class="btn btn-primary btn-xs"></td>
                    <td><input name="button9" value="LAST" type="button" class="btn btn-primary btn-xs"></td>
                  </tr>
                  <tr>
                    <td align="center"><input name="button2" id="button2" value="削除" type="button" class="btn btn-primary btn-xs"></td>
                    <td>S123456</td>
                    <td>営業部</td>
                    <td align="center"><input onclick="location.href='section_edit.html'" value="編集" type="button" class="btn btn-primary btn-xs"></td>
                    <td><input name="button9" id="button11" value="TOP" type="button" class="btn btn-primary btn-xs"></td>
                    <td><input name="button9" id="button12" value="↑" type="button" class="btn btn-primary btn-xs"></td>
                    <td></td>
                    <td></td>
                  </tr>
                </tbody>
              </table>
              <div class="row">
                <div class="col-md-12 text-center">
                  <input onclick="location.href='division_list.html'" value="登録済み部の一覧に戻る" type="button" class="btn btn-primary btn-sm">
                </div>
              </div>
            </div>
          </div>      

@endsection