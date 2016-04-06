<?php
namespace StartupsCampfire\Jobs;

use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;
use StartupsCampfire\Models\User;
use Illuminate\Contracts\Mail\Mailer;

class SendNotificationEmail extends Job implements SelfHandling, ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $user;
    protected $data;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    public function __construct(User $user, $data)
    {
        $this->user = $user;
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Mailer $mailer)
    {
        $user = $this->user;
        $data = $this->data;
        $text = $data['email_body'];
        $mailer->send('common.emails.reminder', ['user'=>$user, 'text' => $text],function($message) use ($user, $data){
            $message->to($user->email)->subject($data['email_title']);
        });
    }
}