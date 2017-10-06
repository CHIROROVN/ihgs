@extends('backend.layouts.app')

@section('content')

<!-- CONTENTS -->
{!! Form::open(array('route' => ['backend.users.edit', $u_id], 'class' => 'form-horizontal', 'method' => 'post', 'enctype'=>'multipart/form-data', 'accept-charset'=>'utf-8')) !!}
<table width="960" border="0" align="center" cellpadding="5" cellspacing="0">
  <tbody>
	<tr>
	  <td width="150%" class="col_1">■敷島堂 Website 管理画面　＞　「ユーザー」管理　＞　変更</td>
	</tr>
	<tr>
	  <td>&nbsp;</td>
	</tr>
	<tr>
	  <td><table width="100%" border="1" cellspacing="0" cellpadding="5">
		<tbody>
		  <tr>
			<td width="25%" class="col_3">ユーザー名 <span class="required">必須</span></td>
			<td>
				<input name="u_name" type="text" id="u_name" size="40" value="@if(old('u_name')){{old('u_name')}}@else{{$user->u_name}}@endif">
				@if ($errors->first('u_name'))
				<div class="error-text"> {{$errors->first('u_name')}}</div>
				@endif
			</td>
		  </tr>
		  <tr>
			<td width="25%" class="col_3">ログインID <span class="required">必須</span></td>
			<td>
				<input name="u_login" type="text" id="u_login" value="@if(old('u_login')){{old('u_login')}}@else{{$user->u_login}}@endif">
				@if ($errors->first('u_login'))
				<div class="error-text"> {{$errors->first('u_login')}}</div>
				@endif
			</td>
		  </tr>
		  <tr>
			<td width="25%" class="col_3">パスワード</td>
			<td>
				<input name="u_passwd" type="password" id="u_passwd" value="{{old('u_passwd')}}">
				@if ($errors->first('u_passwd'))
				<div class="error-text"> {{$errors->first('u_passwd')}}</div>
				@endif
			</td>
		  </tr>
		  <tr>
			<td width="25%" class="col_3">有効／無効</td>
			<td><input type="checkbox" name="u_flag" id="u_flag" value="1" @if(old('u_flag') == 1 || $user->u_flag == 1) checked @endif>
			  一時的に無効にする</td>
		  </tr>
		</tbody>
	  </table></td>
	</tr>
	<tr>
	  <td align="center"><input type="submit" id="btn-submit" value="変更する">
	  <input type="reset" id="reset" value="クリア"></td>
	</tr>
	<tr>
	  <td align="center">&nbsp;</td>
	</tr>
	<tr>
	  <td align="center"><input type="button" onClick="location.href='{{route('backend.users.index')}}'" value="「ユーザー」一覧に戻る"></td>
	</tr>
	<tr>
	  <td>&nbsp;</td>
	</tr>
  </tbody>
</table>
{!! Form::close() !!}
<!-- /CONTENTS -->

@endsection