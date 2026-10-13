<?php

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;

use App\Models\Service;
use App\Models\Customer;
use App\Models\Doctor;
use App\Models\Booking;
use App\Models\ServiceSchedule;

use Carbon\Carbon;

use TallStackUi\Traits\Interactions;

new #[Layout('layouts.app')] class extends Component
{
    use Interactions;

    public string $eyebrow = 'Reservase Online';
    public string $title = 'Jadwalkan Konsultasi Anda';

    #[Validate('required')]
    public string $fullName = '';

    #[Validate('required')]
    public string $alamat = '';

    #[Validate('required')]
    public string $nomorWA = '';

    public int $doctor = 0;

    #[Validate('required')]
    public int $jnsLayanan = 0;

    #[Validate('required')]
    public string $tglLayanan = '';

    public string $jamLayanan = '';

    public array $doctors = [];
    public array $services = [];

    public string $selectedStep = "1";

    public int $step = 1;
    public bool $done = false;
    public string $input = "w-full rounded-lg border bg-background px-4 py-3 text-sm outline-none transition focus:border-primary focus:ring-2 focus:ring-ring/20";
    public int $consultPrice = 100000;
    public array $serviceTimes = [];

    #[Validate('required')]
    public string $selectedTime = '';

    public bool $available = false;

    public function mount(){
        $this->services = Service::all()->toArray();
        $this->doctors = Doctor::all()->map(function ($item){
            return [
                'id' => $item->id,
                'full_name' => $item->full_name,
                'description' => $item->description,
                'image' => asset('images/' . $item->image)
            ];
        })->toArray();
        $this->selectedStep = "1";
    }

    public function saveReservasi(){
        if($this->save()){
            $this->done = true;
            $this->clearModel();
            $this->dialog()
            ->success('Sukses', 'Reservasi berhasil dikirim.')
            ->send();
        }
    }

    public function clearModel(){
        $this->fullName='';
        $this->alamat='';
        $this->nomorWA='';
        $this->jnsLayanan=0;
        $this->doctor=0;
        $this->tglLayanan='';
        // $this->jamLayanan='09:00';
        // $this->selectedStep = "1";
        $this->step = 1;
    }

    private function save(){
        $this->validate();

        $newCustomer = Customer::create([
            'full_name' => $this->fullName,
            'phone' => $this->nomorWA,
            'address' => $this->alamat,
        ]);

        $newBooking = Booking::create([
            'customer_id' => $newCustomer->id,
            'service_id' => $this->jnsLayanan,
            // 'doctor_id' => $this->doctor,
            'booking_date' => Carbon::parse($this->tglLayanan, 'Asia/Jakarta')->toDateString(),
            'booking_time' => $this->selectedTime,
            'status' => 'pending'
        ]);

        $tokenWA = env('FONNTE_TOKEN');
        $service = Service::find($newBooking->service_id);
        $WAMessage =
        "------------WED Aesthetic Clinic---------------\n"
        . "----------------*ORDER INVOICE*---------------\n"
        . "---------------*PENDING*-------------------\n"
        . "```\n"
        . "Name         :" . $newCustomer->full_name . "\n"
        . "Address      :" . $newCustomer->address . "\n"
        . "Phone        :" . $newCustomer->phone . "\n"
        . "Booking Date :" . Carbon::parse($newBooking->booking_date,'Asia/Jakarta')->toDateString() . "\n"
        . "Booking Time :" . $newBooking->booking_time . "\n"
        . "Service      :" . $service->name . "\n"
        . "Service Desc :" . $service->description . "\n"
        . "Price        :" . "Rp. " . $service->price . "\n"
        . "Quantity     :" . "1" . "\n"
        . "Status       :" . "Unpaid/Pending" . "\n"
        . "```\n"
        . "-----------------------------------------------\n"
        . "Segera lakukan pembayaran DP\n"
        . "minimal sebesar 50% dari harga(price)\n"
        . "layanan(service)\n"
        . "Terima Kasih.";

        Http::withoutVerifying()->withHeaders([
            'Authorization' => $tokenWA
        ])->post('https://api.fonnte.com/send', [
            'target' => $newCustomer->phone,
            'message' => $WAMessage
        ]);
        return $newBooking ? true : false;

    }

    public function changeServiceTime(){
        if($this->jnsLayanan != "" && $this->jnsLayanan !="0")
            $this->serviceTimes = ServiceSchedule::where('service_id', $this->jnsLayanan)->get()->toArray();
    }

    public function checkQuotaAndSetTime(string $t){
        $bookingsCount = Booking::where(['service_id' => $this->jnsLayanan,
                                                 'booking_date' => Carbon::parse($this->tglLayanan, 'Asia/Jakarta')->toDateString(),
                                                 'booking_time' => $t])->count();
        $quota = ServiceSchedule::where(['service_id' => $this->jnsLayanan, 'hours' => $t])->first();

        if($bookingsCount >= $quota->quota){
            $serviceName = Service::find($this->jnsLayanan)->name;
            $this->dialog()
                 ->warning(
                    'Peringatan',
                    'Layanan ' . $serviceName . ' untuk tanggal '
                    . Carbon::parse($this->tglLayanan)->format('d-m-Y') . ' jam ' . $this->jamLayanan . ' sudah memenuhi kuota!')->send();
            $this->available = false;
        }else{
            $this->dialog()->success('Tersedia', 'Kuota masih tersedia.')->send();
            $this->selectedTime = $t;
            $this->available = true;
        }
    }

    public function decreaseStep(){
        $this->step--;
    }

    public function increaseStep(){
        $this->step++;
    }
};
?>

