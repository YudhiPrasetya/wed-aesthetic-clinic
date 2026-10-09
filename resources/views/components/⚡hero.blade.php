<?php

use Livewire\Component;
use Livewire\Attributes\Layout;

new #[Layout('layouts.app')] class extends Component
{
    public array $ratings = [
        ['n' => '3+', 'l' => 'Dokter Ahli'],
        ['n' => '5.000+', 'l' => 'Klien Puas'],
        ['n' => '4.9', 'l' => 'Rating Google'],
    ];
};
?>

<div>
    <section class="relative">
      <div class="mx-auto grid max-w-7xl items-center gap-12 px-6 py-16 lg:grid-cols-12 lg:py-24">
        <div class="lg:col-span-5 animate-fade-in">
          <p class="eyebrow">Klinik Estetika Medis</p>
          <h1 class="mt-6 text-5xl leading-[1.08] text-espresso md:text-6xl">
            Sambut Kulit Sehat <em class="text-primary">Berkilau Alami</em> Bersama Kami
          </h1>
          <p class="mt-6 max-w-md text-lg font-light text-muted-foreground">
            Klinik estetika medis terpercaya dengan teknologi mutakhir dan tim dokter ahli.
          </p>
          <a href="#reservasi" class="mt-10 inline-flex items-center gap-3 rounded-full bg-gold-gradient px-8 py-4 text-sm font-medium tracking-wide text-primary-foreground shadow-soft transition-transform hover:-translate-y-0.5">
            Reservasi Jadwal Dokter
          </a>
          <div class="mt-12 flex gap-10 border-t pt-8">
            @foreach ($ratings as $rating)
              <div>
                <p class="font-serif text-3xl text-espresso">{{ $rating['n'] }}</p>
                <p class="mt-1 text-xs uppercase tracking-widest text-muted-foreground">{{ $rating['l'] }}</p>
              </div>
            @endforeach
          </div>
        </div>
        <div class="relative lg:col-span-7">
          <div class="overflow-hidden rounded-t-[12rem] rounded-b-2xl shadow-soft">
            <img src="/images/hero.jpg" alt="Interior mewah Wed Aesthetic Clinic" width={1600} height={1008} class="h-[520px] w-full object-cover lg:h-[620px]" />
          </div>
          <div class="absolute -bottom-6 left-6 flex items-center gap-3 rounded-xl bg-card px-5 py-4 shadow-soft">
            {{-- <Sparkles class="h-5 w-5 text-primary" /> --}}
            <x-icon name="sparkles" class="h-5 w-5 text-primary" />
            <div>
              <p class="text-sm font-medium">Diawasi Dokter</p>
              <p class="text-xs text-muted-foreground">Aman & bersertifikat</p>
            </div>
          </div>
        </div>
      </div>
    </section>
</div>
