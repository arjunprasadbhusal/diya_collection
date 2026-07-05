<div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
     class="mb-6 p-4 rounded-xl flex items-center justify-between text-sm font-medium animate-slide-down"
     :class="{
       'bg-green-50 border border-green-200 text-green-700': type === 'success',
       'bg-red-50 border border-red-200 text-red-700': type === 'error',
       'bg-blue-50 border border-blue-200 text-blue-700': type === 'info'
     }">
  <span>
    <i class="mr-2" :class="{
      'fas fa-check-circle text-green-500': type === 'success',
      'fas fa-exclamation-circle text-red-500': type === 'error',
      'fas fa-info-circle text-blue-500': type === 'info'
    }"></i>
    {{ $slot }}
  </span>
  <button @click="show = false" class="shrink-0 ml-4" :class="{
    'text-green-500 hover:text-green-700': type === 'success',
    'text-red-500 hover:text-red-700': type === 'error',
    'text-blue-500 hover:text-blue-700': type === 'info'
  }">
    <i class="fas fa-times"></i>
  </button>
</div>
