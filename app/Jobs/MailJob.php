<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Snowfire\Beautymail\Beautymail;

class MailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var string
     */
    private string $name;
    /**
     * @var string
     */
    private string $email;
    /**
     * @var string
     */
    private string $subject;
    /**
     * @var string
     */
    private string $body;
    /**
     * @var bool
     */
    private bool $show_btn;
    /**
     * @var string|null
     */
    private ?string $url;
    /**
     * @var string|null
     */
    private ?string $btn_name;

    /**
     * Create a new job instance.
     *
     * @param string $name
     * @param string $email
     * @param string $subject
     * @param string $body
     * @param bool $show_btn
     * @param string|null $url
     * @param string|null $btn_name
     */
    public function __construct(string $name, string $email, string $subject, string $body, bool $show_btn = false, string $url = null, string $btn_name = null)
    {
        $this->name = $name;
        $this->email = $email;
        $this->subject = $subject;
        $this->body = $body;
        $this->show_btn = $show_btn;
        $this->url = $url;
        $this->btn_name = $btn_name;
    }

    /**
     * Execute the job.
     *
     * @return void
     * @throws BindingResolutionException
     */
    public function handle()
    {
        $beautymail = app()->make(Beautymail::class);
        $beautymail->send('emails.mail', [
            'subject' => $this->subject,
            'name' => $this->name,
            'body' => $this->body,
            'show_btn' => $this->show_btn,
            'url' => $this->url,
            'btn_name' => $this->btn_name,
        ], function ($message) {
            $message
                ->from(env('MAIL_USERNAME'))
                ->to($this->email, $this->name)
                ->subject($this->subject);
        });
    }
}
