@extends('layouts.email')

@section('content')
	<tr>
		<td align="center" class="sm-px-24" style="font-family: 'Montserrat',Arial,sans-serif;">
		  <table style="font-family: 'Montserrat',Arial,sans-serif; width: 100%;" width="100%" cellpadding="0" cellspacing="0" role="presentation">
			<tr>
			  <td class="sm-px-24" style="--bg-opacity: 1; background-color: #ffffff; background-color: rgba(255, 255, 255, var(--bg-opacity)); border-radius: 4px; font-family: Montserrat, -apple-system, 'Segoe UI', sans-serif; font-size: 14px; line-height: 24px; padding: 48px; text-align: left; --text-opacity: 1; color: #626262; color: rgba(98, 98, 98, var(--text-opacity));" bgcolor="rgba(255, 255, 255, var(--bg-opacity))" align="left">
				<p style="font-weight: 600; font-size: 18px; margin-bottom: 0;">Dengan hormat,</p>
				<p style="margin: 24px 0;">
				  {!! str_replace('[[PERSON_NAME]]', $person->name, getSetting('registrasi_info_1')) !!}
				</p>
				<p style="margin: 24px 0;">
					{!! getSetting('registrasi_info_2') !!}
				  </p>
				<table style="font-family: 'Montserrat',Arial,sans-serif;" cellpadding="0" cellspacing="0" role="presentation">
				  <tr>
					<td style="mso-padding-alt: 16px 24px; --bg-opacity: 1; background-color: #7367f0; background-color: rgba(115, 103, 240, var(--bg-opacity)); border-radius: 4px; font-family: Montserrat, -apple-system, 'Segoe UI', sans-serif;" bgcolor="rgba(115, 103, 240, var(--bg-opacity))">
					  <a href="{{ url('account/register/'.$userid.'/'.$person->token) }}" target="_blank" style="display: block; font-weight: 600; font-size: 14px; line-height: 100%; padding: 16px 24px; --text-opacity: 1; color: #ffffff; color: rgba(255, 255, 255, var(--text-opacity)); text-decoration: none;">Register &rarr;</a>
					</td>
				  </tr>
				</table>
			
				<p style="margin: 0 0 16px;">
					{!! str_replace('[[COPY_LINK]]', url('account/register/'.$userid.'/'.$person->token), getSetting('registrasi_info_3')) !!}
				</p>
				<p style="margin: 0 0 16px;">
					{!! str_replace('[[CONTACT_LINK]]', getSetting('contact_link'), getSetting('registrasi_info_4')) !!}
				</p>
				<p style="margin: 0 0 16px;">Atas kerjasamanya kami ucapkan terimakasih., <br>{{ getSetting('sekretariat_dewan') }}</p>
			  </td>
			</tr>
			<tr>
			  <td style="font-family: 'Montserrat',Arial,sans-serif; height: 20px;" height="20"></td>
			</tr>
			<tr>
			  <td style="font-family: Montserrat, -apple-system, 'Segoe UI', sans-serif; font-size: 12px; padding-left: 48px; padding-right: 48px; --text-opacity: 1; color: #eceff1; color: rgba(236, 239, 241, var(--text-opacity));">
				<p style="--text-opacity: 1; color: #263238; color: rgba(38, 50, 56, var(--text-opacity));">
				  Use of our service and website is subject to our
				  <a href="{{ url('/') }}" class="hover-underline" style="--text-opacity: 1; color: #7367f0; color: rgba(115, 103, 240, var(--text-opacity)); text-decoration: none;">Terms of Use</a> and
				  <a href="{{ url('/') }}" class="hover-underline" style="--text-opacity: 1; color: #7367f0; color: rgba(115, 103, 240, var(--text-opacity)); text-decoration: none;">Privacy Policy</a>.
				</p>
			  </td>
			</tr>
			<tr>
			  <td style="font-family: 'Montserrat',Arial,sans-serif; height: 16px;" height="16"></td>
			</tr>
		  </table>
		</td>
	  </tr>
@endsection
