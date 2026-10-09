<?php

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Lazy;
use App\Models\Customer;
use App\Models\Doctor;
use App\Models\Service;

use Carbon\Carbon;

new #[Layout('layouts::doctor')] #[Lazy] class extends Component
{
    use WithPagination;

    public int $userId = 0;
    public array $bookings = [];

    public function mount(){
        $this->userId = Auth::user()->id;
        // $this->userId = 1;
        $this->getBookings();
    }

    public function getBookings(){
        $customers = Customer::all();
        $services = Service::all();
        // $doctors = Doctor::all();

        Doctor::with(['bookings' => function($query){
            $b = $query->where('booking_date','=', Carbon::now('Asia/Jakarta')->toDateString())->get();
            // dump($b);
        }])->select('id', 'user_id')->where('user_id', $this->userId)->get()->map(function($item) use($customers, $services){
            // dump($item);
            $arrBookings = $item->bookings->toArray();
            foreach($arrBookings as $booking){
                $id = $booking['id'];
                $service = $services->find($booking['service_id']);
                $customer = $customers->find($booking['customer_id']);
                $booking_date = $booking['booking_date'];
                $booking_time = $booking['booking_time'];
                $data = [
                    'id' => $id,
                    'customer' => $customer->full_name,
                    'service' => $service->name,
                    'doctor' => $item->full_name,
                    'booking_date' => $booking_date,
                    'booking_time' => $booking_time
                ];
                $this->bookings[] = $data;
            }
        });
        // dump($bookings);
        // return $bookings;
    }

    public array $headers = [
        ['index' => 'id', 'label' => '#'],
        ['index' => 'customer', 'label' => 'Customer'],
        // ['index' => 'customer_id', 'label' => 'Customer'],
        ['index' => 'doctor', 'label' => 'Doctor'],
        // ['index' => 'doctor_id', 'label' => 'Doctor'],
        ['index' => 'service', 'label' => 'Service/Treatment'],
        // ['index' => 'service_id', 'label' => 'Service/-Treatment'],
        ['index' => 'booking_date', 'label' => 'Booking Date'],
        ['index' => 'booking_time', 'label' => 'Booking Time'],
        ['index' => 'action'],
    ];

    public function with(){
        return[
            $this->headers,
            'rows' => $this->bookings
        ];
    }

    public function placeholder(): string{
        return <<<'HTML'
        <div>
            <x-table :$headers skeleton="10" />
        </div>
        HTML;
    }

};
?>

<div>
    <x-table :$headers :$rows striped loading>
        @interact('column_action', $row)
            <x-button href="/booking/{{ $row['id'] }}/edit" icon="pencil" wire:navigate.hover md flat primary />
        @endinteract
    </x-table>
</div>
