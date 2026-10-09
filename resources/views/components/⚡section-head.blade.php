<?php

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Reactive;

new #[Layout('layouts.app')] class extends Component
{
    #[Reactive]
    public bool $center = true;

    #[Reactive]
    public string $eyebrow = '';

    #[Reactive]
    public string $title = '';

    // public function mount(string $eyebrow, string $title, bool $center = true)
    // {
    //     $this->eyebrow = $eyebrow;
    //     $this->title = $title;
    //     $this->center = $center;
    // }

};
?>

<div>
    <div class="{{ $center ? 'mx-auto max-w-2xl text-center' : '' }}">
      <p class="eyebrow">{{ $eyebrow }}</p>
      <h2 class="mt-4 text-4xl text-espresso md:text-5xl">{{ $title }}</h2>
    </div>
</div>
