<?php

namespace App\Listeners;

use App\Events\BookViewed;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Session\Store;

class ViewCounted
{
    private $session;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Store $session)
    {
        $this->session = $session;
    }

    /**
     * Handle the event.
     *
     * @param  BookViewed  $event
     * @return void
     */
    public function handle(BookViewed $event)
    {
        if (!$this->isBookViewed($event->book))
        {
            $event->book->increment('view_count');
            $this->storeBook($event->book);
        }
    }

    private function isBookViewed($book)
    {
        $viewed = $this->session->get('viewed_books', []);

        return array_key_exists($book->id, $viewed);
    }

    private function storeBook($book)
    {
        $key = 'viewed_books.' . $book->id;

        $this->session->put($key, time());
    }
}
