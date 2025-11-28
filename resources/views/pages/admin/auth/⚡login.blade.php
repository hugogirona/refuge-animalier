<?php

use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('Connexion')]
class extends Component {
    //
};
?>
<div
    class="min-h-screen flex items-center justify-center px-4 py-12 bg-gradient-to-br from-primary-surface-default-subtle to-white">
    <div class="w-full max-w-md">
        <x-admin.login.auth-card/>
        <x-admin.login.login-info/>
    </div>
</div>
