@extends('backend.layouts.app')

@section('content')

<!-- CONTENTS -->
<table width="960" border="0" align="center" cellpadding="5" cellspacing="0">
  <tbody>
    <tr>
      <td width="150%" class="col_1">■敷島堂 Website 管理画面　＞　「ユーザー」管理　＞　一覧</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    @if($message = Session::get('danger'))
    <tr>
      <td>
      <div id="error" class="message">
        <a id="close" title="Message"  href="#" onClick="document.getElementById('error').setAttribute('style','display: none;');">&times;</a>
        <span>{{$message}}</span>
      </div>
      </td>
    </tr>
    @elseif($message = Session::get('success'))
    <tr>
      <td>
      <div id="success" class="message">
        <a id="close" title="Message"  href="javascript::void(0);" onClick="document.getElementById('success').setAttribute('style','display: none;');">&times;</a>
        <span>{{$message}}</span>
      </div>
      </td>
    </tr>
    @endif
    <tr>
      <td align="right"><input type="button" onClick="location.href='{{route('backend.users.regist')}}'" value="新規登録"></td>
    </tr>
    <tr>
      <td><table width="100%" border="1" cellspacing="0" cellpadding="5">
        <tbody>
          <tr class="col_3">
            <td width="1%" align="center">削除</td>
            <td width="6%" align="center">有効</td>
            <td align="center">ユーザー名</td>
            <td align="center">ログインID</td>
            <td width="1%" align="center">詳細・変更</td>
          </tr>
          @if(count($users) > 0)
          @foreach($users as $user)
          <tr>
            <td>
            	<input type="button" onClick="location.href='{{route('backend.users.delete', $user->u_id)}}'" value="削除">
            </td>
            <td align="center">
            	@if($user->u_flag == 1)
            	<span class="f_red">×</span>
            	@else
            	<span class="f_blue">○</span>
            	@endif
            </td>
            <td>{{$user->u_name}}</td>
            <td class="f_eng">{{$user->u_login}}</td>
            <td>
            	<input type="button" onClick="location.href='{{route('backend.users.detail', $user->u_id)}}'" value="詳細・変更">
            </td>
          </tr>
          @endforeach

          </tr>
          @else

          @endif
        </tbody>
      </table>
	  </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
  </tbody>
</table>
<!-- /CONTENTS -->


@endsection