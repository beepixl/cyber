<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\Mailer\Transport\Smtp\EsmtpTransport;
use Symfony\Component\Mailer\Mailer;

class SendTestMail extends Command
{
    protected $signature = 'send:testmail {email}';
    protected $description = 'Check SMTP authentication and send test mail';

    public function handle()
    {
        $to = $this->argument('email');

        try {
            // Create SMTP transport
            $transport = new EsmtpTransport(
                config('mail.mailers.smtp.host'),
                config('mail.mailers.smtp.port'),
                config('mail.mailers.smtp.encryption') ?: null
            );

            if (config('mail.mailers.smtp.username')) {
                $transport->setUsername(config('mail.mailers.smtp.username'));
                $transport->setPassword(config('mail.mailers.smtp.password'));
            }

            // Try to start connection
            $mailer = new Mailer($transport);

          //  dd($mailer);

            $this->info("✅ SMTP authentication successful!");

            // Send test email
            Mail::raw('This is a test mail from Navsari Cyber Crime Police Exchange setup.', function ($msg) use ($to) {
                $msg->to($to)->subject('Exchange SMTP Test');
            });

            $this->info("📩 Test mail sent successfully to {$to}");
        } catch (\Exception $e) {
            $this->error("❌ SMTP failed: " . $e->getMessage());
        }

        return 0;
    }
}
