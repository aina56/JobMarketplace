<div class="max-w-md mx-auto mt-10 bg-white p-6 rounded shadow">
    <h2 class="text-xl font-semibold mb-4">Create Account</h2>

    <form wire:submit.prevent="register">
        <input type="text" wire:model="name" placeholder="Full Name" class="w-full mb-3 border p-2 rounded">
        @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

        <input type="email" wire:model="email" placeholder="Email" class="w-full mb-3 border p-2 rounded">
        @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

        <input type="password" wire:model="password" placeholder="Password" class="w-full mb-3 border p-2 rounded">
        @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

        <input type="password" wire:model="password_confirmation" placeholder="Confirm Password" class="w-full mb-3 border p-2 rounded">

        <button class="bg-blue-600 text-white px-4 py-2 rounded w-full">Register</button>
    </form>

    <p class="text-sm text-center mt-3">
        Already have an account?
        <a href="{{ route('login') }}" class="text-blue-500">Login</a>
    </p>
</div>
