<?php

use Livewire\Component;
use Livewire\Attributes\Layout;

new #[Layout('layouts.app')] class extends Component
{
    //
};
?>

<div>
   <section id="tentang" class="bg-ivory py-24">
      <div class="mx-auto max-w-3xl px-6 text-center">
        <p class="eyebrow">Tentang Kami</p>
        <p class="mt-8 font-serif text-2xl leading-relaxed text-espresso md:text-3xl">
          “Kami percaya kecantikan sejati lahir dari rasa percaya diri. Setiap perawatan di Wed Aesthetic Clinic dirancang
          <em class="text-primary"> premium, aman, </em>dan selalu di bawah pengawasan dokter.”
        </p>
        <div class="mx-auto mt-10 h-px w-24 bg-gold-gradient" />
      </div>
    </section>
</div>
