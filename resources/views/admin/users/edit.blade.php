<x-app-layout>
    <x-slot name="header">
        แก้ไขข้อมูลผู้ใช้
    </x-slot>

    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="bg-stone-700 px-6 py-4">
                <h3 class="text-lg font-semibold text-white">แก้ไขข้อมูล: {{ $user->name }}</h3>
            </div>

            <form action="{{ route('admin.users.update', $user) }}" method="POST" class="p-6">
                @csrf
                @method('PUT')

                <!-- Name -->
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-stone-700 mb-2">ชื่อ-นามสกุล <span class="text-red-500">*</span></label>
                    <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required
                        class="w-full px-4 py-2 border border-stone-300 rounded-md focus:ring-2 focus:ring-amber-500 focus:border-transparent @error('name') border-red-500 @enderror">
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-stone-700 mb-2">อีเมล <span class="text-red-500">*</span></label>
                    <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required
                        class="w-full px-4 py-2 border border-stone-300 rounded-md focus:ring-2 focus:ring-amber-500 focus:border-transparent @error('email') border-red-500 @enderror">
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-stone-700 mb-2">รหัสผ่านใหม่</label>
                    <input type="password" id="password" name="password"
                        class="w-full px-4 py-2 border border-stone-300 rounded-md focus:ring-2 focus:ring-amber-500 focus:border-transparent @error('password') border-red-500 @enderror">
                    @error('password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="mt-1 text-xs text-stone-500">ปล่อยว่างไว้หากไม่ต้องการเปลี่ยนรหัสผ่าน</p>
                </div>

                <!-- Role -->
                <div class="mb-4">
                    <label for="role" class="block text-sm font-medium text-stone-700 mb-2">บทบาท <span class="text-red-500">*</span></label>
                    <select id="role" name="role" required
                        class="w-full px-4 py-2 border border-stone-300 rounded-md focus:ring-2 focus:ring-amber-500 focus:border-transparent @error('role') border-red-500 @enderror">
                        <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="manager" {{ old('role', $user->role) === 'manager' ? 'selected' : '' }}>Manager</option>
                        <option value="staff" {{ old('role', $user->role) === 'staff' ? 'selected' : '' }}>Staff</option>
                        <option value="member" {{ old('role', $user->role) === 'member' ? 'selected' : '' }}>Member</option>
                    </select>
                    @error('role')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Status -->
                <div class="mb-6">
                    <label for="status" class="block text-sm font-medium text-stone-700 mb-2">สถานะ <span class="text-red-500">*</span></label>
                    <select id="status" name="status" required
                        class="w-full px-4 py-2 border border-stone-300 rounded-md focus:ring-2 focus:ring-amber-500 focus:border-transparent @error('status') border-red-500 @enderror">
                        <option value="approved" {{ old('status', $user->status) === 'approved' ? 'selected' : '' }}>Approved (อนุมัติแล้ว)</option>
                        <option value="pending" {{ old('status', $user->status) === 'pending' ? 'selected' : '' }}>Pending (รออนุมัติ)</option>
                        <option value="rejected" {{ old('status', $user->status) === 'rejected' ? 'selected' : '' }}>Rejected (ปฏิเสธ)</option>
                    </select>
                    @error('status')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Info -->
                @if($user->approved_at)
                    <div class="mb-6 p-4 bg-stone-50 rounded-md border border-stone-200">
                        <p class="text-sm text-stone-600">
                            <strong>อนุมัติโดย:</strong> {{ $user->approvedBy->name ?? 'ไม่ระบุ' }}<br>
                            <strong>วันที่อนุมัติ:</strong> {{ $user->approved_at->format('d/m/Y H:i') }}
                        </p>
                    </div>
                @endif

                <!-- Buttons -->
                <div class="flex justify-end gap-3">
                    <a href="{{ route('admin.users.index') }}" 
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