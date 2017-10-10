<ul class="gn-menu agile_menu_drop" id="nav-accordion">
  <li>
    <a href="#"><i class="fa fa-search" aria-hidden="true"></i>データの抽出と表示 <i class="fa fa-angle-down" aria-hidden="true"></i></a> 
    <ul class="gn-submenu">
      <li class="mini_list_agile"><a href="{{route('backend.search.index')}}"><i class="fa fa-caret-right" aria-hidden="true"></i>個人ごと月次集計</a></li>
      <li class="mini_list_agile"><a href="{{route('backend.workingtime.index')}}"><i class="fa fa-minus" aria-hidden="true"></i>部課ごと残業集計</a></li>
    </ul>
  </li>
  <li>
    <a href="#"><i class="fa fa-database" aria-hidden="true"></i>データ管理 <i class="fa fa-angle-down" aria-hidden="true"></i></a> 
    <ul class="gn-submenu">
      <li class="mini_list_agile">
        <a href="javascript:;"><i class="fa fa-caret-right" aria-hidden="true"></i>「タイムカード」の管理</a>
        <ul class="sub">
          <li class="mini_list_agile"><a href="{{route('backend.timecard.index')}}"><i class="fa fa-minus" aria-hidden="true"></i>データの取り込み</a></li>
          <li class="mini_list_w3"><a href="{{route('backend.timecard.regist')}}"><i class="fa fa-minus" aria-hidden="true"></i>フォーマットの指定</a></li>
        </ul>
      </li>
      <li class="mini_list_w3">
        <a href="javascript:;"><i class="fa fa-caret-right" aria-hidden="true"></i>「入退出」の管理</a>
        <ul class="sub">
          <li class="mini_list_agile"><a href="{{route('backend.door.index')}}"><i class="fa fa-minus" aria-hidden="true"></i>データの取り込み</a></li>
          <li class="mini_list_w3"><a href="{{route('backend.door.regist')}}"><i class="fa fa-minus" aria-hidden="true"></i>フォーマットの指定</a></li>
        </ul>
      </li>
      <li class="mini_list_agile">
        <a href="javascript:;"><i class="fa fa-caret-right" aria-hidden="true"></i>「PCログ」の管理</a>
        <ul class="sub">
          <li class="mini_list_w3"><a href="{{route('backend.pc_import.index')}}"><i class="fa fa-minus" aria-hidden="true"></i>データの取り込み</a></li>
          <li class="mini_list_agile"><a href="{{route('backend.pc_format.index')}}"><i class="fa fa-minus" aria-hidden="true"></i>フォーマットの指定</a></li>
        </ul>
      </li>
    </ul>
  </li>
  <li>
    <a href="#"><i class="fa fa-table"></i>マスタ管理 <i class="fa fa-angle-down" aria-hidden="true"></i></a> 
    <ul class="gn-submenu">
      <li class="mini_list_agile"><a href="{{route('backend.division.index')}}"><i class="fa fa-caret-right" aria-hidden="true"></i>部課マスタの管理</a></li>
      <li class="mini_list_w3">
        <a href="javascript:;"><i class="fa fa-caret-right" aria-hidden="true"></i>社員マスタの管理</a>
        <ul class="sub">
          <li class="mini_list_agile"><a href="{{route('backend.staff.import')}}"><i class="fa fa-minus" aria-hidden="true"></i>CSVの取り込み</a></li>
          <li class="mini_list_w3"><a href="{{route('backend.staff.search')}}"><i class="fa fa-minus" aria-hidden="true"></i>個別編集</a></li>
        </ul>
      </li>
    </ul>
  </li>
  <li>
    <a href="{{route('backend.users.index')}}"><i class="fa fa-user" aria-hidden="true"></i>ユーザー管理 <i class="fa fa-angle-down" aria-hidden="true"></i></a> 
    <ul class="gn-submenu">
      <li class="mini_list_agile"><a href="{{route('backend.users.index')}}"><i class="fa fa-caret-right" aria-hidden="true"></i>ユーザーの一覧／新規登録／変更／削除</a></li>
    </ul>
  </li>
</ul>