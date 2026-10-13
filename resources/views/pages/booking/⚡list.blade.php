<?php

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Lazy;
use Livewire\Attributes\Computed;
use App\Models\Customer;
use App\Models\Doctor;
use App\Models\Service;
use App\Models\Booking;

use Carbon\Carbon;

new #[Layout('layouts::doctor')] #[Lazy] class extends Component
{
    use WithPagination;

    #[Computed]
    public function getBookings(){
        // $customers = Customer::all();
        // $services = Service::all();
        // $doctors = Doctor::all();

        // Doctor::with(['bookings' => function($query){
        //     // $b = $query->where('booking_date','=', Carbon::now('Asia/Jakarta')->toDateString())->get();
        //     $query->where('status','pending')->get();
        //     // dump($b);
        // // }])->select('id', 'user_id')->where('user_id', $this->userId)->get()->map(function($item) use($customers, $services){
        // }])->get()->map(function($item) use($customers, $services){
        //     dump($item);
        //     $arrBookings = $item->bookings->toArray();
        //     foreach($arrBookings as $booking){
        //         $id = $booking['id'];
        //         $service = $services->find($booking['service_id']);
        //         $customer = $customers->find($booking['customer_id']);
        //         $booking_date = $booking['booking_date'];
        //         $booking_time = $booking['booking_time'];
        //         $data = [
        //             'id' => $id,
        //             'customer' => $customer->full_name,
        //             'service' => $service->name,
        //             // 'doctor' => $item->full_name,
        //             'booking_date' => $booking_date,
        //             'booking_time' => $booking_time
        //         ];
        //         $this->bookings[] = $data;
        //     }
        // });
        // dump($bookings);
        // return $bookings;

        return Booking::with(['customer:id,full_name', 'service:id,name', 'doctor:id,full_name'])->paginate(5)->withQueryString();
    }

    public array $headers = [
        ['index' => 'id', 'label' => '#'],
        ['index' => 'customer.full_name', 'label' => 'Customer'],
        // ['index' => 'customer_id', 'label' => 'Customer'],
        ['index' => 'doctor.full_name', 'label' => 'Doctor'],
        // ['index' => 'doctor_id', 'label' => 'Doctor'],
        ['index' => 'service.name', 'label' => 'Service/Treatment'],
        // ['index' => 'service_id', 'label' => 'Service/-Treatment'],
        ['index' => 'booking_date', 'label' => 'Booking Date'],
        ['index' => 'booking_time', 'label' => 'Booking Time'],
        ['index' => 'status', 'label' => 'Status'],
        ['index' => 'action'],
    ];

    public function with(){
        return[
            $this->headers,
            'rows' => $this->getBookings()
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
    <div class="my-6">
        <x-table :$headers :$rows striped loading paginate>
            @interact('column_doctor.full_name', $row)
                {{ $row->doctor->full_name ?? "-"}}
            @endinteract

            @interact('column_booking_date', $row)
                {{Carbon::parse($row->booking_date)->format('d-m-Y')}}
            @endinteract

            @interact('column_action', $row)
                @if($row->status == 'pending')
                    <x-button href="{{ route('Booking-edit', [$row->id]) }}" wire:navigate.hover icon="check" color="green" md text="Confirmation" />
                @endif
            @endinteract
        </x-table>
    </div>

    <x-button href="/logout" wire:navigate.hover color="primary" text="Back to website" icon="home" />
</div>
