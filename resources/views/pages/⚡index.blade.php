<?php

use Livewire\Component;
use Livewire\Attributes\Layout;

new #[Layout('layouts.app')]class extends Component
{

};
?>

<div class="min-h-screen">
    <livewire:header />
    <livewire:hero />
    <livewire:about />
    <livewire:treatments />
    <livewire:doctors />
    <livewire:testimonials />
    <livewire:before-after />
    <livewire:reservasi />
    <livewire:footer />
</div>
