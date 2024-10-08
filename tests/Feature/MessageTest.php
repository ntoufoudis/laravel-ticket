<?php

use App\Models\Message;

it('can create a message', function () {
    Message::factory()->create([
        'message' => 'Message body',
    ]);

    $this->assertDatabaseHas('messages', [
        'message' => 'Message body',
    ]);

    $this->assertEquals(1, Message::count());
});
