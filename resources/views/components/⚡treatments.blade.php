<?php

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Service;

new #[Layout('layouts.app')] class extends Component
{
    public string $layananUnggulan = 'Layanan Unggulan';
    public string $perawatanPilihan = 'Perawatan Pilihan Kami';

    public array $treatments = [];
    public int $no = 1;

    public function mount(){
        $this->treatments = Service::all()->toArray();
    }
};
?>

<div>
    <section id="layanan" class="py-24">
      <div class="mx-auto max-w-7xl px-6">
        <livewire:section-head :eyebrow="$layananUnggulan" :title="$perawatanPilihan" />
        {{-- <div class="mx-auto max-w-2xl text-center">
            <p>Layanan Unggulan</p>
            <h2 class="mt-4 text-4xl text-espresso md:text-5xl">Perawatan Pilihan Kami</h2>
        </div> --}}

        <div class="mt-16 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
          @foreach ($treatments as $t)
            @php
                $strNo = '0' . (string)$this->no;
            @endphp
            <div class="group relative flex min-h-80 flex-col justify-between overflow-hidden rounded-2xl border bg-card p-8 transition-all duration-500 hover:-translate-y-2 hover:border-primary hover:shadow-soft">
              <div class="absolute inset-0 bg-gold-gradient opacity-0 transition-opacity duration-500 group-hover:opacity-100"></div>
              <span class="relative font-serif text-5xl text-primary/40 transition-colors group-hover:text-primary-foreground/60">{{ $strNo }}</span>
              <div class="relative">
                <h3 class="text-2xl text-espresso transition-colors group-hover:text-primary-foreground">{{ $t['name'] }}</h3>
                <p class="mt-3 text-sm text-muted-foreground transition-colors group-hover:text-primary-foreground/90">{{ $t['description'] }}</p>
                <a href="#reservasi" class="mt-6 inline-block text-xs uppercase tracking-widest text-primary transition-colors group-hover:text-primary-foreground">
                  Reservasi →
                </a>
              </div>
            </div>
            @php
                $this->no++;
            @endphp
          @endforeach
        </div>
      </div>
    </section>
</div>
