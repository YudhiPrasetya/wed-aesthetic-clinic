<?php

use Livewire\Component;
use Livewire\Attributes\Layout;

new #[Layout('layouts.app')] class extends Component
{
    public array $nav = [
        ['name' => 'Tentang', 'href' => '#tentang'],
        ['name' => 'Layanan', 'href' => '#layanan'],
        ['name' => 'Dokter', 'href' => '#dokter'],
        ['name' => 'Testimoni', 'href' => '#testimoni'],
        ['name' => 'Kontak', 'href' => '#kontak'],
        // ['name' => 'Login', 'href' => '/login'],
    ];

    public bool $openMenu = false;

    public function disableOpenMenu()
    {
        $this->openMenu = false;
    }
};
?>

<div class="sticky top-0 z-40 border-b bg-background/85 backdrop-blur">
    <header>
        <div class="mx-auto flex max-w-7xl grid-cols-[minmax(0, 1fr)_auto] items-center gap-4 sm:justify-between sm:flex sm:flex-wrap px-6 py-4">
            {{-- Logo --}}
            <div class="flex min-w-0 items-center">
                <a href="#" class="leading-none">
                    <span class="font-serif text-2xl tracking-[0.2em] text-espresso">
                        WED
                    </span>
                    <span class="block text-[0.55rem] tracking-[0.4em] text-primary">
                        AESTHETIC CLINIC
                    </span>
                </a>
            </div>

            {{-- Navigation --}}
            <nav class="hidden gap-9 text-sm text-muted-foreground md:flex">
                @foreach ($nav as $item)
                    <a href="{{ $item['href'] }}" class="transition-colors hover:text-primary">
                        {{ $item['name'] }}
                    </a>
                @endforeach

            </nav>

            <div class="flex shrink-0 items-center gap-2">
                <a wire:click="disableOpenMenu" href="#reservasi" class="hidden rounded-full border border-primary px-5 py-2 text-sm text-primary transition-colors hover:bg-primary hover:text-primary-foreground sm:block">
                    Reservasi
                </a>
                <a wire:click="disableOpenMenu" href="/login" class="hidden rounded-full border border-primary px-5 py-2 text-sm text-primary transition-colors hover:bg-primary hover:text-primary-foreground sm:block">
                    Login
                </a>
                <button
                    aria-label="{{ $openMenu ? "Tutup menu" : "Buka menu"}}"
                    aria-expanded="{{ $openMenu }}"
                    wire:click="$toggle('openMenu')"
                    class="rounded-full border p-2 text-espreso transition-colors hover:border-primary hover:text-primary md:hidden">
                    <x-icon name="{{ $openMenu ? 'x-mark' : 'bars-3' }}" class="h-5 w-5" />
                </button>
            </div>
        </div>
        @if($openMenu)
            <nav class="animate-fade-in border-t bg-background md:hidden">
                <div class="mx-auto flex max-w-7xl flex-col gap-1 px-6 py-4">
                    @foreach ($nav as $item)
                        <a wire:click="disableOpenMenu" href="{{ $item['href'] }}" class="rounded-lg px-3 py-3 text-base text-muted-foreground transition-colors hover:bg-ivory hover:text-primary">
                            {{ $item['name'] }}
                        </a>
                    @endforeach
                    <a wire:click="disableOpenMenu" href="#reservasi" class="mt-2 rounded-full bg-gold-gradient px-5 py-3 text-center text-sm font-medium text-primary-foreground shadow-soft">
                        Reservasi
                    </a>
                    <a wire:click="disableOpenMenu" href="/login" class="mt-2 rounded-full bg-gold-gradient px-5 py-3 text-center text-sm font-medium text-primary-foreground shadow-soft">
                        Login
                    </a>
                </div>
            </nav>
        @endif
    </header>

</div>
