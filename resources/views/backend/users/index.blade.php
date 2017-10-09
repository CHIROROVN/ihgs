@extends('backend.layouts.app')

@section('content')

<!-- CONTENTS -->
<!-- breadcrumbs -->
          <div class="w3l_agileits_breadcrumbs">
            <div class="w3l_agileits_breadcrumbs_inner">
              <ul>
                <li>データ管理<span>＞</span></li>
                <li>登録済みユーザーの一覧</li>
              </ul>
            </div>
          </div>
        <!-- //breadcrumbs -->
        <div class="inner_content_w3_agile_info two_in">
          <p class="intro">**件が登録されています。</p>
          <!-- tables -->
          <div class="agile-tables">
            <div class="w3l-table-info agile_info_shadow">
              <div class="row mar-bottom15">
                <div class="col-md-12 text-right">
                  <input onclick="location.href='{{route('backend.users.regist')}}'" value="ユーザーの新規登録" type="button" class="btn btn-primary btn-xs">
                </div>
              </div>
              <table id="table" class="mar-bottom15">
                <thead>
                  <tr>
                    <th>削除</th>
                    <th>社員名</th>
                    <th>所属部署</th>
                    <th>ログインID</th>
                    <th>編集</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td align="center" style="width: 120px;"><input name="submit" id="submit" value="削除" type="submit" class="btn btn-primary btn-xs"></td>
                    <td>山田太郎</td>
                    <td>営業部営業一課</td>
                    <td>1234567890</td>
                    <td align="center" style="width: 120px;"><input name="button" id="button" value="編集" type="button" class="btn btn-primary btn-xs"></td>
                  </tr>
                  <tr>
                    <td align="center"><input name="submit" id="submit" value="削除" type="submit" class="btn btn-primary btn-xs"></td>
                    <td>山田太郎</td>
                    <td>営業部営業一課</td>
                    <td>1234567890</td>
                    <td align="center"><input name="button" id="button" value="編集" type="button" class="btn btn-primary btn-xs"></td>
                  </tr>
                  <tr>
                    <td align="center"><input name="submit" id="submit" value="削除" type="submit" class="btn btn-primary btn-xs"></td>
                    <td>山田太郎</td>
                    <td>営業部営業一課</td>
                    <td>1234567890</td>
                    <td align="center"><input name="button" id="button" value="編集" type="button" class="btn btn-primary btn-xs"></td>
                  </tr>
                  <tr>
                    <td align="center"><input name="submit" id="submit" value="削除" type="submit" class="btn btn-primary btn-xs"></td>
                    <td>山田太郎</td>
                    <td>営業部営業一課</td>
                    <td>1234567890</td>
                    <td align="center"><input name="button" id="button" value="編集" type="button" class="btn btn-primary btn-xs"></td>
                  </tr>
                  <tr>
                    <td align="center"><input name="submit" id="submit" value="削除" type="submit" class="btn btn-primary btn-xs"></td>
                    <td>山田太郎</td>
                    <td>営業部営業一課</td>
                    <td>1234567890</td>
                    <td align="center"><input name="button" id="button" value="編集" type="button" class="btn btn-primary btn-xs"></td>
                  </tr>
                  <tr>
                    <td align="center"><input name="submit" id="submit" value="削除" type="submit" class="btn btn-primary btn-xs"></td>
                    <td>山田太郎</td>
                    <td>営業部営業一課</td>
                    <td>1234567890</td>
                    <td align="center"><input name="button" id="button" value="編集" type="button" class="btn btn-primary btn-xs"></td>
                  </tr>
                  <tr>
                    <td align="center"><input name="submit" id="submit" value="削除" type="submit" class="btn btn-primary btn-xs"></td>
                    <td>山田太郎</td>
                    <td>営業部営業一課</td>
                    <td>1234567890</td>
                    <td align="center"><input name="button" id="button" value="編集" type="button" class="btn btn-primary btn-xs"></td>
                  </tr>
                  <tr>
                    <td align="center"><input name="submit" id="submit" value="削除" type="submit" class="btn btn-primary btn-xs"></td>
                    <td>山田太郎</td>
                    <td>営業部営業一課</td>
                    <td>1234567890</td>
                    <td align="center"><input name="button" id="button" value="編集" type="button" class="btn btn-primary btn-xs"></td>
                  </tr>
                </tbody>
              </table>
              <div class="row">
                <div class="col-md-12 text-center">
                  <input name="submit2" disabled="" value="前の20件を表示" type="submit" class="btn btn-primary btn-sm">
                  <input name="submit3" id="submit3" value="次の20件を表示" type="submit" class="btn btn-primary btn-sm mar-left15">
                </div>
              </div>
            </div>
          </div>
        </div>
<!-- /CONTENTS -->


@endsection