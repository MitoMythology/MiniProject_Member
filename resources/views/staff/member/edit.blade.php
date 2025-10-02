<x-app-layout>
    <x-slot name="header">
        แก้ไขข้อมูลสมาชิก
    </x-slot>

    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="bg-stone-700 px-6 py-4">
                <h3 class="text-lg font-semibold text-white">แก้ไขข้อมูล: {{ $user->name }}</h3>
            </div>

            <form action="{{ route('staff.members.update', $user) }}" method="POST" class="p-6">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-stone-700 mb-2">ชื่อ-นามสกุล <span class="text-red-500">*</span></label>
                    <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required
                        class="w-full px-4 py-2 border border-stone-300 rounded-md focus:ring-2 focus:ring-amber-500 focus:border-transparent @error('name') border-red-500 @enderror">
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="email" class="block text-sm font-medium text-stone-700 mb-2">อีเมล <span class="text-red-500">*</span></label>
                    <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required
                        class="w-full px-4 py-2 border border-stone-300 rounded-md focus:ring-2 focus:ring-amber-500 focus:border-transparent @error('email') border-red-500 @enderror">
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6 p-4 bg-stone-50 rounded-md border border-stone-200">
                    <p class="text-sm text-stone-600">
                        <strong>สถานะ:</strong> 
                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                            @if($user->status === 'approved') bg-green-100 text-green-800
                            @elseif($user->status === 'pending') bg-yellow-100 text-yellow-800
                            @else bg-red-100 text-red-800
                            @endif">
                            {{ $user->status }}
                        </span>
                    </p>
                    @if($user->approved_at)
                        <p class="text-sm text-stone-600 mt-2">
                            <strong>อนุมัติโดย:</strong> {{ $user->approvedBy->name ?? 'ไม่ระบุ' }}<br>
                            <strong>วันที่อนุมัติ:</strong> {{ $user->approved_at->format('d/m/Y H:i') }}
                        </p>
                    @endif
                </div>

                <div class="flex justify-end gap-3">
                    <a href="{{ route('staff.members.index') }}" 
                        class="px-6 py-2 border border-stone-300 rounded-md text-stone-700 hover:bg-stone-50 transition">
                        ยกเลิก
                    </a>
                    <button type="submit" 
                        class="px-6 py-2 bg-amber-600 text-white rounded-md hover:bg-amber-700 transition">
                        อัพเดท
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>