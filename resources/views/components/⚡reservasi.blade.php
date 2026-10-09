<?php

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;

use App\Models\Service;
use App\Models\Customer;
use App\Models\Doctor;
use App\Models\Booking;

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

    #[Validate('required')]
    public int $doctor = 0;

    #[Validate('required')]
    public int $jnsLayanan = 0;

    #[Validate('required')]
    public string $tglLayanan = '';

    #[Validate('required')]
    public string $jamLayanan = '';


    public array $doctors = [];
    public array $services = [];

    public string $selectedStep = "1";

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
        $this->jamLayanan='09:00';
        $this->selectedStep = "1";
    }

    private function save(){
        $this->validate();

        // Check service quota
        $service = Service::find($this->jnsLayanan);
        $bookingsCount = Booking::where(['service_id' => $this->jnsLayanan, 'booking_date' => Carbon::now('Asia/Jakarta') ->toDateString()])->count();

        if($bookingsCount >= $service->daily_quotas){
            $this->dialog()->warning('Peringatan', 'Layanan ' . $service->name . ' sudah memenuhi kuota harian (' . $service->daily_quotas . ')')
                ->send();
            return false;
        }else{
            $newCustomer = Customer::create([
                'full_name' => $this->fullName,
                'phone' => '0' . $this->nomorWA,
                'address' => $this->alamat,

            ]);

            $newBooking = Booking::create([
                'customer_id' => $newCustomer->id,
                'service_id' => $this->jnsLayanan,
                'doctor_id' => $this->doctor,
                'booking_date' => Carbon::parse($this->tglLayanan, 'Asia/Jakarta')->toDate(),
                'booking_time' => $this->jamLayanan,
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

    }
};
?>

<div>
    <section id="reservasi" class="py-6">
        <div class="mx-auto max-w-2xl px-6">
            <livewire:section-head :$eyebrow :$title :center="true" />
            <div class="mt-12 rounded-2xl border bg-card p-4 shadow-soft md:p-8">
                <div class="my-4">
                    <x-step wire:model="selectedStep" panels navigate-previous helpers >
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
                </div>

                <x-errors title="Ops! There are :count validation errors" color="amber" />
            </div>
        </div>
    </section>
</div>
