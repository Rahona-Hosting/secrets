<?php

namespace Rahona\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Rahona\Models\Secret;

class DeleteSecretContent implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(private readonly Secret $secret) {}

    public function handle(): void
    {
        $this->secret->forceFill(['data' => null])->save();
    }
}
