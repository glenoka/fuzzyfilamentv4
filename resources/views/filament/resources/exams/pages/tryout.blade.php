<x-filament-panels::page>
   {{-- Kirim '$this->record' dari Page ke komponen Livewire --}}
   {{-- sebagai parameter bernama 'exam' --}}
   @livewire('tryout', ['exam' => $this->record])
</x-filament-panels::page>
