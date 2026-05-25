<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Livewire\Volt\Component;
use Livewire\Attributes\Layout;

new #[Layout('components.layouts.auth')] class extends Component {
    public string $email = '';
    public string $password = '';

    public function login()
    {
        // 1. Validar los datos de entrada
        $credentials = $this->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        // 2. Intentar autenticar al usuario
        if (! Auth::attempt($credentials)) {
            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }

        // 3. Regenerar la sesión por seguridad
        session()->regenerate();

        // 4. Redirigir al dashboard
        return redirect()->intended(route('dashboard', absolute: false));
    }
};
?>

<div class="min-h-screen flex items-center justify-center bg-gray-950 relative overflow-hidden">
    
    <div class="absolute inset-0 z-0 opacity-40 mix-blend-screen" 
         style="background-image: url('https://images.unsplash.com/photo-1591799264318-7e6ef8ddb7ea?q=80&w=2000'); background-size: cover; background-position: center;">
    </div>
    <div class="absolute inset-0 z-0 bg-black/60 backdrop-blur-sm"></div>

    <div class="relative z-10 w-full max-w-sm p-8 bg-[#161618] rounded-2xl shadow-[0_0_50px_rgba(0,0,0,0.8)] border border-gray-800">
        
        <div class="flex flex-col items-center mb-8">
            <div class="flex items-center gap-2 mb-2">
                <img src="{{ asset('img/logo.png') }}" alt="Logo Iris Computer" class="w-12 h-12 object-contain">
                <div class="flex flex-col">
                    <span class="text-blue-500 font-bold text-xl leading-none tracking-wider">IRIS COMPUTER</span>
                    <span class="text-red-500 text-[10px] font-semibold tracking-widest">VENTA DE COMPONENTES</span>
                </div>
            </div>
            <h2 class="text-2xl font-bold text-gray-200 mt-4">Iniciar Sesion</h2>
        </div>

        <form wire:submit="login" class="space-y-5">
            
            <div>
                <label class="block text-sm font-medium text-gray-400 mb-1">Correo electronico</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <input wire:model="email" type="email" placeholder="ejemplo@correo.com" 
                            class="block w-full pl-10 pr-3 py-2.5 border border-gray-700 rounded-lg bg-[#202022] text-gray-200 placeholder-gray-600 focus:outline-none focus:border-cyan-400 focus:ring-1 focus:ring-cyan-400 sm:text-sm transition-all duration-300" required>
                </div>
                @error('email') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-400 mb-1">Contrasena</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <input wire:model="password" type="password" placeholder="••••••••" 
                            class="block w-full pl-10 pr-10 py-2.5 border border-gray-700 rounded-lg bg-[#202022] text-gray-200 placeholder-gray-600 focus:outline-none focus:border-cyan-400 focus:ring-1 focus:ring-cyan-400 sm:text-sm transition-all duration-300" required>
                </div>
            </div>

            <button type="submit" 
                    class="w-full flex justify-center py-3 mt-4 border border-transparent rounded-lg text-sm font-bold text-gray-900 bg-cyan-400 hover:bg-cyan-300 shadow-[0_0_15px_rgba(34,211,238,0.5)] hover:shadow-[0_0_25px_rgba(34,211,238,0.8)] focus:outline-none transition-all duration-300">
                Iniciar Sesion
            </button>
        </form>

        <div class="mt-6 text-center">
            <a href="#" class="text-xs text-gray-600 hover:text-cyan-400 transition-colors">
                &lt;Olvidaste tu contrasena?&gt;
            </a>
        </div>
    </div>
</div>