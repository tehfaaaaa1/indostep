<script setup>
import { computed, onMounted, onUnmounted, ref } from 'vue';

const props = defineProps({
    align: {
        type: String,
        default: 'right',
    },
    width: {
        type: String,
        default: '72',
    },
    contentClasses: {
        type: Array,
        default: () => ['py-1', 'bg-white'],
    },
    opn: {
        type: Boolean,
        default: false
    }
});

let open = ref(props.opn);

const closeOnEscape = (e) => {
    if (open.value && e.key === 'Escape') {
        open.value = false;
    }
};

onMounted(() => document.addEventListener('keydown', closeOnEscape));
onUnmounted(() => document.removeEventListener('keydown', closeOnEscape));

const widthClass = computed(() => {
    return {
        '16': 'w-16',
        '36': 'w-36',
        '48': 'w-48',
        '72': 'w-72',
        '96' : 'w-96',
    }[props.width.toString()];
});

const alignmentClasses = computed(() => {
    if (props.align === 'left') {
        return 'ltr:origin-top-left rtl:origin-top-right start-0';
    }

    if (props.align === 'right') {
        return 'ltr:origin-top-right rtl:origin-top-left end-0';
    }

    return 'origin-top';
});
</script>

<template>
    <div class="relative">
        <div @click="open = ! open" @focusin="open = !open">
            <slot name="trigger" />
        </div>

        <!-- Full Screen Dropdown Overlay -->
        <div v-show="open" class="fixed inset-0 z-40" @click="open = false" @focusout="open = false"/>

        <transition
            enter-active-class="transition ease-out duration-200"
            enter-from-class="transform opacity-0 scale-95"
            enter-to-class="transform opacity-100 scale-100"
            leave-active-class="transition ease-in duration-75"
            leave-from-class="transform opacity-100 scale-100"
            leave-to-class="transform opacity-0 scale-95"
        >
            <div
                v-show="open"
                class="absolute z-[100] mt-2 rounded-md shadow-lg"
                :class="[widthClass, alignmentClasses]"
                style="display: none;"
                >
                <div class="rounded-md ring-1 ring-dark-green ring-opacity-5" :class="contentClasses">
                    <slot name="content" />
                </div>
            </div>
        </transition>
    </div>
</template>
