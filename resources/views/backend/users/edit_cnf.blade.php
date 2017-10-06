@extends('backend.layouts.app')

@section('content')

<!-- CONTENTS -->
{!! Form::open(array('route' => ['backend.users.regist_cnf'], 'class' => 'form-horizontal', 'method' => 'post', 'enctype'=>'multipart/form-data', 'accept-charset'=>'utf-8')) !!}
<table width="960" border="0" align="center" cellpadding="5" cellspacing="0">
  <tbody>
	<tr>
	  <td width="150%" class="col_1">■敷島堂 Website 管理画面　＞　「ユーザー」管理　＞　確認を編集</td>
	</tr>
	<tr>
	  <td>&nbsp;</td>
	</tr>
	<tr>
	  <td><table width="100%" border="1" cellspacing="0" cellpadding="5">
		<tbody>
		  <tr>
			<td width="25%" class="col_3">ユーザー名 <span class="required">必須</span></td>
			<td>{{$user->u_name}}</td>
		  </tr>
		  <tr>
			<td width="25%" class="col_3">ログインID <span class="required">必須</span></td>
			<td>{{$user->u_login}}</td>
		  </tr>
		  <tr>
			<td width="25%" class="col_3">パスワード</td>
			<td><strong>******</strong></td>
		  </tr>
		  <tr>
			<td width="25%" class="col_3">有効／無効</td>
			<td> @if($user->u_flag == '') 有効 @else 無効 @endif </td>
		  </tr>
		</tbody>
	  </table></td>
	</tr>
	<tr>
	  <td align="center"><input type="button" id="btn-save" onClick="location.href='{{route('backend.users.edit_save', $u_id)}}'" value="保存する">
	  <input type="button" id="btn-back" onClick="location.href='{{route('backend.users.edit_back', $u_id)}}'" value="戻って修正する"></td>
	</tr>
	<tr>
	  <td align="center">&nbsp;</td>
	</tr>
	<tr>
	  <td>&nbsp;</td>
	</tr>
  </tbody>
</table>
{!! Form::close() !!}
<!-- /CONTENTS -->

@endsection