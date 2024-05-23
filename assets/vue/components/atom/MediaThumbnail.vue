<script setup>
import {onMounted, ref} from "vue";
import LoadingSpinner from "./LoadingSpinner.vue";
import Freezeframe from "freezeframe";
import {onDOMContentLoaded} from "bootstrap/js/src/util";

const props = defineProps({
  src: {type: String, required: true},
  alt: {type: String, required: true},
  lazyLoadTrigger: {type: [String, Boolean], default: null, required: false, validator(value) {
    return ['hover', 'click', false].includes(value)
    }}
})

const img = ref(null);
const isLoading = ref(false)

onMounted(() => {
  const imgEl = img.value

  isLoading.value = true
  fetch(props.src).then((r) => {
    if (r.ok) {
      imgEl.addEventListener('load', () => {
        if (props.lazyLoadTrigger) {
          new Freezeframe({trigger: props.lazyLoadTrigger, overlay: true, warnings: true})
        }
        isLoading.value = false
      })
    }
  })
})

</script>

<template>
  <img
      v-if="!isLoading"
      :src="src"
      :alt="alt"
      class="w-100 object-fit-cover rounded-4 freezeframe"
      style="aspect-ratio: 1/1 !important;"
      ref="img"
  >
  <LoadingSpinner v-else/>
</template>

<style scoped>

</style>