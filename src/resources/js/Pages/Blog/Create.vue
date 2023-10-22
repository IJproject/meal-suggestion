<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Link, router, useForm } from '@inertiajs/vue3';

const form = useForm({
    title: '',
    content: '',
});

const submit = () => {
    form.post(route('blog.store'));
}
</script>

<template>
    <AuthenticatedLayout>
        <div>
            <div class="flex justify-end mt-4 gap-x-4">
                <Link :href="route('blog.index')" class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 whitespace-nowrap">ブログ一覧に戻る</Link>
            </div>
            <form @submit.prevent="submit" class="mx-10 mt-4 p-6 bg-white shadow-lg space-y-6">
                <label>
                    タイトル
                    <input v-model="form.title" >
                </label>
                <label>
                    本文
                    <textarea v-model="form.content"></textarea>
                </label>
                <div class="flex justify-end">
                    <button type="submit" class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 whitespace-nowrap">保存</button>
                </div>
            </form>
        </div>
    </AuthenticatedLayout>
</template>