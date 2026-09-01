<x-app-layout>
    <div class="max-w-3xl mx-auto px-6 py-8">

        <h2 class="text-2xl font-bold text-gray-800 mb-6">
            フォーム
        </h2>

        @if (session('message'))
            <div class="mb-4 rounded bg-red-100 p-3 text-red-700">
                {{ session('message') }}
            </div>
        @endif

        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach

        <form method="POST" action="{{ route('blog.update', $post) }}">
            @csrf
            @method('patch')

            <!-- 件名 -->
            <div class="mb-6">
                <label for="title" class="block mb-2 font-semibold">
                    件名
                </label>
                <x-input-error :messages="$errors->get('title')" class="mt-2" />
                <input type="text" name="title" id="title" value="{{ old('title', $post->title) }}"
                    class="w-full rounded-md border border-gray-300 p-2 focus:border-blue-500 focus:outline-none">
            </div>

            <!-- 本文 -->
            <div class="mb-6">
                <label for="body" class="block mb-2 font-semibold">
                    本文
                </label>

                <textarea name="body" id="body" rows="8"
                    class="w-full rounded-md border border-gray-300 p-2 resize-none focus:border-blue-500 focus:outline-none">{{ old('body', $post->body) }}</textarea>
            </div>

            <!-- ボタン -->
            <button type="submit" class="w-full rounded-md bg-blue-600 py-2 text-white hover:bg-blue-700">
                送信する
            </button>

        </form>

    </div>
</x-app-layout>
