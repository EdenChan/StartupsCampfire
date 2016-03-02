<?php
namespace StartupsCampfire\Jobs;

use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;
use StartupsCampfire\Models\User;
use Illuminate\Contracts\Mail\Mailer;

class SendReminderEmail extends Job implements SelfHandling, ShouldQueue
{

    use InteractsWithQueue, SerializesModels;
    protected $user;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Mailer $mailer)
    {
        $user = $this->user;
        $text = '<a href="http://www.golaravel.com/">Laravel For Web Artisan</a>';
        $mailer->send('common.emails.reminder', ['user'=>$user, 'text' => $text],function($message) use ($user){
            $message->to($user->email)->subject('测试队列邮件');
        });
    }
}