<div>
    <section id="reservasi" class="py-6">
        <div class="mx-auto max-w-2xl px-6">
            <livewire:section-head :$eyebrow :$title :center="true" />
            <div class="mt-12 rounded-2xl border bg-card p-4 shadow-soft md:p-8">
                {{-- <div class="my-4">
                    <x-step wire:model="selectedStep" circles navigate-previous helpers >
                        <x-step.items step="1" title="Step 1" description="Identitas Pengunjung">
                            <div class="flex flex-col gap-6 my-6">
                                <x-input label="Nama Lengkap*" hint="Masukkan nama lengkap Anda" wire:model="fullName" />

                                <x-textarea label="Alamat*" hint="Masukkan alamat Anda" wire:model="alamat" />

                                <x-input label="Nomor WhatsApp*" hint="Masukkan nomor WhatsApp Anda" prefix="+62" wire:model="nomorWA" />
                            </div>

                        </x-step.items>

                        <x-step.items step="2" title="Step 2" description="Pilih Layanan">
                            <div class="flex flex-col gap-6">
                                <x-select.styled
                                    :options="$this->doctors"
                                    select="label:full_name|value:id|image:image"
                                    label="Silahkan pilih dokter*"
                                    hint="Dokter"
                                    searchable
                                    :placeholders="[
                                        'default' => 'Silahkan pilih dokter',
                                        'search' => 'Ketikkan dokter siapa yang Anda ingin cari',
                                        'empty' => 'Silahkan pilih dokter'
                                    ]"
                                    wire:model="doctor"
                                />
                                <x-select.styled
                                    :options="$this->services"
                                    select="label:name|value:id"
                                    label="Silahkan pilih layanan Anda*"
                                    hint="Layanan Anda"
                                    searchable
                                    :placeholders="[
                                        'default' => 'Silahkan pilih layanan Anda',
                                        'search' => 'Ketikkan layanan apa yang Anda ingin cari',
                                        'empty' => 'Silahkan pilih layanan Anda'
                                    ]"
                                    wire:model="jnsLayanan"
                                />
                            </div>

                        </x-step.items>

                        <x-step.items step="3" title="Step 3" description="Pilih Jadwal">
                            <div class="my-6 flex flex-col gap-4">
                                <x-date label="Tanggal kunjungan*" hint="Tentukan tanggal kunjungan Anda" wire:model="tglLayanan"/>
                                <x-time format="24" :min-hour="9" label="Jam kunjungan Anda*" hint="Tentukan jam kunjungan Anda." wire:model="jamLayanan" />
                                <x-button round="xl" spinner="wave" color="amber" wire:click="saveReservasi" loading="saveReservasi">Kirim jadwal reservasi</x-button>
                            </div>
                        </x-step.items>
                    </x-step>
                </div> --}}
                @if($this->done)
                    <div class="py-8 text-center animate-fade-in">
                        <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-gold-gradient text-primary-foreground"><Check /></div>
                        <h3 class="mt-6 text-2xl text-espresso">Terima kasih,{{ $this->fullName }}!</h3>
                        <p class="mt-2 text-sm text-muted-foreground">Tim kami akan mengonfirmasi jadwal Anda via WhatsApp.</p>
                    </div>
                @else
                    <div class="mb-8 flex items-center gap-3">
                        @for($x = 1; $x <= 3; $x++)
                            <div key={s} class="flex flex-1 items-center gap-3">
                                <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full text-xs {{ $this->step >= $x ? "bg-primary text-primary-foreground" : "border text-muted-foreground"}}" >{{ $x }}</span>
                                @if($x < 3)
                                    <span class="h-px flex-1 {{ $this->step > $x ? 'bg-primary' : 'bg-border' }}"></span>
                                @endif
                            </div>
                        @endfor
                    </div>
                    @if($this->step == 1)
                        <div class="space-y-5 animate-fade-in">
                            <label class="block text-sm">Nama Lengkap<input required class="{{ $this->input }} mt-2" wire:model="fullName" placeholder="Nama Anda" maxLength={80} /></label>
                            <label class="block text-sm">Alamat<textarea class="{{ $this->input }} mt-2" wire:model="alamat" placeholder="Alamat Anda" rows="2"></textarea></label>
                            <label class="block text-sm">Nomor WhatsApp<input required class="{{ $this->input }} mt-2" wire:model="nomorWA" placeholder="08xx xxxx xxxx" inputMode="tel" /></label>
                        </div>
                    @endif
                    @if($this->step == 2)
                        <div class="animate-fade-in">
                            <label class="block text-sm">Jenis Perawatan
                                <select required class="{{ $this->input }} mt-2" wire:model.live="jnsLayanan" wire:change="changeServiceTime">
                                    <option value="">Pilih perawatan</option>
                                    @foreach($this->services as $s)
                                        <option key={{ $s['id'] }} value="{{ $s['id'] }}">{{ $s['name'] }} — Mulai dari Rp {{ number_format($s['price'], 0, ",", ".") }}</option>
                                    @endforeach
                                    <option value="0">Konsultasi Umum — Mulai dari Rp. {{ number_format($this->consultPrice, 0, ",", ".") }}</option>
                                </select>
                            </label>
                            <p class="mt-3 text-xs text-muted-foreground">Harga akhir ditentukan dokter setelah konsultasi.</p>
                        </div>
                    @endif
                    @if($this->step == 3)
                        <div class="space-y-5 animate-fade-in">
                            <label class="block text-sm">Tanggal Kunjungan<input required type="date" class="{{ $this->input }} mt-2" wire:model="tglLayanan"  /></label>
                            <div class="text-sm">Waktu Kunjungan
                                <div class="mt-2 grid grid-cols-3 gap-2">
                                    @foreach($this->serviceTimes as $sT)
                                        <button key="{{ $sT['id'] }}" type="button" wire:click="checkQuotaAndSetTime('{{ $sT['hours'] }}')" class="rounded-lg border py-2.5 text-sm transition {{ $this->selectedTime == $sT['hours'] && $this->available ? "border-primary bg-primary text-primary-foreground" : "hover:border-primary" }}">{{ $sT['hours'] }}</button>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="my-4">
                            <x-errors />
                        </div>
                    @endif
                    <div class="mt-8 flex justify-between gap-4">
                        @if($this->step > 1)
                            <button class="text-sm text-muted-foreground hover:text-primary" wire:click="decreaseStep">← Kembali</button>
                        @endif
                        @if($this->step < 3)
                            <button class="rounded-full bg-primary px-7 py-3 text-sm text-primary-foreground transition disabled:opacity-40" wire:click="increaseStep">Lanjut</button>
                        @else
                            <button wire:click="saveReservasi" class="rounded-full bg-gold-gradient px-7 py-3 text-sm font-medium text-primary-foreground shadow-soft transition disabled:opacity-40">Kirim Jadwal Konsultasi</button>
                        @endif
                    </div>
                @endif

                {{-- <x-errors title="Ops! There are :count validation errors" color="amber" /> --}}
            </div>
        </div>
    </section>
</div>
