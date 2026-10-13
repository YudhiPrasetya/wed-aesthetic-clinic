<?php

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Booking;
use App\Models\Doctor;
use TallStackUi\Traits\Interactions;
use Carbon\Carbon;

new #[Layout('layouts::doctor')] class extends Component
{
    use Interactions;

    public Booking $booking;

    public int $bookingId = 0;

    public string $customerName = '';
    public string $customerAddress = '';
    public string $customerPhone = '';

    public string $serviceName = '';
    public string $serviceDesc = '';
    public string $servicePrice = '';
    public string $bookingDate = '';
    public string $bookingTime='';

    public array $confirmationOptions = [];

    public string $confirmation = '';

    public function mount(int $id){
        $this->booking = Booking::with(['customer', 'service'])->find($id);
        $this->bookingId = $id;

        $this->customerName = $this->booking->customer->full_name;
        $this->customerAddress = $this->booking->customer->address;
        $this->customerPhone = $this->booking->customer->phone;

        $this->serviceName = $this->booking->service->name;
        $this->serviceDesc = $this->booking->service->description;
        $this->servicePrice = 'Rp. ' . number_format($this->booking->service->price, 0, ',', '.');
        $this->bookingDate = Carbon::parse($this->booking->booking_date, 'Asia/Jakarta')->format('d-m-Y');
        $this->bookingTime = $this->booking->booking_time;

        $this->confirmationOptions = [
            [
                'name' => 'Terima', 'id' => 'confirmed', 'description' => 'Menerima order ' . $this->serviceName . ', dari ' . $this->customerName,
                'aside' => 'harga ' . $this->servicePrice, 'icon' => 'check'
            ],
            [
                'name' => 'Batalkan', 'id' => 'cancelled', 'description' => 'Membatalkan order ' . $this->serviceName . ', dari ' . $this->customerName,
                'aside' => 'harga ' . $this->servicePrice, 'icon' => 'x-mark'
            ]
        ];

        // dump($this->confirmationOptions);

    }

    public function confirmationByDoctor(){
        // dump($this->confirmation);
        $userId = Auth()->user()->id;
        $doctor = Doctor::where('user_id', $userId)->first();

        $bookingUpdated = $this->booking->update(['id' => $this->bookingId, 'doctor_id' => $doctor->id, 'status' => $this->confirmation]);
        if($bookingUpdated){
            $tokenWA = env('FONNTE_TOKEN');
            $WAMessage =
            "------------WED Aesthetic Clinic---------------\n"
            . "----------------Order " . $this->confirmation . "---------------\n"
            . "```\n"
            . "Name         :" . $this->customerName . "\n"
            . "Address      :" . $this->customerAddress . "\n"
            . "Phone        :" . $this->customerPhone . "\n"
            . "Booking Date :" . Carbon::parse($this->booking->booking_date,'Asia/Jakarta')->toDateString() . "\n"
            . "Booking Time :" . $this->booking->booking_time . "\n"
            . "Service      :" . $this->serviceName . "\n"
            . "Service Desc :" . $this->serviceDesc . "\n"
            . "Price        :" . $this->servicePrice . "\n"
            . "Quantity     :" . "1" . "\n"
            . "Status       :" . $this->confirmation . "\n"
            . "```\n"
            . "-----------------------------------------------\n"
            . "order Anda telah di-" . ($this->confirmation == 'confirmed' ? 'Konfirmasi' : 'Batalkan') . "\n"
            . "Terima Kasih.";

            Http::withoutVerifying()->withHeaders([
                'Authorization' => $tokenWA
            ])->post('https://api.fonnte.com/send', [
                'target' => $this->customerPhone,
                'message' => $WAMessage
            ]);

            $this->toast()
                 ->timeout(1)
                 ->success('Success', 'Confirmation success')
                 ->position('top-center')
                 ->hook([
                    'timeout' => [
                        'method' => 'exit'
                    ]
                 ])->send();
        }
    }

    public function exit(){
        $this->redirect('/booking', true);
    }
};
?>

<div>
    <div class="flex gap-6 justify-center my-6">
        {{-- Info customer --}}
        <div class="w-1/3">
            <x-card>
                <x-slot:header>
                    <div class="text-xl font-bold">
                        Customer Info
                    </div>
                </x-slot:header>
                <div class="flex flex-col gap-4">
                    <x-input label="Nama" disabled wire:model="customerName" class="font-bold" />
                    <x-textarea label="Alamat" disabled wire:model="customerAddress" resize :rows="2" class="font-bold" />
                    <x-input label="Nomor WA" disabled wire:model="customerPhone" class="font-bold" />
                </div>
            </x-card>

        </div>

        <div class="w-2/3">
            <x-card>
                <x-slot:header>
                    <div class="text-xl font-bold">
                        Service Info
                    </div>
                </x-slot:header>
                    <div class="flex gap-4">
                        <div class="flex flex-col gap-4 w-1/2">
                            <x-input label="Layanan" disabled wire:model="serviceName" class="font-bold" />
                            <x-textarea label="Deskripsi" disabled wire:model="serviceDesc" resize :rows="2" class="font-bold"/>
                            <x-input label="Harga" disabled wire:model="servicePrice" class="font-bold" />
                        </div>
                        <div class="flex flex-col gap-4 w-1/2">
                            <x-input label="Tanggal booking" disabled wire:model="bookingDate" class="font-bold" />
                            <x-input label="Jam booking" disabled wire:model="bookingTime" class="font-bold" />
                        </div>
                    </div>
            </x-card>
        </div>

    </div>
    <x-radio.group xs wire:model="confirmation"
                   wire:change="confirmationByDoctor"
                   label="Konfirmasi"
                   :options="$confirmationOptions"
                   select="label:name|value:id"
                   color="green"
    />
    <div class="flex my-4">
        <x-button text="Back" icon="arrow-left" sm href="/booking" wire:navigate.hover color="orange" />
    </div>
</div>
