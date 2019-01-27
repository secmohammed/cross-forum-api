<?php

namespace App\Forum\Domain\Observers;

use App\Forum\Domain\Models\Section;
use Illuminate\Support\Str;

class SectionObserver
{
    /**
     * Handle the section "created" event.
     *
     * @param  \App\App\Forum\Domain\Models\Section  $section
     * @return void
     */
    public function creating(Section $section)
    {
        $section->slug = Str::uuid();
    }

    /**
     * Handle the section "updated" event.
     *
     * @param  \App\App\Forum\Domain\Models\Section  $section
     * @return void
     */
    public function updated(Section $section)
    {
        //
    }

    /**
     * Handle the section "deleted" event.
     *
     * @param  \App\App\Forum\Domain\Models\Section  $section
     * @return void
     */
    public function deleted(Section $section)
    {
        //
    }

    /**
     * Handle the section "restored" event.
     *
     * @param  \App\App\Forum\Domain\Models\Section  $section
     * @return void
     */
    public function restored(Section $section)
    {
        //
    }

    /**
     * Handle the section "force deleted" event.
     *
     * @param  \App\App\Forum\Domain\Models\Section  $section
     * @return void
     */
    public function forceDeleted(Section $section)
    {
        //
    }
}
