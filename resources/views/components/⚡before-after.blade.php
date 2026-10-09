<?php

use Livewire\Component;
use Livewire\Attributes\Layout;

new #[Layout('layouts.app')] class extends Component
{
    public string $hasilNyata='Hasil Nyata';
    public string $sebelumSesudah = 'Sebelum & Sesudah';

    public int $pos = 50;

    public function changePos(){
        $this->pos++;
    }

};
?>

<div>
    <section class="bg-ivory py-24">
        <div class="mx-auto grid max-w-6xl items-center gap-14 px-6 lg:grid-cols-2">
            <div>
                <livewire:section-head :eyebrow="$hasilNyata" :title="$sebelumSesudah" :center="false" />
                <p class="mt-6 text-muted-foreground">
                    Geser untuk melihat perubahan setelah rangkaian perawatan Lhala Peel dan Skin Booster selama 6 minggu.
                </p>
                <p class="mt-4 text-xs text-muted-foreground">*Hasil dapat berbeda pada setiap individu.</p>
            </div>
            <div class="relative aspect-square select-none overflow-hidden rounded-2xl shadow-soft">
                <img src={{ asset('images/after.jpg') }} alt="Sesudah perawatan" class="absolute inset-0 h-full w-full object-cover" />
                <img src={{ asset('images/before.jpg') }} alt="Sebelum perawatan" class="absolute inset-0 h-full w-full object-cover" style="clip-path: inset(0 {{ 100 -  $pos }}% 0 0);"  />
                <div class="pointer-events-none absolute inset-y-0 w-0.5 bg-card" style="left: {{ $pos }}%;">
                    <div class="absolute top-1/2 left-1/2 flex h-10 w-10 -translate-x-1/2 -translate-y-1/2 items-center justify-center rounded-full bg-card text-primary shadow-soft">⇆</div>
                </div>
                <span class="absolute left-4 top-4 rounded-full bg-card/90 px-3 py-1 text-xs uppercase tracking-widest">Sebelum</span>
                <span class="absolute right-4 top-4 rounded-full bg-card/90 px-3 py-1 text-xs uppercase tracking-widest">Sesudah</span>
                {{-- <input type="range" min={0} max={100} value={pos} onChange={(e) => setPos(+e.target.value)} aria-label="Geser perbandingan" class="absolute inset-0 h-full w-full cursor-ew-resize opacity-0" /> --}}
                <input type="range" min="0" max="100" wire:model.live="pos" value="{{ $pos }}" wire:change="changePos" aria-label="Geser perbandingan" class="absolute inset-0 h-full w-full cursor-ew-resize opacity-0" />
            </div>
        </div>
    </section>
</div>
