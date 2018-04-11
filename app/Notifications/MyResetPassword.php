<?php

namespace SistemaLaOax\Notifications;


use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;
 
class MyResetPassword extends ResetPassword
{
    public function toMail($notifiable)
    {
        return (new MailMessage)
            //->line('You are receiving this email because we received a password reset request for your account.')
        	->subject('Recuperar contraseña')
        	->greeting('Hola')
        	->line('Usted está recibiendo este correo porque recibimos una petición de restablecimiento de contraseña para su cuenta.')
            ->action('Restablecer contraseña', route('password.reset', $this->token))
            ->line('Si usted no solicito una petición de restablecimiento de contraseña, no se requiere ninguna acción adicional, solo omita este correo.')
            ->salutation('Saludos, '. config('app.name'));
    }
}
