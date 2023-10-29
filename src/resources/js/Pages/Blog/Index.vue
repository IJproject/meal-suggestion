<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Link, router, useForm } from '@inertiajs/vue3';

const props = defineProps({
    blogs: Object,
    search: Object,
});

const searchForm = useForm({
    title: props.search.title,
    userName: props.search.userName, 
});

const search = () => {
    searchForm.get(route('blog.index'));
}

const clickedBlog = (blogId: number) => {
    router.get(route('blog.show', blogId));
}
</script>

<template>
    <AuthenticatedLayout>
        <div class="space-y-12">
            <!-- 検索 -->
            <form @submit.prevent="search" class="flex justify-end">
                <div class="w-full">
                    <label>
                        タイトル
                        <input v-model="searchForm.title" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500" />
                    </label>
                    <label>
                        投稿者
                        <input v-model="searchForm.userName" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500" />
                    </label>
                </div>
                <div>
                    <button type="submit" class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 whitespace-nowrap">検索</button>
                </div>
            </form>

            <div class="flex justify-end">
                <Link :href="route('blog.create')" class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 whitespace-nowrap">新規投稿</Link>
            </div>

            <!-- 表示 -->
            <div class="grid grid-cols-3 gap-6">
                <div v-for="blog in props.blogs" :key="blog.id" @click="clickedBlog(blog.id)" class="col-span-1 bg-white shadow-lg cursor-pointer" >
                    <div class="px-4 py-2 font-semibold border-b border-b-gray-300">
                        {{ blog.user.name }}
                    </div>
                    <div class="px-4 py-2 font-bold text-xl">
                        {{ blog.title }}
                    </div>
                    <div class="px-4 py-2">
                        ここには写真を入れたい
                    </div>
                </div>
            </div>
            <!-- ページネーション -->
        </div>
    </AuthenticatedLayout>
</template>