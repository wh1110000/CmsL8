<?php

namespace wh1110000\CmsL8\Notifications;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Lang;

/**
 * Class NewPasswordNotification
 * @package Workhouse\Administrators\Notifications
 */

class NewPasswordNotification extends ResetPassword {

	/**
	 * Build the mail representation of the notification.
	 *
	 * @param  mixed  $notifiable
	 * @return \Illuminate\Notifications\Messages\MailMessage
	 */

	public function toMail($notifiable) {

		if (static::$toMailCallback) {

			return call_user_func(static::$toMailCallback, $notifiable, $this->token);
		}

		if (static::$createUrlCallback) {

			$url = call_user_func(static::$createUrlCallback, $notifiable, $this->token);

		} else {

			$url = url(route('admin.auth.password.reset', [
				'token' => $this->token,
				'email' => $notifiable->getEmailForPasswordReset(),
			], false));
		}

		return (new MailMessage)
			->subject(Lang::get('New Password Notification'))
			->line(Lang::get('You are receiving this email because we received a password reset request for your account.'))
			->action(Lang::get('Set New Password'), $url)
			->line(Lang::get('This password reset link will expire in :count minutes.', ['count' => config('auth.passwords.administrators.expire')]))
			->line(Lang::get('If you did not request a password reset, no further action is required.'));
	}
}
