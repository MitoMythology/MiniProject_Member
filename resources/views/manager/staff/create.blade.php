<x-app-layout>
    <x-slot name="header">
        เพิ่ม Staff ใหม่
    </x-slot>

    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="bg-stone-700 px-6 py-4">
                <h3 class="text-lg font-semibold text-white">ข้อมูล Staff</h3>
            </div>

            <form action="{{ route('manager.staff.store') }}" method="POST" class="p-6">
                @csrf

                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-stone-700 mb-2">ชื่อ-นามสกุล <span class="text-red-500">*</span></label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required
                        class="w-full px-4 py-2 border border-stone-300 rounded-md focus:ring-2 focus:ring-amber-500 focus:border-transparent @error('name') border-red-500 @enderror">
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-stone-700 mb-2">อีเมล <span class="text-red-500">*</span></label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required
                        class="w-full px-4 py-2 border border-stone-300 rounded-md focus:ring-2 focus:ring-amber-500 focus:border-transparent @error('email') border-red-500 @enderror">
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-stone-700 mb-2">รหัสผ่าน <span class="text-red-500">*</span></label>
                    <input type="password" id="password" name="password" required
                        class="w-full px-4 py-2 border border-stone-300 rounded-md focus:ring-2 focus:ring-amber-500 focus:border-transparent @error('password') border-red-500 @enderror">
                    @error('password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="mt-1 text-xs text-stone-500">รหัสผ่านต้องมีอย่างน้อย 8 ตัวอักษร</p>
                </div>

                <div class="mb-6">
                    <label for="status" class="block text-sm font-medium text-stone-700 mb-2">สถานะ <span class="text-red-500">*</span></label>
                    <select id="status" name="status" required
                        class="w-full px-4 py-2 border border-stone-300 rounded-md focus:ring-2 focus:ring-amber-500 focus:border-transparent @error('status') border-red-500 @enderror">
                        <option value="">-- เลือกสถานะ --</option>
                        <option value="approved" {{ old('status') === 'approved' ? 'selected' : '' }}>Approved (อนุมัติแล้ว)</option>
                        <option value="pending" {{ old('status') === 'pending' ? 'selected' : '' }}>Pending (รออนุมัติ)</option>
                    </select>
                    @error('status')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end gap-3">
                    <a href="{{ route('manager.staff.index') }}" 
                        class="px-6 py-2 border border-stone-300 rounded-md text-stone-700 hover:bg-stone-50 transition">
                        ยกเลิก
                    </a>
                    <button type="submit" 
                        class="px-6 py-2 bg-amber-600 text-white rounded-md hover:bg-amber-700 transition">
                        บันทึก
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>