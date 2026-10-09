<?php

use Livewire\Component;

new class extends Component
{
    //
};
?>

<div>
    <footer id="kontak" class="bg-espresso text-primary-foreground">
        <div class="mx-auto grid max-w-7xl gap-12 px-6 py-20 md:grid-cols-3">
            <div>
                <p class="font-serif text-3xl tracking-[0.2em]">WED</p>
                <p class="text-[0.6rem] tracking-[0.4em] text-gold">AESTHETIC CLINIC</p>
                <p class="mt-6 max-w-xs text-sm font-light text-primary-foreground/70">Klinik estetika medis premium untuk kulit sehat dan berkilau alami.</p>
            </div>
            <div class="space-y-4 text-sm text-primary-foreground/80">
                <p class="eyebrow text-gold">Alamat</p>
                <p class="flex gap-3">
                    <x-icon name="map-pin" class="h-4 w-4 shrink-0 text-gold" />
                    {{-- <MapPin class="h-4 w-4 shrink-0 text-gold" /> --}}
                    Komplek Ruko JC.5, Jl. Ir. Soekarno, Dusun I, Madegondo, Kec. Grogol, Kabupaten Sukoharjo, Jawa Tengah 57552
                </p>

                <p class="flex gap-3">
                    <x-icon name="phone" class="h-4 w-4 shrink-0 text-gold" />
                    0851-8688-6066 · (0271) 6726066
                    <p class="flex gap-3">
                        {{-- <Instagram class="h-4 w-4 shrink-0 text-gold" />@wed.aestheticclinic --}}
                        <img src="{{asset('images/instagram.png')}}" alt="Instagram" class="h-4 w-4 fill-gold" />
                        @wed.aestheticclinic
                    </p>
                </p>
            </div>
            <div class="space-y-4 text-sm text-primary-foreground/80">
                <p class="eyebrow text-gold">Jam Operasional</p>
                <p class="flex gap-3">
                    <x-icon name="clock" class="h-4 w-4 shrink-0 text-gold" />
                    <span>Senin - Sabtu: 09.00 - 20.00 WIB<br />Minggu: 09.00 - 19.00 WIB</span>
                </p>
            </div>
        </div>
        <div class="border-t border-primary-foreground/10 py-6 text-center text-xs text-primary-foreground/50">© {{ date('Y') }} Wed Aesthetic Clinic. Hak cipta dilindungi.</div>
    </footer>    
</div>