
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
                  <input onclick="location.href='division_regist.html'" value="部の新規登録" type="button" class="btn btn-primary btn-xs">
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
        <!-- breadcrumbs -->
          <div class="w3l_agileits_breadcrumbs">
            <div class="w3l_agileits_breadcrumbs_inner">
              <ul>
                <li>データ管理<span>＞</span></li>
                <li>登録済み社員データの検索結果一覧</li>
              </ul>
            </div>
          </div>
        <!-- //breadcrumbs -->
        <div class="inner_content_w3_agile_info two_in">
          <p class="intro">検索の結果、**件が該当しました。うち、1～20件を表示しています。</p>
          <!-- tables -->
          <div class="agile-tables">
            <div class="w3l-table-info agile_info_shadow">
              <div class="row mar-bottom15">
                <div class="col-md-12 text-right">
                  <input onclick="location.href='staff_regist.html'" value="社員データの新規登録" type="button" class="btn btn-primary btn-xs">
                </div>
              </div>
              <table id="table" class="mar-bottom15">
                <thead>
                  <tr>
                    <th>削除</th>
                    <th>社員番号</th>
                    <th>社員名</th>
                    <th>所属部署</th>
                    <th>入退出カード番号</th>
                    <th>PC番号</th>
                    <th>編集</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td align="center"><input name="submit" value="削除" type="submit" class="btn btn-primary btn-xs"></td>
                    <td>1234567</td>
                    <td>山田太郎</td>
                    <td>営業部営業一課</td>
                    <td>1234567890</td>
                    <td>1234567890ABC</td>
                    <td align="center"><input name="button" value="編集" type="button" class="btn btn-primary btn-xs"></td>
                  </tr>
                  <tr>
                    <td align="center"><input name="submit" value="削除" type="submit" class="btn btn-primary btn-xs"></td>
                    <td>1234567</td>
                    <td>山田太郎</td>
                    <td>営業部営業一課</td>
                    <td>1234567890</td>
                    <td>1234567890ABC</td>
                    <td align="center"><input name="button" value="編集" type="button" class="btn btn-primary btn-xs"></td>
                  </tr>
                  <tr>
                    <td align="center"><input name="submit" value="削除" type="submit" class="btn btn-primary btn-xs"></td>
                    <td>1234567</td>
                    <td>山田太郎</td>
                    <td>営業部営業一課</td>
                    <td>1234567890</td>
                    <td>1234567890ABC</td>
                    <td align="center"><input name="button" value="編集" type="button" class="btn btn-primary btn-xs"></td>
                  </tr>
                  <tr>
                    <td align="center"><input name="submit" value="削除" type="submit" class="btn btn-primary btn-xs"></td>
                    <td>1234567</td>
                    <td>山田太郎</td>
                    <td>営業部営業一課</td>
                    <td>1234567890</td>
                    <td>1234567890ABC</td>
                    <td align="center"><input name="button" value="編集" type="button" class="btn btn-primary btn-xs"></td>
                  </tr>
                  <tr>
                    <td align="center"><input name="submit" value="削除" type="submit" class="btn btn-primary btn-xs"></td>
                    <td>1234567</td>
                    <td>山田太郎</td>
                    <td>営業部営業一課</td>
                    <td>1234567890</td>
                    <td>1234567890ABC</td>
                    <td align="center"><input name="button" value="編集" type="button" class="btn btn-primary btn-xs"></td>
                  </tr>
                  <tr>
                    <td align="center"><input name="submit" value="削除" type="submit" class="btn btn-primary btn-xs"></td>
                    <td>1234567</td>
                    <td>山田太郎</td>
                    <td>営業部営業一課</td>
                    <td>1234567890</td>
                    <td>1234567890ABC</td>
                    <td align="center"><input name="button" value="編集" type="button" class="btn btn-primary btn-xs"></td>
                  </tr>
                  <tr>
                    <td align="center"><input name="submit" value="削除" type="submit" class="btn btn-primary btn-xs"></td>
                    <td>1234567</td>
                    <td>山田太郎</td>
                    <td>営業部営業一課</td>
                    <td>1234567890</td>
                    <td>1234567890ABC</td>
                    <td align="center"><input name="button" value="編集" type="button" class="btn btn-primary btn-xs"></td>
                  </tr>
                  <tr>
                    <td align="center"><input name="submit" value="削除" type="submit" class="btn btn-primary btn-xs"></td>
                    <td>1234567</td>
                    <td>山田太郎</td>
                    <td>営業部営業一課</td>
                    <td>1234567890</td>
                    <td>1234567890ABC</td>
                    <td align="center"><input name="button" value="編集" type="button" class="btn btn-primary btn-xs"></td>
                  </tr>
                </tbody>
              </table>
              <div class="row mar-bottom15">
                <div class="col-md-12 text-center">
                  <input name="submit2" disabled="" value="前の20件を表示" type="submit" class="btn btn-primary btn-sm">
                  <input name="submit3" value="次の20件を表示" type="submit" class="btn btn-primary btn-sm mar-left15">
                </div>
              </div>
              <div class="row">
                <div class="col-md-12 text-center">
                  <input onclick="location.href='staff_search.html'" value="条件を変えて再検索" type="button" class="btn btn-primary btn-sm">
                </div>
              </div>
            </div>
          </div>
                    <td>営業一課<br />営業二課<br/>営業三課<br />特殊営業課<
        <!-- breadcrumbs -->
          <div class="w3l_agileits_breadcrumbs">
            <div class="w3l_agileits_breadcrumbs_inner">
              <ul>
                <li>データ管理<span>＞</span></li>
                <li>登録済み社員データの検索結果一覧</li>
              </ul>
            </div>
          </div>
        <!-- //breadcrumbs -->
        <div class="inner_content_w3_agile_info two_in">
          <p class="intro">検索の結果、**件が該当しました。うち、1～20件を表示しています。</p>
          <!-- tables -->
          <div class="agile-tables">
            <div class="w3l-table-info agile_info_shadow">
              <div class="row mar-bottom15">
                <div class="col-md-12 text-right">
                  <input onclick="location.href='staff_regist.html'" value="社員データの新規登録" type="button" class="btn btn-primary btn-xs">
                </div>
              </div>
              <table id="table" class="mar-bottom15">
                <thead>
                  <tr>
                    <th>削除</th>
                    <th>社員番号</th>
                    <th>社員名</th>
                    <th>所属部署</th>
                    <th>入退出カード番号</th>
                    <th>PC番号</th>
                    <th>編集</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td align="center"><input name="submit" value="削除" type="submit" class="btn btn-primary btn-xs"></td>
                    <td>1234567</td>
                    <td>山田太郎</td>
                    <td>営業部営業一課</td>
                    <td>1234567890</td>
                    <td>1234567890ABC</td>
                    <td align="center"><input name="button" value="編集" type="button" class="btn btn-primary btn-xs"></td>
                  </tr>
                  <tr>
                    <td align="center"><input name="submit" value="削除" type="submit" class="btn btn-primary btn-xs"></td>
                    <td>1234567</td>
                    <td>山田太郎</td>
                    <td>営業部営業一課</td>
                    <td>1234567890</td>
                    <td>1234567890ABC</td>
                    <td align="center"><input name="button" value="編集" type="button" class="btn btn-primary btn-xs"></td>
                  </tr>
                  <tr>
                    <td align="center"><input name="submit" value="削除" type="submit" class="btn btn-primary btn-xs"></td>
                    <td>1234567</td>
                    <td>山田太郎</td>
                    <td>営業部営業一課</td>
                    <td>1234567890</td>
                    <td>1234567890ABC</td>
                    <td align="center"><input name="button" value="編集" type="button" class="btn btn-primary btn-xs"></td>
                  </tr>
                  <tr>
                    <td align="center"><input name="submit" value="削除" type="submit" class="btn btn-primary btn-xs"></td>
                    <td>1234567</td>
                    <td>山田太郎</td>
                    <td>営業部営業一課</td>
                    <td>1234567890</td>
                    <td>1234567890ABC</td>
                    <td align="center"><input name="button" value="編集" type="button" class="btn btn-primary btn-xs"></td>
                  </tr>
                  <tr>
                    <td align="center"><input name="submit" value="削除" type="submit" class="btn btn-primary btn-xs"></td>
                    <td>1234567</td>
                    <td>山田太郎</td>
                    <td>営業部営業一課</td>
                    <td>1234567890</td>
                    <td>1234567890ABC</td>
                    <td align="center"><input name="button" value="編集" type="button" class="btn btn-primary btn-xs"></td>
                  </tr>
                  <tr>
                    <td align="cen
        <!-- breadcrumbs -->
          <div class="w3l_agileits_breadcrumbs">
            <div class="w3l_agileits_breadcrumbs_inner">
              <ul>
                <li>社員マスタ管理<span>＞</span></li>
                <li>社員データの取り込み</li>
              </ul>
            </div>
          </div>
        <!-- //breadcrumbs -->
        <div class="inner_content_w3_agile_info two_in">
          <p class="intro">
          社員データを取り込みます。ファイルを指定し、「取り込み開始」をクリックしてください。<br />
          ※同一社員番号のデータが取り込まれた場合は、<br/>
          　・「社員名」、「所属課」は上書きされます。<br />
          　・「入退出カード番号」、「PC番号」は追加されます。</p>
          <!--/forms-->
          <div class="forms-main_agileits">
            <div class="graph-form agile_info_shadow">
              <div class="form-body">
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
                      <td class="col-title col-md-3"><label for="">社員名</label></td>
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
                      <td class="col-title col-md-3"><label for="">所属課</label></td>
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
                      <td class="col-title col-md-3"><label for="">入退出カード番号</label></td>
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
                      <td class="col-title col-md-3"><label for="">PC番号</label></td>
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
                  </table>
                </div>
              </div>
              <div class="graph-form agile_info_shadow">
                <div class="form-body">
                  <form> 
                    <table class="table table-bordered">
                      <tr>
                        <td class="col-title col-md-3"><label for="">取り込むデータ</label></td>
                        <td class="col-md-9" colspan="2">
                          <div class="bt-browser">
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
            </div>
          </div>ter"><input name="submit" value="削除" type="submit" class="btn btn-primary btn-xs"></td>
                    <td>1234567</t
        <!-- breadcrumbs -->
          <div class="w3l_agileits_breadcrumbs">
            <div class="w3l_agileits_breadcrumbs_inner">
              <ul>
                <li>社員マスタ管理<span>＞</span></li>
                <li>社員データの取り込み</li>
              </ul>
            </div>
          </div>
        <!-- //breadcrumbs -->
        <div class="inner_content_w3_agile_info two_in">
          <p class="intro">
          社員データを取り込みます。ファイルを指定し、「取り込み開始」をクリックしてください。<br />
          ※同一社員番号のデータが取り込まれた場合は、<br/>
          　・「社員名」、「所属課」は上書きされます。<br />
          　・「入退出カード番号」、「PC番号」は追加されます。</p>
          <!--/forms-->
          <div class="forms-main_agileits">
            <div class="graph-form agile_info_shadow">
              <div class="form-body">
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
                      <td class="col-title col-md-3"><label for="">社員名</label></td>
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
                      <td class="col-title col-md-3"><label for="">所属課</label></td>
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
                      <td class="col-title col-md-3"><label for="">入退出カード番号</label></td>
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
                      <td class="col-title col-md-3"><label for="">PC番号</label></td>
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
                  </table>
                </div>
              </div>
              <div class="graph-form agile_info_shadow">
                <div class="form-body">
                  <form> 
                    <table class="table table-bordered">
                      <tr>
                        <td class="col-title col-md-3"><label for="">取り込むデータ</label></td>
                        <td class="col-md-9" colspan="2">
                          <div class="bt-browser">
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
            </div>
          </div>
@endsection