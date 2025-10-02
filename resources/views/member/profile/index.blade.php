<x-app-layout>
    <x-slot name="header">
        โปรไฟล์ของฉัน
    </x-slot>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Profile Information -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden mb-6">
            <div class="bg-stone-700 px-6 py-4">
                <h3 class="text-lg font-semibold text-white">ข้อมูลส่วนตัว</h3>
            </div>

            <form action="{{ route('member.profile.update') }}" method="POST" class="p-6">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-stone-700 mb-2">ชื่อ-นามสกุล <span class="text-red-500">*</span></label>
                    <input type="text" id="name" name="name" value="{{ old('name', auth()->user()->name) }}" required
                        class="w-full px-4 py-2 border border-stone-300 rounded-md focus:ring-2 focus:ring-amber-500 focus:border-transparent @error('name') border-red-500 @enderror">
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="email" class="block text-sm font-medium text-stone-700 mb-2">อีเมล <span class="text-red-500">*</span></label>
                    <input type="email" id="email" name="email" value="{{ old('email', auth()->user()->email) }}" required
                        class="w-full px-4 py-2 border border-stone-300 rounded-md focus:ring-2 focus:ring-amber-500 focus:border-transparent @error('email') border-red-500 @enderror">
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end">
                    <button type="submit" 
                        class="px-6 py-2 bg-amber-600 text-white rounded-md hover:bg-amber-700 transition">
                        บันทึกการเปลี่ยนแปลง
                    </button>
                </div>
            </form>
        </div>

        <!-- Account Status -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden mb-6">
            <div class="bg-stone-700 px-6 py-4">
                <h3 class="text-lg font-semibold text-white">สถานะบัญชี</h3>
            </div>

            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="p-4 bg-stone-50 rounded-md border border-stone-200">
                        <p class="text-sm text-stone-600 mb-1">บทบาท</p>
                        <p class="text-lg font-semibold text-stone-900">
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                {{ ucfirst(auth()->user()->role) }}
                            </span>
                        </p>
                    </div>

                    <div class="p-4 bg-stone-50 rounded-md border border-stone-200">
                        <p class="text-sm text-stone-600 mb-1">สถานะ</p>
                        <p class="text-lg font-semibold text-stone-900">
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                                @if(auth()->user()->status === 'approved') bg-green-100 text-green-800
                                @elseif(auth()->user()->status === 'pending') bg-yellow-100 text-yellow-800
                                @else bg-red-100 text-red-800
                                @endif">
                                {{ auth()->user()->status }}
                            </span>
                        </p>
                    </div>

                    <div class="p-4 bg-stone-50 rounded-md border border-stone-200">
                        <p class="text-sm text-stone-600 mb-1">สมัครเมื่อ</p>
                        <p class="text-lg font-semibold text-stone-900">
                            {{ auth()->user()->created_at->format('d/m/Y H:i') }}
                        </p>
                    </div>

                    @if(auth()->user()->approved_at)
                        <div class="p-4 bg-stone-50 rounded-md border border-stone-200">
                            <p class="text-sm text-stone-600 mb-1">อนุมัติเมื่อ</p>
                            <p class="text-lg font-semibold text-stone-900">
                                {{ auth()->user()->approved_at->format('d/m/Y H:i') }}
                            </p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Change Password -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="bg-stone-700 px-6 py-4">
                <h3 class="text-lg font-semibold text-white">เปลี่ยนรหัสผ่าน</h3>
            </div>

            <form action="{{ route('member.profile.password') }}" method="POST" class="p-6">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="current_password" class="block text-sm font-medium text-stone-700 mb-2">รหัสผ่านปัจจุบัน <span class="text-red-500">*</span></label>
                    <input type="password" id="current_password" name="current_password" required
                        class="w-full px-4 py-2 border border-stone-300 rounded-md focus:ring-2 focus:ring-amber-500 focus:border-transparent @error('current_password') border-red-500 @enderror">
                    @error('current_password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-stone-700 mb-2">รหัสผ่านใหม่ <span class="text-red-500">*</span></label>
                    <input type="password" id="password" name="password" required
                        class="w-full px-4 py-2 border border-stone-300 rounded-md focus:ring-2 focus:ring-amber-500 focus:border-transparent @error('password') border-red-500 @enderror">
                    @error('password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="mt-1 text-xs text-stone-500">รหัสผ่านต้องมีอย่างน้อย 8 ตัวอักษร</p>
                </div>

                <div class="mb-6">
                    <label for="password_confirmation" class="block text-sm font-medium text-stone-700 mb-2">ยืนยันรหัสผ่านใหม่ <span class="text-red-500">*</span></label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required
                        class="w-full px-4 py-2 border border-stone-300 rounded-md focus:ring-2 focus:ring-amber-500 focus:border-transparent">
                </div>

                <div class="flex justify-end">
                    <button type="submit" 
                        class="px-6 py-2 bg-amber-600 text-white rounded-md hover:bg-amber-700 transition">
                        เปลี่ยนรหัสผ่าน
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>