<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Link, router, useForm } from '@inertiajs/vue3';

const props = defineProps({
    blog: Object,
    hasAccessRight: Boolean
});

const deleteItem = (blogId) => {
    if(confirm('本当に削除しますか？')){
        router.delete(route('blog.destroy', blogId));
    }
}
</script>

<template>
    <AuthenticatedLayout>
        <div class="space-y-4">
            <div class="flex justify-end mt-4 gap-x-4">
                <Link :href="route('blog.create')" class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 whitespace-nowrap">新規投稿</Link>
                <Link :href="route('blog.index')" class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 whitespace-nowrap">ブログ一覧に戻る</Link>
            </div>
            <div class="mx-10 p-6 bg-white shadow-lg space-y-6">
                <div class="px-4 py-2 font-semibold text-xl border-b border-b-gray-300">{{ blog.user.name }}</div>
                <div class="px-4 py-2 font-bold text-3xl">{{ blog.title }}</div>
                <div class="px-4 py-2 text-lg">{{ blog.content }}</div>
                <div class="px-4 py-2 text-lg">ここには写真を入れたい</div>
            </div>
            <div v-if="hasAccessRight" class="p-6 flex justify-center gap-x-6">
                <Link :href="route('blog.edit', blog.id)" class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 whitespace-nowrap">編集</Link>
                <button type="button" @click="deleteItem(blog.id)" class="block rounded-md bg-red-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-red-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600 whitespace-nowrap">削除</button>
            </div>
        </div>
        
    </AuthenticatedLayout>
</template>