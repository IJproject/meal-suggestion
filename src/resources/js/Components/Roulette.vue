<script setup lang="ts">
import type { Ref } from "vue";
import { ref, defineProps, defineEmits } from "vue";
import { Wheel } from "vue3-fortune-wheel";
import type { Datas, imgParams } from "vue3-fortune-wheel";

type Selection = {
    id: number;
    value: string;
    bgColor: string;
    color: string;
};

const props = defineProps({
    data: Array as () => Selection[],
    logo: Object as () => {
        src: string;
        width: number;
        height: number;
    },
});

const emits = defineEmits<{(e: 'result', value?: Object): void}>()

// ここからルーレットに関する記述
const wheel = ref();

const gift: Ref<number> = ref(0)
gift.value = Math.floor(Math.random() * props.data.length) + 1

const launchWheel = () => {
    wheel.value.spin();
};

const done = (r: Datas) => {
    emits('result', r)
    gift.value = Math.floor(Math.random() * props.data.length) + 1
};

const rouletteSize: Ref<{ width: string; height: string }> = ref({
    width: '',
    height: '',
})
if(window.innerWidth < 624) {
    rouletteSize.value.width = (window.innerWidth / 4 * 3).toString() + 'px'
    rouletteSize.value.height = (window.innerWidth / 4 * 3).toString() + 'px'
} else {
    rouletteSize.value.width = (window.innerWidth / 3).toString() + 'px'
    rouletteSize.value.height = (window.innerWidth / 3).toString() + 'px'
}

</script>

<template>
    <div @click="launchWheel" class="inline-block mx-auto">
        <Wheel :gift="gift" :imgParams="logo" @done="done" ref="wheel" v-model="props.data" :style="{width: rouletteSize.width, height: rouletteSize.height}" />
    </div>
</template>
