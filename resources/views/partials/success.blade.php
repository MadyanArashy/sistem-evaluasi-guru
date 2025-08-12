<!-- Success Message -->
<div
    x-data="{ success: true }"
    x-show="success"
    x-transition
    class="success-alert flex items-center gap-3 p-4 bg-green-100 border border-green-300 rounded-lg"
>
    <!-- Icon -->
    <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center flex-shrink-0">
        <i class="fas fa-check text-white text-sm"></i>
    </div>

    <!-- Message -->
    <div class="flex-1">
        <h4 class="font-bold text-green-800">Berhasil!</h4>
        <p class="text-green-700">{{ session('success') }}</p>
    </div>

    <!-- Close Button -->
    <button
        @click="success = false"
        class="w-8 h-8 bg-gradient-to-br from-red-500 to-orange-600 rounded-lg flex items-center justify-center text-white font-bold text-sm hover:opacity-80"
    >
        <i class="fa-solid fa-x"></i>
    </button>
</div>
