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
                    {{-- <x-icon name="map-pin" class="h-4 w-4 shrink-0 text-gold" /> --}}
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                         fill="none" stroke="currentColor"
                         stroke-width="2"
                         stroke-linecap="round"
                         stroke-linejoin="round"
                         class="lucide lucide-map-pin h-4 w-4 shrink-0 text-gold" aria-hidden="true">
                            <path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0"></path>
                            <circle cx="12" cy="10" r="3"></circle>
                    </svg>
                    {{-- <MapPin class="h-4 w-4 shrink-0 text-gold" /> --}}
                    Komplek Ruko JC.5, Jl. Ir. Soekarno, Dusun I, Madegondo, Kec. Grogol, Kabupaten Sukoharjo, Jawa Tengah 57552
                </p>

                <p class="flex gap-3">
                    {{-- <x-icon name="phone" class="h-4 w-4 shrink-0 text-gold" /> --}}
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor"
                         stroke-width="2"
                         stroke-linecap="round"
                         stroke-linejoin="round"
                         class="lucide lucide-phone h-4 w-4 shrink-0 text-gold"
                         aria-hidden="true">
                            <path d="M13.832 16.568a1 1 0 0 0 1.213-.303l.355-.465A2 2 0 0 1 17 15h3a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2A18 18 0 0 1 2 4a2 2 0 0 1 2-2h3a2 2 0 0 1 2 2v3a2 2 0 0 1-.8 1.6l-.468.351a1 1 0 0 0-.292 1.233 14 14 0 0 0 6.392 6.384"></path>
                    </svg>
                    0851-8688-6066 · (0271) 6726066
                    <p class="flex gap-3">
                        {{-- <Instagram class="h-4 w-4 shrink-0 text-gold" />@wed.aestheticclinic --}}
                        {{-- <img src="{{asset('images/instagram.png')}}" alt="Instagram" class="h-4 w-4 fill-gold" /> --}}
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                             stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-instagram h-4 w-4 shrink-0 text-gold"
                             aria-hidden="true">
                                <rect width="20" height="20" x="2" y="2" rx="5" ry="5"></rect>
                                <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                                <line x1="17.5" x2="17.51" y1="6.5" y2="6.5"></line>
                        </svg>
                        @wed.aestheticclinic
                    </p>
                </p>
            </div>
            <div class="space-y-4 text-sm text-primary-foreground/80">
                <p class="eyebrow text-gold">Jam Operasional</p>
                <p class="flex gap-3">
                    {{-- <x-icon name="clock" class="h-4 w-4 shrink-0 text-gold" /> --}}
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-clock h-4 w-4 shrink-0 text-gold"
                        aria-hidden="true">
                            <circle cx="12" cy="12" r="10"></circle>
                            <path d="M12 6v6l4 2"></path>
                    </svg>
                    <span>Senin - Sabtu: 09.00 - 20.00 WIB<br />Minggu: 09.00 - 19.00 WIB</span>
                </p>
            </div>
        </div>
        <div class="border-t border-primary-foreground/10 py-6 text-center text-xs text-primary-foreground/50">© {{ date('Y') }} Wed Aesthetic Clinic. Hak cipta dilindungi.</div>
    </footer>
</div>
