<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Mail\CreateEvent;
use Illuminate\Support\Facades\Mail;

class CreateEventEmail extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */

    public function createEvent()
    {
        Mail::fake();
        Mail::send(new CreateEvent());
        Mail::assertSent(CreateEvent::class);
        Mail::assertSent(CreateEvent::class, function ($mail) {
            $mail->build();
            $this->assertTrue($mail->hasFrom('hello@mailtrap.io'));
            $this->assertTrue($mail->hasCc('hola@mailtrap.io'));
            return true;
        });
    }
}
