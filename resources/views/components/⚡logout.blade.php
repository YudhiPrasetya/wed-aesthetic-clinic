<?php

use Livewire\Component;
use TallStackUi\Traits\Interactions;

new class extends Component
{
    use Interactions;

    public function mount(){
        $this->dialog()
        ->question('Confirmation', 'Are you sure want to logout?')
        ->confirm('Yes', 'logout')
        ->cancel('No')
        ->send();
    }

    public function logout(){
        Auth::logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return $this->redirect('/', navigate: true);
    }
};
?>

<div>

</div>
