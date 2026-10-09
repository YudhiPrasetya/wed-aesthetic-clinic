<?php

use Livewire\Component;
use Livewire\Attributes\Layout;

use App\Models\Doctor;

new #[Layout('layouts.app')] class extends Component
{
    public string $timDokter = 'Tim Dokter Spesialis';
    public string $ahlinya = 'Ditangani Oleh Ahlinya';

    public array $doctors  = [];

    public function mount(){
        $this->doctors = Doctor::all()->toArray();
    }
};
?>

<div>
    <section id="dokter" class="bg-ivory py-24">
      <div class="mx-auto max-w-6xl px-6">
        <livewire:section-head :eyebrow="$timDokter" :title="$ahlinya" />
        <div class="mt-16 grid gap-10 md:grid-cols-3">
            @foreach($doctors as $d)
            <div key="{{ $d['full_name'] }}" class="group text-center">
              <div class="overflow-hidden rounded-t-full rounded-b-2xl">
                <img src="{{ asset('images/' . $d['image']) }}" alt="{{ $d['full_name'] }}" loading="lazy" width={768} height={960} class="aspect-[4/5] w-full object-cover transition-transform duration-700 group-hover:scale-105" />
              </div>
              <h3 class="mt-6 text-2xl text-espresso">{{ $d['full_name'] }}</h3>
              <p class="mt-1 text-sm text-muted-foreground">{{ $d['role'] }}</p>
              <span class="mt-3 inline-block rounded-full border border-primary/40 px-3 py-1 text-[0.7rem] uppercase tracking-widest text-primary">
                Sertifikasi Internasional
              </span>
            </div>
            @endforeach
        </div>
      </div>
    </section>
</div>
