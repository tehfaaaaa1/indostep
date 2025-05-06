<script setup>
import { onMounted, ref } from 'vue';

defineProps({
    modelValue: String,
    plch:String,
    rq: {
        type:String,
        default:false
    }
});

defineEmits(['update:modelValue']);

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
    <input
        ref="input"
        class="py-2.5 sm:py-3 px-2 block w-2xs border-b-2 border-dark-green sm:text-sm ring-0 outline-none disabled:opacity-50 disabled:pointer-events-none tracking-wider leading-4"
        :value="modelValue"
        :placeholder="plch"
        required
        :required="rq"
        @input="$emit('update:modelValue', $event.target.value)"
    >
</template>
