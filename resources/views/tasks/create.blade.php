<x-app-layout>
  <div class="flex flex-col items-center justify-center min-h-screen bg-gray-100">
    <div class="w-2/3 bg-white shadow-md rounded-md p-6">
      <h1 class="text-4xl font-bold text-center mb-4"
        style="font-size: 24px; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);">
        TODO登録</h1>
      <form action="{{ route('tasks.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-4">
          <label id="title" class="mb-2">タイトル</label>
          <input type="text" name="title" id="title" class="border border-gray-300 rounded px-2 py-1 w-full">
        </div>
        <div class="mb-4">
          <label class="mb-2">カテゴリー</label>
          <select name="category_id" class="border border-gray-300 rounded px-2 py-1 w-full">
            <option value="">カテゴリー選択</option>
            @foreach ($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
          </select>
        </div>
        <div class="mb-4">
          <label class="mb-2">担当ユーザー</label>
          <select name="assigned_user_id" class="border border-gray-300 rounded px-2 py-1 w-full">
            <option value="">ユーザー選択</option>
            @foreach ($users as $user)
            <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
          </select>
        </div>
        <div class="mb-4">
          <label class="mb-2">画像</label>
          <input type="file" name="image">
        </div>
        <div class="mb-4">
          <label id="body" class="mb-2">本文</label>
          <textarea name="body" id="body" cols="30" rows="4" class="border border-gray-300 rounded px-2 py-1 w-full"
            placeholder="TODOを入力してください。"></textarea>
        </div>
        <div class="flex justify-end">
          <x-primary-button>登録</x-primary-button>
        </div>
      </form>
    </div>
  </div>
</x-app-layout>
