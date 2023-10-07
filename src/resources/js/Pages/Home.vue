<script setup lang="ts">
import GuestLayout from '../Layouts/GuestLayout.vue';
import type { Ref } from "vue";
import { ref } from "vue";
import { Wheel } from "vue3-fortune-wheel";
import type { Datas, imgParams } from "vue3-fortune-wheel";

// ジャンル決定用のルーレット
const firstWheel = ref();
const firstData: Ref<any> = ref([
    {
        id: 1,
        value: "Gift 1",
        bgColor: "#7d7db3",
        color: "#ffffff",
    },
    {
        id: 2,
        value: "Gift 2",
        bgColor: "#ffffff",
        color: "#000000",
    },
    {
        id: 3,
        value: "Gift 3",
        bgColor: "#c92729",
        color: "#ffffff",
    },
    {
        id: 4,
        value: "Gift 4",
        bgColor: "#7d7db3",
        color: "#ffffff",
    },
    {
        id: 5,
        value: "Gift 5",
        bgColor: "#ffffff",
        color: "#000000",
    },
    {
    id: 6,
        value: "Gift 6",
        bgColor: "#c92729",
        color: "#ffffff",
    },
]);
const firstGift = ref(0)
firstGift.value = Math.floor(Math.random() * firstData.value.length) + 1
const firstLogo: imgParams = {
    src: "https://upload.wikimedia.org/wikipedia/commons/thumb/9/95/Vue.js_Logo_2.svg/2367px-Vue.js_Logo_2.svg.png",
    width: 100,
    height: 120,
};

const firstDone = (r: Datas) => {
    console.log("done", r);
    firstGift.value = Math.floor(Math.random() * firstData.value.length) + 1
};

const launchFirstWheel = () => {
    firstWheel.value.spin();
};

</script>

<template>
    <GuestLayout>
        <div>
            <!-- ルーレット関連 -->
            <div class="p-4 border border-gray-500 shadow-lg">
                <h2 class="font-bold text-xl text-center">お食事ルーレット</h2>
                <!-- ジャンルルーレット -->
                <div class="my-6">
                    <h3 class="pl-2 font-semibold text-lg border-l-4 border-cyan-500">ジャンル</h3>
                    <div class="wrap" @click="launchFirstWheel">
                        <Wheel :gift="firstGift" :imgParams="firstLogo" @done="firstDone" ref="firstWheel" v-model="firstData" />
                    </div>
                </div>
                <!-- 料理ルーレット -->
                <div class="my-6">
                    <h3 class="pl-2 font-semibold text-lg border-l-4 border-indigo-500">料理</h3>
                </div>
            </div>
            <!-- ログイン後に解禁される機能についての告知 -->
            <div>

            </div>
        </div>  
    </GuestLayout>
</template>