<?php

use Livewire\Component;
use Livewire\Attributes\Layout;

new #[Layout('layouts.app')] class extends Component
{
    public $rate = 5;

    public string $testimoni='Testimoni';
    public string $kataMereka = 'Kata Mereka';

    public array $testimonials = [
        ['name' => 'Anisa P.', 'text' => '“Setelah 3 kali Lhala Peel, kulit jauh lebih cerah dan flek memudar. Dokternya sabar menjelaskan.”'],
        ['name' => 'Dewi R.', 'text' => '“Kliniknya bersih, mewah, dan nyaman. Skin booster bikin kulit glowing dan lembab banget!”'],
        ['name' => 'Maya S.', 'text' => '“Pelayanan ramah dari awal reservasi. Hasil laser terlihat natural, sangat recommended.”'],
        ['name' => 'Rina K.', 'text' => '“Konsultasinya detail dan tidak memaksa. Tekstur kulit jadi lebih halus setelah NCTF.”'],
    ];

    public ?int $t = 0;
    public int $setT = 0;

    public function nextTestimonial()
    {
        $this->t = ($this->t + 1) % count($this->testimonials);
        // $this->t = $this->t + 1;
    }

    public function prevTestimonial()
    {
        $this->t = ($this->t - 1 + count($this->testimonials)) % count($this->testimonials);
        // $this->t--;
        // $this->t = $this->t - 1;
    }

    public function setTestimonial($i){
        $this->t = $i;
    }
};
?>

<div>
    <section id="testimoni" class="py-24">
        <div class="mx-auto max-w-3xl px-6 text-center">
            <livewire:section-head :eyebrow="$testimoni" :title="$kataMereka" :center="true" />

            <div class="mt-12 animate-fade-in">
                <div class="flex justify-center gap-1">
                    @for($x = 1; $x <=5; $x++)
                        <livewire:star />
                    @endfor
                </div>
                <p class="mt-6 font-serif text-2xl italic leading-relaxed text-espreso">{{ $testimonials[$this->t]['text'] }}</p>
                <p class="mt-6 text-sm uppercase tracking-widest text-muted-foreground">{{ $testimonials[$this->t]['name'] }}</p>
            </div>
            <div class="mt-10 flex items-center justify-center gap-6">
                <button wire:click="prevTestimonial" aria-label="Sebelumnya" class="rounded-full border p-2 transition-colors hover:border-primary hover:text-primary">
                    <div class="h-4 w-4">
                        <x-icon name="chevron-left" />
                    </div>
                </button>
                <div class="flex gap-2">
                    @foreach($testimonials as $i => $testimonial)
                        <button wire:click="setTestimonial({{ $i }})" aria-label="Testimoni {{ $i + 1 }}" class="h-1.5 rounded-full transition-all {{ $i == $this->t ? "w-8 bg-primary" : "w-1.5 bg-border" }}"></button>
                    @endforeach
                </div>
                <button wire:click="nextTestimonial" wire:poll.5s="nextTestimonial" aria-label="Berikutnya" class="rounded-full border p-2 transition-colors hover:border-primary hover:text-primary">
                    <div class="h-4 w-4">
                        <x-icon name="chevron-right" />
                    </div>
                </button>            
            </div>
        </div>  
    </section>
</div>
